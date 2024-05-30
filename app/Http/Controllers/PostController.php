<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Post;


class PostController extends Controller
{

    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $allPosts = Post::all();
        
        return view('posts.index', ['allPosts' => $allPosts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        };
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10']
        ]);
        
        $validated['user_id'] = auth()->id();

        Post::create($validated);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //$post = Post::findOrFail($post->id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        /* if (auth()->id !== $post->user_id) {
            abort(404);
        } */
        
        Gate::authorize('update', $post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);
        /* if (auth()->id !== $post->user_id) {
            abort(404);
        } */
        $validateData = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10']
        ]);

        $post->update($validateData);
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        /* if (auth()->id !== $post->user_id) {
            abort(404);
        } */
        Gate::authorize('delete', $post);
        
        $post->delete();
        return redirect()->route('posts.index')->with('error', 'Post Deleted!');
    }
}
