<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // عرض المقالات مع العدّادات
    public function index()
    {
        $posts = Post::with(['comments.user', 'likes'])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->get();

        return response()->json($posts);
    }

    // إنشاء مقال (مؤقت للتجربة – لاحقاً من الداشبورد فقط)
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create([
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id() ?? 1, // مؤقت
        ]);

        return response()->json([
            'message' => 'تم إنشاء المقال بنجاح',
            'post'    => $post
        ], 201);
    }
}
