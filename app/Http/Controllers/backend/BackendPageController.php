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

    public function planes()
{
    // Database se saare real planes ka data nikalna (Latest pehle dikhane ke liye latest() use kar sakte hain)
    $planes = Plane::latest()->get(); 

    // View file ko real data ke sath return karna
    return view('admin.pages.planes.index', compact('planes'));
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