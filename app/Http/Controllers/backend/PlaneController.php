<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    // GET /admin/planes -> admin.planes
    public function index()
    {
        $planes = Plane::latest()->get();
        return view('admin.pages.planes.index', compact('planes'));
    }

    // GET /admin/planes/create -> admin.planes.create
    public function create()
    {
        return view('admin.pages.planes.create');
    }

    // POST /admin/planes -> admin.planes.store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'price'             => 'required|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('plane_images/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);
            $validated['image'] = 'plane_images/' . $filename;
        }

        $validated['user_id'] = auth()->id();

        Plane::create($validated);

        return redirect()->route('admin.planes')->with('success', 'Plane tier created successfully.');
    }

    // GET /admin/planes/{plane}/edit -> admin.planes.edit
    public function edit(Plane $plane)
    {
        return view('admin.pages.planes.edit', compact('plane'));
    }

    // PUT /admin/planes/{plane} -> admin.planes.update
    public function update(Request $request, Plane $plane)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'price'             => 'required|numeric|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('plane_images/');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);
            $validated['image'] = 'plane_images/' . $filename;

            // Remove old image if it exists
            if ($plane->image && file_exists(public_path($plane->image))) {
                unlink(public_path($plane->image));
            }
        }

        $plane->update($validated);

        return redirect()->route('admin.planes')->with('success', 'Plane tier updated successfully.');
    }

    // DELETE /admin/planes/{plane} -> admin.planes.destroy
    public function destroy(Plane $plane)
    {
        if ($plane->image && file_exists(public_path($plane->image))) {
            unlink(public_path($plane->image));
        }

        $plane->delete();

        return redirect()->route('admin.planes')->with('success', 'Plane tier deleted successfully.');
    }
}