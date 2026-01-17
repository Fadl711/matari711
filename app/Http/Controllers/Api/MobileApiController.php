<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class MobileApiController extends Controller
{
    /**
     * قائمة جميع الأقسام
     */
    public function sections()
    {
        $sections = Section::withCount('posts')->get()->map(function ($section) {
            return [
                'id' => $section->id,
                'name' => $section->section_Name,
                'icon' => $section->icon,
                'posts_count' => $section->posts_count,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $sections
        ]);
    }

    /**
     * قائمة المنشورات حسب القسم
     */
    public function posts($sectionId, Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $posts = Post::where('idsection', $sectionId)
            ->with(['user:id,name', 'section:id,section_Name'])
            ->withCount('comments')
            ->latest()
            ->paginate($perPage);

        $posts->getCollection()->transform(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->titleart,
                'excerpt' => $post->excerpt,
                'image' => $post->image,
                'author' => $post->user?->name,
                'section' => $post->section?->section_Name,
                'likes_count' => $post->likes_count,
                'comments_count' => $post->comments_count,
                'created_at' => $post->created_at->format('Y-m-d H:i'),
                'created_at_human' => $post->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $posts->items(),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    /**
     * تفاصيل منشور معين
     */
    public function postDetail($id)
    {
        $post = Post::with(['user:id,name', 'section:id,section_Name'])
            ->withCount('comments')
            ->find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'المنشور غير موجود'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $post->id,
                'title' => $post->titleart,
                'body' => $post->body,
                'image' => $post->image,
                'video' => $post->link_video,
                'video_file' => $post->fileVid ? asset('uploads/videos/' . $post->fileVid) : null,
                'audio_file' => $post->fileAud ? asset('uploads/audio/' . $post->fileAud) : null,
                'books' => $post->books ? asset('uploads/books/' . $post->books) : null,
                'author' => $post->user?->name,
                'section' => $post->section?->section_Name,
                'section_id' => $post->idsection,
                'likes_count' => $post->likes_count,
                'comments_count' => $post->comments_count,
                'created_at' => $post->created_at->format('Y-m-d H:i'),
                'created_at_human' => $post->created_at->diffForHumans(),
            ]
        ]);
    }

    /**
     * التعليقات على منشور
     */
    public function comments($id, Request $request)
    {
        $perPage = $request->get('per_page', 20);

        $comments = Comment::where('post_id', $id)
            ->with('user:id,name')
            ->latest()
            ->paginate($perPage);

        $comments->getCollection()->transform(function ($comment) {
            return [
                'id' => $comment->id,
                'content' => $comment->content,
                'author' => $comment->user?->name ?? 'مستخدم',
                'created_at' => $comment->created_at->format('Y-m-d H:i'),
                'created_at_human' => $comment->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $comments->items(),
            'pagination' => [
                'current_page' => $comments->currentPage(),
                'last_page' => $comments->lastPage(),
                'per_page' => $comments->perPage(),
                'total' => $comments->total(),
            ]
        ]);
    }

    /**
     * أحدث المنشورات (للصفحة الرئيسية)
     */
    public function latestPosts(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $posts = Post::with(['user:id,name', 'section:id,section_Name'])
            ->withCount('comments')
            ->latest()
            ->paginate($perPage);

        $posts->getCollection()->transform(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->titleart,
                'excerpt' => $post->excerpt,
                'image' => $post->image,
                'author' => $post->user?->name,
                'section' => $post->section?->section_Name,
                'section_id' => $post->idsection,
                'likes_count' => $post->likes_count,
                'comments_count' => $post->comments_count,
                'created_at' => $post->created_at->format('Y-m-d H:i'),
                'created_at_human' => $post->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $posts->items(),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }

    /**
     * البحث في المنشورات
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $perPage = $request->get('per_page', 10);

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'يجب إدخال كلمة البحث'
            ], 400);
        }

        $posts = Post::where(function ($q) use ($query) {
            $q->where('titleart', 'like', "%{$query}%")
                ->orWhere('body', 'like', "%{$query}%");
        })
            ->with(['user:id,name', 'section:id,section_Name'])
            ->withCount('comments')
            ->latest()
            ->paginate($perPage);

        $posts->getCollection()->transform(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->titleart,
                'excerpt' => $post->excerpt,
                'image' => $post->image,
                'author' => $post->user?->name,
                'section' => $post->section?->section_Name,
                'section_id' => $post->idsection,
                'likes_count' => $post->likes_count,
                'comments_count' => $post->comments_count,
                'created_at' => $post->created_at->format('Y-m-d H:i'),
                'created_at_human' => $post->created_at->diffForHumans(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $posts->items(),
            'pagination' => [
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'per_page' => $posts->perPage(),
                'total' => $posts->total(),
            ]
        ]);
    }
}
