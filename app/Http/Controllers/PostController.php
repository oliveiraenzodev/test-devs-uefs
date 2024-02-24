<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public readonly Post $post;

    public function __construct()
    {
       $this -> post = new Post();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('tags')->get();

        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Validates and store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();

        $this->post->user_id = auth()->user()->id;
        $this->post->title = $request->title;
        $this->post->description = $request->description;

        $this->post->save();

        return redirect()->route('posts.index')->with('success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);

        return view('posts.edit',['post' => $post]);
    }

    /**
     * Validate and update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $request->validated();

        $post->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        return redirect()->route('posts.index')->with('success','Post edited successfull');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::find($id);

        $post->tags()->detach();

        $post->delete();

        return redirect()->route('posts.index')->with('success','Post deleted successfull');
    }
}
