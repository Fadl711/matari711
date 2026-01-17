<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * البحث المباشر (Live Search - AJAX)
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'success' => true,
                'posts' => [],
            ]);
        }

        $posts = Post::where('titleart', 'LIKE', "%{$query}%")
            ->orWhere('body', 'LIKE', "%{$query}%")
            ->with('section')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->titleart,
                    'excerpt' => mb_substr(strip_tags($post->body ?? ''), 0, 100) . '...',
                    'section' => $post->section->name ?? '',
                    'image' => $post->image,
                    'url' => route('posts.show', $post->id),
                ];
            });

        return response()->json([
            'success' => true,
            'posts' => $posts,
        ]);
    }
}
