<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendPageController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function about()
    {
        return view('admin.pages.about.index');
    }

    public function platforms()
    {
        return view('admin.pages.platforms.index');
    }

    public function blog()
    {
        return view('admin.pages.blog.index');
    }

    public function contact()
    {
        return view('admin.pages.contact.index');
    }
}