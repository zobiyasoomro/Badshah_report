<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PlaneBuyer;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneBuyerController extends Controller
{
    // Sabhi buyers ka data fetch karne ke liye
    public function index()
    {
        $buyers = PlaneBuyer::with(['user', 'plane'])->latest()->get();
        return view('admin.pages.plane_buyers.index', compact('buyers'));
    }

    // Form data submit aur image upload handle karne ke liye method
    public function store(Request $request)
    {
        // 1. Validation rules
        $request->validate([
            'plane_id'   => 'required|exists:planes,id',
            'screenshot' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Plane ki price database se nikalna (Taki buyers table me automatic chali jaye)
        $plane = Plane::findOrFail($request->plane_id);

        // 3. Image Handle aur Upload logic
        $screenshotPath = null;
        if ($request->hasFile('screenshot')) {
            $file = $request->file('screenshot');

            // Unique filename banana timestamp ke sath
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Required path: public/plane_screenshot
            $destinationPath = public_path('plane_screenshot/');

            // Agar folder nahi bana hua toh auto-create ho jaye
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // File ko public path me move karna
            $file->move($destinationPath, $filename);

            // DB me relative path save karne ke liye structure
            $screenshotPath = 'plane_screenshot/' . $filename;
        }

        // 4. Data database (plane_buyers table) me insert karna
        PlaneBuyer::create([
            'user_id'    => auth()->id(), // Jo user login hai uski ID
            'plane_id'   => $request->plane_id,
            'screenshot' => $screenshotPath,
            'price'      => $plane->price, // Plane table se automatic price fetch ho kar save hogi
        ]);

        // 5. Success response ke sath wapas bhejna
        return redirect()->back()->with('success', 'Details submitted successfully! Waiting for approval.');
    }
}