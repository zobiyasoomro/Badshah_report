<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function platforms()
    {
        return view('pages.platforms');
    }

    public function planes()
    {
        return view('pages.planes');
    }

    public function blog()
    {
        return view('pages.blog');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    // User Profile Method
    public function userProfile()
    {
        // Get authenticated user
        $user = auth()->user();
        
        // If no user is logged in, redirect to login
        if (!$user) {
            return redirect()->route('auth.login.page');
        }
        
        return view('pages.userprofile', compact('user'));
    }
}