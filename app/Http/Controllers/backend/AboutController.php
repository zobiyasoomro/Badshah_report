<?php

namespace App\Http\Controllers\Backend;

use App\Models\AboutPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::first();
        return view('pages.about', compact('about'));
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
        $about->button_text = $request->button_text;
        $about->button_url = $request->button_url;

        if ($request->hasFile('logo')) {
            $about->logo = $request->file('logo')->store('about', 'public');
        }

        $about->save();

        return back()->with('success', 'About Page Updated Successfully!');
    }
}