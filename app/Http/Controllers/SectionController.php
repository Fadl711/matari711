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
        $sections = Section::with(['posts' => function ($query) {
            $query->latest()->take(6);
        }])->get();

        return view('posts.welcome', compact('sections'));
    }

    /**
     * عرض جميع منشورات قسم معين
     */
    public function showSection($id)
    {
        $section = Section::findOrFail($id);
        $posts = Post::where('idsection', $id)
            ->latest()
            ->paginate(9);

        return view('posts.section', compact('section', 'posts'));
    }

    /**
     * عرض صفحة إنشاء قسم/منشور (لوحة التحكم)
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.create', compact('sections'));
    }

    /**
     * حفظ قسم جديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Section::create([
            'section_Name' => $request->name,
        ]);

        return back()->with('success', 'تم إضافة القسم بنجاح');
    }
}
