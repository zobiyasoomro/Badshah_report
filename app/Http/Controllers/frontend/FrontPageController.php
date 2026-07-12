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
    public function blog()
    {
        return view('pages.blog');
    }


    public function contact()
    {
        return view('pages.contact');
    }
}