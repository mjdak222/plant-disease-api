<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller; // ✅ هذا Controller الصحيح


use Illuminate\Http\Request;



class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // إضافة لايك
    public function store(Post $post)
    {
        $user = auth()->user();

        if ($post->likes()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'Already liked'], 400);
        }

        $post->likes()->create(['user_id' => $user->id]);

        return response()->json([
            'message'     => 'Liked successfully',
            'likes_count' => $post->likes()->count(),
        ]);
    }

    // إزالة لايك
    public function destroy(Post $post)
    {
        $user = auth()->user();

        $like = $post->likes()->where('user_id', $user->id)->first();
        if (!$like) {
            return response()->json(['message' => 'You have not liked this post'], 400);
        }

        $like->delete();

        return response()->json([
            'message'     => 'Unliked successfully',
            'likes_count' => $post->likes()->count(),
        ]);
    }
}

