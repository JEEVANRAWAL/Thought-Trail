<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreblogsRequest;
use App\Http\Requests\UpdateblogsRequest;
use App\Models\blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
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
    public function create(Request $request)
    {
        $blogContent= $request->content;
        // $truncatedContent = substr($request->input('content'), 0); // Adjust the length (255) as needed

       
        blogs::create([
            'content'=> $blogContent
        ]);
        return response()->json(['message' => 'Blog post created successfully'], 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreblogsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(blogs $blogs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blogs $blogs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateblogsRequest $request, blogs $blogs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blogs $blogs)
    {
        //
    }
}
