<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MyList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getmylist()
    {
        $videos = MyList::with('post') // Assuming you have a 'post' relationship defined
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($videos->map(function ($item) {
            return $item->post; // Ensure the 'post' data includes 'file'
        }));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        // $validatedData = $request->validate([
        //     'file' => 'required|file', // Validation for video upload
        //     // 'category_id' => 'nullable|exists:categories,id', // If using categories
        // ]);

        // $data = [
        //     'file' => $request->file('file'),
        // ];

        // // Handle file upload
        // if ($request->hasFile('file')) {
        //     $path = $request->file('file')->store('videos', 'public');
        //     $data['file'] = $path;
        // }

        // $data['user_id'] = auth()->id();
        // // Optionally set a category_id if applicable
        // // $data['category_id'] = $request->input('category_id', null); // Ensure you handle categories as needed

        // // Store the video in the posts table
        // $post = Post::create($data);

        // Check if the user wants to add the video to their "My List"
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        // Check if the user wants to add the video to their "My List"
        $post = Post::find($request->input('post_id'));

        if ($post) {
            MyList::create([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
            ]);
        }

        return response()->json(['message' => 'Video added to My List.'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(MyList $myList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyList $myList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyList $myList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyList $myList)
    {
        //
    }
}
