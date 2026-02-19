<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * عرض الصفحة الرئيسية
     */
    public function welcome()
    {
        // جلب الأقسام الرئيسية فقط (parent_id = null) مع أقسامها الفرعية
        $sections = Section::whereNull('parent_id')
            ->orderBy('sort_order')
            ->with(['children', 'posts' => function ($query) {
                $query->orderBy('is_pinned', 'desc')->latest()->take(6);
            }])
            ->get();

        return view('posts.welcome', compact('sections'));
    }

    /**
     * عرض جميع منشورات قسم معين
     */
    public function showSection($id)
    {
        $section = Section::with('children')->findOrFail($id);

        // إذا كان قسم رئيسي، اجلب منشوراته + منشورات أقسامه الفرعية
        if ($section->is_parent) {
            $childIds = $section->children->pluck('id')->toArray();
            $allIds = array_merge([$id], $childIds);
            $posts = Post::whereIn('idsection', $allIds)
                ->orderBy('is_pinned', 'desc')
                ->latest()
                ->paginate(9);
        } else {
            // قسم فرعي: فقط منشوراته
            $posts = Post::where('idsection', $id)
                ->orderBy('is_pinned', 'desc')
                ->latest()
                ->paginate(9);
        }

        return view('posts.section', compact('section', 'posts'));
    }

    /**
     * عرض صفحة إنشاء قسم/منشور (لوحة التحكم)
     */
    public function create()
    {
        $sections = Section::orderBy('sort_order')->get();
        return view('admin.create', compact('sections'));
    }

    /**
     * حفظ قسم جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:sections,id',
        ]);

        // حساب الترتيب التلقائي
        $maxOrder = Section::where('parent_id', $request->parent_id)->max('sort_order') ?? 0;

        Section::create([
            'section_Name' => $request->name,
            'parent_id' => $request->parent_id,
            'sort_order' => $maxOrder + 1,
        ]);

        $message = $request->parent_id
            ? 'تم إضافة القسم الفرعي بنجاح'
            : 'تم إضافة القسم بنجاح';

        return back()->with('success', $message);
    }

    /**
     * تحديث قسم
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:sections,id',
        ]);

        $section = Section::findOrFail($id);

        // منع القسم من أن يكون أباً لنفسه
        if ($request->parent_id == $id) {
            return back()->with('error', 'لا يمكن أن يكون القسم أباً لنفسه');
        }

        $section->update([
            'section_Name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

        return back()->with('success', 'تم تحديث القسم بنجاح');
    }

    /**
     * حذف قسم
     */
    public function destroy($id)
    {
        $section = Section::findOrFail($id);

        // حذف جميع البيانات المرتبطة بالمنشورات التابعة للقسم
        foreach ($section->posts as $post) {
            $post->comments()->delete();
            $post->likes()->delete();
        }

        // حذف جميع المنشورات المرتبطة بالقسم
        $section->posts()->delete();

        // حذف الأقسام الفرعية ومنشوراتها
        foreach ($section->children as $child) {
            foreach ($child->posts as $post) {
                $post->comments()->delete();
                $post->likes()->delete();
            }
            $child->posts()->delete();
            $child->delete();
        }

        // ثم حذف القسم
        $section->delete();

        return back()->with('success', 'تم حذف القسم وجميع الأقسام الفرعية والمنشورات المرتبطة بنجاح');
    }

    /**
     * إعادة ترتيب الأقسام (AJAX)
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:sections,id',
            'sections.*.sort_order' => 'required|integer',
        ]);

        foreach ($request->sections as $item) {
            Section::where('id', $item['id'])->update(['sort_order' => $item['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'تم تحديث الترتيب بنجاح']);
    }
}
