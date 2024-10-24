<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all posts
            $posts = Post::all();
            $user = Auth::user();
           return view('post.list', compact('posts','user'));

    }
    public function create(){
        $user = Auth::user();
        return view('post.index',compact('user'));
    }
    public function store(Request $request)
    {
        if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('teacher'))) {

            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
            ]);
            // Create a new post
            Post::create($validatedData);
            // Return a success response
            return redirect()->back()->with('success', 'Post created successfully!');
        } else {
            // Return an error response if the user is not authorized
            return redirect()->back()->with('error', 'You are not authorized to create post');// 403 Forbidden status code
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('teacher') )) {

        $user = Auth::user();
        // Fetch the post and return the edit view
        $post = Post::findOrFail($id);

        return view('post.edit', compact('post','user'));
        } else {
            // Return an error response if the user is not authorized
            return redirect()->back()->with('error', 'You are not authorized to edit post');// 403 Forbidden status code
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (Auth::check() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('teacher'))) {

        // Validate and update the post
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($validatedData);

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }else {
        // Return an error response if the user is not authorized
        return redirect()->back()->with('error', 'You are not authorized to delete post');// 403 Forbidden status code
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Delete the post
        if (Auth::check() && (Auth::user()->hasRole('admin'))) {

        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
    else {
        // Return an error response if the user is not authorized
        return redirect()->back()->with('error', 'You are not authorized to edit post');// 403 Forbidden status code
    }
}
}
