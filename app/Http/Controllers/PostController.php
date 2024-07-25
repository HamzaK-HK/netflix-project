<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getposts()
    {
        $posts = Post::all(); // Fetch posts (you might want to use pagination here)
        // dd($posts);
        return $posts;
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function index()
    // {
    //     return view('home');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string',
            'file' => 'required|file',
            'category_id' => 'required', // Add max length if applicable
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('videos', 'public');
            $validatedData['file'] = $path;
        }

        // Add the authenticated user's ID to the validated data
        $validatedData['user_id'] = auth()->id();
        // dd($validatedData);

        // Store the validated data in the database
        $post = Post::create($validatedData);

        return redirect()->route('admin')->with(['success', 'Post created successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
