<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // إضافة تعليق
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return response()->json($comment->load('user'));
    }

    // 🔹 جلب التعليقات الخاصة ببوست معين
    public function index(Post $post)
    {
        $comments = $post->comments()->with('user')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $comments
        ]);
    }
}
