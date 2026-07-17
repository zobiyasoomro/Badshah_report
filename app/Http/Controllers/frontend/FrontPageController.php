<?php

namespace App\Http\Controllers\frontend;  // <-- lowercase 'frontend'

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\Blog;
use App\Models\Platform;

class FrontPageController extends Controller
{
    public function home()
    {
        $user = auth()->user();
        return view('pages.home', compact('user'));
    }

    public function about()
    {
        $about = AboutPage::first();
        if (!$about) {
            $about = new AboutPage();
        }
        return view('pages.about', compact('about'));
    }

    public function platforms()
    {
        try {
            \Log::info('Platforms method called');
            $platforms = Platform::where('status', 1)->orderBy('id')->get();
            \Log::info('Platforms found: ' . $platforms->count());
            return view('pages.platforms', compact('platforms'));
        } catch (\Exception $e) {
            \Log::error('Platforms error: ' . $e->getMessage());
            $platforms = collect([]);
            return view('pages.platforms', compact('platforms'));
        }
    }

    public function planes()
    {
        return view('pages.planes');
    }

    public function blog()
    {
        $blogs = Blog::all();
        return view('pages.blog', compact('blogs'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function userProfile()
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('auth.auth')->with('error', 'Please login to view your profile.');
        }
        return view('pages.userprofile', compact('user'));
    }
}