<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::where('name', 'TV Show')->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Get all posts related to the "TV Show" category
        $posts = $category->posts;

        return response()->json($posts);


    }

    public function getmovies()
    {
        $category = Category::where('name', 'Movie')->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);


        }
        $posts = $category->posts;

        // dd  ($posts);

        return response()->json($posts);
    }


    public function getdocumentaries()
    {
        $category = Category::where('name', 'Documentary')->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);

        }

        $posts = $category->posts;

        return response()->json($posts);


    }

    public function getcategory()
    {
        $categories = Category::all(); // Fix: assign to $categories instead of $all
        return response()->json(['categories' => $categories]);
    }


    /**
     * Show the form for creating a new resource.
     */



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();

        $data = $request->validate([
            'name' => 'required',
        ]);

        $category::create($data);



        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json(Category::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
