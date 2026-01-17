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
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'section_id' => 'required|exists:sections,id',
        ]);

        $post = new Post();
        $post->titleart = $request->title;
        $post->body = $request->body;
        $post->idsection = $request->section_id;
        $post->teypsection = $request->section_id;
        $post->userid = Auth::id();

        // رفع الصورة محلياً
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/images'), $imageName);
            $post->imgart = $imageName;
        }

        // رفع الفيديو
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('uploads/videos'), $videoName);
            $post->fileVid = $videoName;
        } elseif ($request->video_link) {
            $post->link_video = $this->extractYoutubeId($request->video_link);
        }

        // رفع الصوت
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioName = time() . '_' . $audio->getClientOriginalName();
            $audio->move(public_path('uploads/audio'), $audioName);
            $post->fileAud = $audioName;
        }

        // رفع الكتاب
        if ($request->hasFile('book')) {
            $book = $request->file('book');
            $bookName = time() . '_' . $book->getClientOriginalName();
            $book->move(public_path('uploads/books'), $bookName);
            $post->books = $bookName;
        }

        $post->save();

        return redirect()->route('posts.section', $post->idsection)
            ->with('success', 'تم إضافة المنشور بنجاح');
    }

    /**
     * عرض منشور معين
     */
    public function show($id)
    {
        $post = Post::with(['section', 'comments.user'])->findOrFail($id);
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
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
            'section_id' => 'required|exists:sections,id',
        ]);

        $post = Post::findOrFail($id);
        $post->titleart = $request->title;
        $post->body = $request->body;
        $post->idsection = $request->section_id;
        $post->teypsection = $request->section_id;

        // تحديث الصورة محلياً
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/images'), $imageName);
            $post->imgart = $imageName;
        }

        // تحديث الفيديو
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('uploads/videos'), $videoName);
            $post->fileVid = $videoName;
        } elseif ($request->video_link) {
            $post->link_video = $this->extractYoutubeId($request->video_link);
        }

        // تحديث الصوت
        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioName = time() . '_' . $audio->getClientOriginalName();
            $audio->move(public_path('uploads/audio'), $audioName);
            $post->fileAud = $audioName;
        }

        // تحديث الكتاب
        if ($request->hasFile('book')) {
            $book = $request->file('book');
            $bookName = time() . '_' . $book->getClientOriginalName();
            $book->move(public_path('uploads/books'), $bookName);
            $post->books = $bookName;
        }

        $post->save();

        return redirect()->route('home')
            ->with('success', 'تم تحديث المنشور بنجاح');
    }

    /**
     * حذف منشور
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('home')
            ->with('success', 'تم حذف المنشور بنجاح');
    }

    /**
     * استخراج معرف يوتيوب من الرابط
     */
    private function extractYoutubeId($url)
    {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        return $matches[1] ?? $url;
    }
}
