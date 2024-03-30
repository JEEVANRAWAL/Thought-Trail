<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rowsPerPage= $request->input('rowsPerPage', 10); // two is default value incase if rowsperpage key is not available with its value
        $currentPage = $request->input('page', 1);

        $Blogs= Blog::paginate($rowsPerPage, ['*'], 'page', $currentPage);
        return response()->json($Blogs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $blogContent= $request->content;
        // $truncatedContent = substr($request->input('content'), 0); // Adjust the length (255) as needed
        $title= $request->title;
        $post= $request->post;
        $featuredImageFile= $request->file('featuredImage');
        $metaDescription= $request->metaDescription;
        $post_excerpt= $request->post_excerpt;
        $usedImages= $request->usedImages;
        $insertedImgs= $request->insertedImgs;
        //$isImageUsed= false;
        
        // return response()->json(['message' => $insertedImgs], 200);
        //handling feature image
        $FeaturedImageNewName= 'featuredImg'.time().'.'.$featuredImageFile->getClientOriginalExtension();
        $featuredImageFile->storeAs('public/featuredImages', $FeaturedImageNewName);
        $FeaturedImageUrl= url('storage/featuredImages/'.$FeaturedImageNewName);
        
        if($insertedImgs && $usedImages){

            // Find and delete non-used images
            $nonUsedImages = array_diff($insertedImgs, $usedImages);
            foreach ($nonUsedImages as $imageUrl) {
            $imageName = basename($imageUrl);
            Image::where('name', $imageName)->delete();
            $imagePath = public_path('postImages/' . $imageName);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            } else {
                // Log or handle the case where the file doesn't exist
                // \Log::warning("File not found in folder: $imagePath");
            }
            }
        }
        
       
        Blog::create([
            'user_id'=> 1,
            'title'=> $title,
            'post'=> $post,
            'featuredImage'=>$FeaturedImageUrl,
            'metaDescription'=>$metaDescription,
            'post_excerpt'=>$post_excerpt
        ]);
        return response()->json(['message' => 'Blog post created successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
