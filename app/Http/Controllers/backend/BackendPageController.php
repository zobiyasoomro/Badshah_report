<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use Illuminate\Support\Facades\Auth;

class BackendPageController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function about()
    {
        // Fetch the about data
        $about = AboutPage::first();
        return view('admin.pages.about.index', compact('about'));
    }

    public function platforms()
    {
        return view('admin.pages.platforms.index');
    }

    public function contact()
    {
        return view('admin.pages.contact.index');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.pages.profile.index', compact('user'));
    }
}