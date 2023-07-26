<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostEditResource;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        return PostResource::collection(Post::latest()->get());
    }

    public function create()
    {
        $post = Post::create([
            'title' => 'Untitled'
        ]);

        return new PostResource($post);
    }

    public function edit(Post $post)
    {
        return new PostEditResource($post);
    }

    public function update(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'excerpt' => 'nullable',
            'slug' => 'required|string|unique:posts,slug,' . $post->id,
            'body' => 'nullable',
            'published' => 'boolean',
        ]);

        $post->update($request->only('title', 'slug', 'excerpt', 'body', 'published'));
    }
}
