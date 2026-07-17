<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.pages.blog.index', compact('blogs'));
    }

    // public function index()
    // {
    //     // Fetch all blogs from database
    //     $blogs = Blog::all();
        
    //     // Pass blogs to the view
    //     return view('pages.blog', compact('blogs'));
    // }

    /**
     * Show the blog create form.
     */
    public function create()
    {
        return view('admin.pages.blog.create');
    }

    /**
     * Show the blog edit form.
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.pages.blog.edit', compact('blog'));
    }

    /**
     * Store a newly created blog.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Max 2MB
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();

            // Move image to public/blogs directory
            $image->move(public_path('blogs'), $imageName);
        }

        // Create blog
        $blog = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // Redirect with success message
        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog created successfully!');
    }

    /**
     * Update the specified blog.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image && file_exists(public_path('blogs/' . $blog->image))) {
                unlink(public_path('blogs/' . $blog->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->title) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('blogs'), $imageName);

            $blog->image = $imageName;
        }

        // Update blog
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->save();

        // Redirect with success message
        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog updated successfully!');
    }
    // In BackendPageController.php
    public function blog()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.pages.blog.index', compact('blogs'));
    }

    /**
     * Delete the specified blog.
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Delete image if exists
        if ($blog->image && file_exists(public_path('blogs/' . $blog->image))) {
            unlink(public_path('blogs/' . $blog->image));
        }

        // Delete blog
        $blog->delete();

        // Redirect with success message
        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog deleted successfully!');
    }
}