<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * إضافة تعليق جديد (AJAX)
     */
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $postId,
            'user_id' => Auth::id(),
        ]);

        // إرجاع بيانات التعليق للعرض
        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'comment' => $comment->comment,
                'user_name' => Auth::user()->name,
                'created_at' => $comment->created_at->diffForHumans(),
            ]
        ]);
    }

    /**
     * إعجاب أو إلغاء إعجاب (AJAX)
     */
    public function like(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $userId = Auth::id();

        // البحث عن إعجاب موجود
        $existingLike = Like::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($existingLike) {
            // إلغاء الإعجاب
            $existingLike->delete();
            $liked = false;
        } else {
            // إضافة إعجاب جديد
            Like::create([
                'post_id' => $postId,
                'user_id' => $userId,
                'print_like' => 1,
            ]);
            $liked = true;
        }

        // حساب إجمالي الإعجابات
        $totalLikes = Like::where('post_id', $postId)->count();

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'total_likes' => $totalLikes,
        ]);
    }
}
