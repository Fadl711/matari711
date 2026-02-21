<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * عرض الصفحة الرئيسية
     */
    public function welcome()
    {
        return view('posts.welcome');
    }

    /**
     * عرض صفحة إنشاء منشور جديد
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.create', compact('sections'));
    }

    /**
     * حفظ منشور جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'body' => 'nullable|string|max:50000',
            'section_id' => 'required|exists:sections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp', // No size limit
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,video/x-msvideo,video/x-matroska,video/webm,video/3gpp,video/x-flv', // دعم أنواع أكثر
            'video_link' => 'nullable|url|max:500',
            'audio' => 'nullable|mimes:mp3,wav,aac,ogg,flac,m4a,wma,opus,amr,3gp,aiff,ape,mka,webm,oga,spx,tta,wv', // قبول جميع أنواع الصوت
            'book' => 'nullable|mimes:pdf', // No size limit
        ], [
            'title.required' => 'العنوان مطلوب',
            'title.min' => 'العنوان يجب أن يكون 3 أحرف على الأقل',
            'section_id.exists' => 'القسم المختار غير موجود',
            'image.mimes' => 'الصورة يجب أن تكون بصيغة: jpeg, png, jpg, webp',
            'book.mimes' => 'الكتاب يجب أن يكون بصيغة PDF',
        ]);

        $post = new Post();
        $post->titleart = $request->title;
        $post->body = $request->body;
        $post->idsection = $request->section_id;
        $post->teypsection = $request->section_id;
        $post->userid = Auth::id();

        // رفع الصورة محلياً مع التحقق الأمني
        // رفع الصورة محلياً مع التحقق الأمني وضغطها
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.webp'; // تحويل لـ WebP
            $destinationPath = public_path('uploads/images/' . $imageName);

            // محاولة الضغط (Native PHP)
            try {
                $this->compressImage($image, $destinationPath, 75);
            } catch (\Exception $e) {
                // في حالة الفشل، الرفع العادي كخطة بديلة
                $image->move(public_path('uploads/images'), $imageName);
            }

            $post->imgart = $imageName;
        }

        // رفع الفيديو مع التحقق الأمني
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = uniqid() . '_' . time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/videos'), $videoName);
            $post->fileVid = $videoName;

            // إرسال للمعالجة في الخلفية
            $videoPath = 'uploads/videos/' . $videoName;
        } elseif ($request->video_link) {
            $post->link_video = $this->extractYoutubeId($request->video_link);
        }

        // رفع الصوت مع التحقق الأمني
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioName = uniqid() . '_' . time() . '.' . $audio->getClientOriginalExtension();
            $audio->move(public_path('uploads/audio'), $audioName);
            $post->fileAud = $audioName;

            // إرسال للمعالجة في الخلفية
            $audioPath = 'uploads/audio/' . $audioName;
        }

        // رفع الكتاب مع التحقق الأمني
        if ($request->hasFile('book')) {
            $book = $request->file('book');
            $bookName = uniqid() . '_' . time() . '.' . $book->getClientOriginalExtension();
            $book->move(public_path('uploads/books'), $bookName);
            $post->books = $bookName;
        }

        $post->save();

        // إرسال الملفات للـ Queue
        if (isset($videoPath)) {
            \App\Jobs\ProcessMediaFile::dispatch($post->id, $videoPath, 'video', false);
        }
        if (isset($audioPath)) {
            \App\Jobs\ProcessMediaFile::dispatch($post->id, $audioPath, 'audio', false);
        }

        return redirect()->route('posts.section', $post->idsection)
            ->with('success', 'تم إضافة المنشور بنجاح! جاري معالجة الملفات في الخلفية...');
    }

    /**
     * عرض منشور معين
     */
    public function show($id)
    {
        $post = Post::with(['section', 'comments.user'])->findOrFail($id);

        // زيادة عدد المشاهدات مع منع التكرار في نفس الجلسة
        $viewed = session()->get('viewed_posts', []);
        if (!in_array($id, $viewed)) {
            $post->increment('views');
            session()->push('viewed_posts', $id);
        }

        $relatedPosts = Post::where('idsection', $post->idsection)
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * عرض صفحة تعديل المنشور
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $sections = Section::all();
        return view('admin.edit', compact('post', 'sections'));
    }

    /**
     * تحديث المنشور
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'body' => 'nullable|string|max:50000',
            'section_id' => 'required|exists:sections,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp', // No size limit
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime,video/x-msvideo,video/x-matroska,video/webm,video/3gpp,video/x-flv', // دعم أنواع أكثر
            'video_link' => 'nullable|url|max:500',
            'audio' => 'nullable|mimes:mp3,wav,aac,ogg,flac,m4a,wma,opus,amr,3gp,aiff,ape,mka,webm,oga,spx,tta,wv', // قبول جميع أنواع الصوت
            'book' => 'nullable|mimes:pdf', // No size limit
        ]);

        $post = Post::findOrFail($id);
        $post->titleart = $request->title;
        $post->body = $request->body;
        $post->idsection = $request->section_id;
        $post->teypsection = $request->section_id;

        // حذف الصورة إذا طُلب ذلك
        if ($request->remove_image == '1') {
            if ($post->imgart && file_exists(public_path('uploads/images/' . $post->imgart))) {
                unlink(public_path('uploads/images/' . $post->imgart));
            }
            $post->imgart = null;
        }

        // حذف الفيديو إذا طُلب ذلك
        if ($request->remove_video == '1') {
            if ($post->fileVid && file_exists(public_path('uploads/videos/' . $post->fileVid))) {
                unlink(public_path('uploads/videos/' . $post->fileVid));
            }
            $post->fileVid = null;
        }

        // حذف الصوت إذا طُلب ذلك
        if ($request->remove_audio == '1') {
            if ($post->fileAud && file_exists(public_path('uploads/audio/' . $post->fileAud))) {
                unlink(public_path('uploads/audio/' . $post->fileAud));
            }
            $post->fileAud = null;
        }

        // حذف الكتاب إذا طُلب ذلك
        if ($request->remove_book == '1') {
            if ($post->books && file_exists(public_path('uploads/books/' . $post->books))) {
                unlink(public_path('uploads/books/' . $post->books));
            }
            $post->books = null;
        }

        // تحديث الصورة محلياً مع التحقق الأمني وضغطها
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($post->imgart && file_exists(public_path('uploads/images/' . $post->imgart))) {
                unlink(public_path('uploads/images/' . $post->imgart));
            }

            $image = $request->file('image');
            $imageName = uniqid() . '_' . time() . '.webp'; // تحويل لـ WebP
            $destinationPath = public_path('uploads/images/' . $imageName);

            // محاولة الضغط (Native PHP)
            try {
                $this->compressImage($image, $destinationPath, 75);
            } catch (\Exception $e) {
                // في حالة الفشل، الرفع العادي كخطة بديلة
                $image->move(public_path('uploads/images'), $imageName);
            }

            $post->imgart = $imageName;
        }

        // تحديث الفيديو مع التحقق الأمني
        if ($request->hasFile('video')) {
            // حذف الفيديو القديم
            if ($post->fileVid && file_exists(public_path('uploads/videos/' . $post->fileVid))) {
                unlink(public_path('uploads/videos/' . $post->fileVid));
            }
            $video = $request->file('video');
            $videoName = uniqid() . '_' . time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/videos'), $videoName);
            $post->fileVid = $videoName;
            $videoPath = 'uploads/videos/' . $videoName;
        } elseif ($request->video_link) {
            $post->link_video = $this->extractYoutubeId($request->video_link);
        }

        // تحديث الصوت مع التحقق الأمني
        if ($request->hasFile('audio')) {
            // حذف الصوت القديم
            if ($post->fileAud && file_exists(public_path('uploads/audio/' . $post->fileAud))) {
                unlink(public_path('uploads/audio/' . $post->fileAud));
            }
            $audio = $request->file('audio');
            $audioName = uniqid() . '_' . time() . '.' . $audio->getClientOriginalExtension();
            $audio->move(public_path('uploads/audio'), $audioName);
            $post->fileAud = $audioName;
            $audioPath = 'uploads/audio/' . $audioName;
        }

        // تحديث الكتاب مع التحقق الأمني
        if ($request->hasFile('book')) {
            // حذف الكتاب القديم
            if ($post->books && file_exists(public_path('uploads/books/' . $post->books))) {
                unlink(public_path('uploads/books/' . $post->books));
            }
            $book = $request->file('book');
            $bookName = uniqid() . '_' . time() . '.' . $book->getClientOriginalExtension();
            $book->move(public_path('uploads/books'), $bookName);
            $post->books = $bookName;
        }

        $post->save();

        // إرسال الملفات للـ Queue
        if (isset($videoPath)) {
            \App\Jobs\ProcessMediaFile::dispatch($post->id, $videoPath, 'video', false);
        }
        if (isset($audioPath)) {
            \App\Jobs\ProcessMediaFile::dispatch($post->id, $audioPath, 'audio', false);
        }

        return redirect()->route('home')
            ->with('success', 'تم تحديث المنشور بنجاح! جاري معالجة الملفات...');
    }

    /**
     * حذف منشور
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // حذف التعليقات والإعجابات المرتبطة أولاً لتجنب خطأ القيود (Foreign Key Constraint)
        $post->comments()->delete();
        $post->likes()->delete();

        $post->delete();

        return redirect()->route('home')
            ->with('success', 'تم حذف المنشور والتعليقات المرتبطة به بنجاح');
    }

    /**
     * عرض كتاب PDF في المتصفح (بدون تحميل)
     */
    public function viewBook($id)
    {
        $post = Post::findOrFail($id);

        if (!$post->books) {
            abort(404, 'لا يوجد كتاب مرفق');
        }

        // تحديد المسار الصحيح
        $filename = $post->books;
        $paths = [
            public_path("uploads/books/{$filename}"),
            public_path("book/{$filename}"),
            // محاولة مسار بديل في حال وجود مشكلة في الفواصل
            public_path("uploads\\books\\{$filename}"),
            public_path("book\\{$filename}"),
        ];

        $filePath = null;
        foreach ($paths as $p) {
            if (file_exists($p)) {
                $filePath = $p;
                break;
            }
        }

        if (!$filePath) {
            // في حال الفشل، ارجع رسالة خطأ واضحة
            return response("File not found: " . implode(', ', $paths), 404);
        }

        // استخدام readfile لتجنب مشاكل استجابة لارافل مع الملفات الكبيرة أحياناً في السيرفر المحلي
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');

        // تنظيف المخرجات السابقة لتجنب تلف ملف PDF
        if (ob_get_level()) ob_end_clean();

        readfile($filePath);
        exit;
    }

    /**
     * تثبيت/إلغاء تثبيت منشور
     */
    public function togglePin($id)
    {
        $post = Post::findOrFail($id);
        $post->is_pinned = !$post->is_pinned;
        $post->save();

        return response()->json([
            'success' => true,
            'is_pinned' => $post->is_pinned,
            'message' => $post->is_pinned ? 'تم تثبيت المنشور بنجاح' : 'تم إلغاء تثبيت المنشور'
        ]);
    }

    /**
     * استخراج معرف يوتيوب من الرابط
     */
    private function extractYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? $url;
    }

    /**
     * دالة مساعدة لضغط الصور محلياً (Native PHP)
     * تحول الصور إلى WebP وتضغطها لتقليل الحجم
     */
    private function compressImage($source, $destination, $quality)
    {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);
        elseif ($info['mime'] == 'image/webp')
            $image = imagecreatefromwebp($source);
        else
            return false; // نوع غير مدعوم

        // حفظ الصورة بصيغة WebP (الأفضل للويب)
        imagepalettetotruecolor($image);
        imagewebp($image, $destination, $quality);
        imagedestroy($image);

        return true;
    }
}
