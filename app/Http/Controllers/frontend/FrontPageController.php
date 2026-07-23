<?php

namespace App\Http\Controllers\frontend;  // <-- lowercase 'frontend'

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\Blog;
use App\Models\Platform;
use App\Models\Plane;

class FrontPageController extends Controller
{
    public function home()
    {
        $user = auth()->user();
        // Fetch the reviews here
        $reviews = \App\Models\Review::all();

        // Pass both $user and $reviews to the view in one statement
        return view('pages.home', compact('user', 'reviews'));
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
        // 'user' relation ko saath fetch karna zaroori hai (with use karein)
        $planes = Plane::with('user')->get();

        return view('pages.planes', compact('planes'));
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

    public function depositHistory()
    {
        return view('pages.deposit_history');
    }

    public function withdrawHistory()
    {
        return view('pages.withdraw_history');
    }
}