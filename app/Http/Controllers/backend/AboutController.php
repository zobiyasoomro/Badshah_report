<?php

namespace App\Http\Controllers\Backend;

use App\Models\AboutPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::first();
        return view('pages.about', compact('about'));
    }

    public function edit()
    {
        $about = AboutPage::first();
        return view('admin.pages.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        $about = AboutPage::firstOrNew(['id' => 1]);

        $about->title = $request->title;
        $about->subtitle = $request->subtitle;
        $about->description = $request->description;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete the old logo file from public/images if one exists
            if ($about->logo && file_exists(public_path($about->logo))) {
                @unlink(public_path($about->logo));
            }

            $file = $request->file('logo');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Move file to public/images directory
            $file->move(public_path('images'), $filename);

            // Store the relative path so asset($about->logo) resolves correctly
            $about->logo = 'images/' . $filename;
        }

        $about->save();

        return redirect()->route('admin.about')->with('success', 'About Page Updated Successfully!');
    }
}