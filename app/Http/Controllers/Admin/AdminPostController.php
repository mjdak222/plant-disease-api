<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    private function checkAdmin()
    {
        if (!(auth()->check() && auth()->user()->id === 5)) {
            abort(403, 'غير مسموح لك بالدخول هنا');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $posts = Post::with('user')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $this->checkAdmin();
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($data);
        return redirect()->route('posts.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Post $post)
    {
        $this->checkAdmin();
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->checkAdmin();

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);
        return redirect()->route('posts.index')->with('success', 'تم التعديل بنجاح');
    }

    public function destroy(Post $post)
    {
        $this->checkAdmin();
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'تم الحذف بنجاح');
    }
}
