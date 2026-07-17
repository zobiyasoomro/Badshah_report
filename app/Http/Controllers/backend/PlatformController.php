<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlatformController extends Controller
{
    /**
     * List all platforms for the admin table.
     */
    public function index()
    {
        $platforms = Platform::orderBy('id')->get();
        return view('admin.pages.platforms.index', compact('platforms'));
    }

    /**
     * Show the "Add New Platform" form.
     */
    public function create()
    {
        return view('admin.pages.platforms.create');
    }

    /**
     * Save a new platform.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:1000',
            'description' => 'required|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'join_url'    => 'nullable|url|max:255',
            'status'      => 'required|boolean',
        ]);

        // Enforce 30-word limit on subtitle
        $subtitle = $request->subtitle;
        if ($subtitle && str_word_count($subtitle) > 30) {
            $subtitle = implode(' ', array_slice(explode(' ', $subtitle), 0, 30));
        }

        $platform = new Platform();
        $platform->name        = $validated['name'];
        $platform->subtitle    = $subtitle;
        $platform->description = $validated['description'];
        $platform->join_url    = $validated['join_url'] ?? null;
        $platform->status      = $validated['status'];

        if ($request->hasFile('logo')) {
            $platform->logo = $this->storeLogo($request);
        }

        $platform->save();

        return redirect()
            ->route('admin.platforms')
            ->with('success', 'Platform added successfully.');
    }

    /**
     * Show the edit form for a single platform.
     */
    public function edit(Platform $platform)
    {
        return view('admin.pages.platforms.edit', compact('platform'));
    }

    /**
     * Update an existing platform.
     */
    public function update(Request $request, Platform $platform)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:1000',
            'description' => 'required|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'join_url'    => 'nullable|url|max:255',
            'status'      => 'required|boolean',
        ]);

        // Enforce 30-word limit on subtitle
        $subtitle = $request->subtitle;
        if ($subtitle && str_word_count($subtitle) > 30) {
            $subtitle = implode(' ', array_slice(explode(' ', $subtitle), 0, 30));
        }

        $platform->name        = $validated['name'];
        $platform->subtitle    = $subtitle;
        $platform->description = $validated['description'];
        $platform->join_url    = $validated['join_url'] ?? null;
        $platform->status      = $validated['status'];

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($platform->logo && file_exists(public_path($platform->logo))) {
                @unlink(public_path($platform->logo));
            }
            $platform->logo = $this->storeLogo($request);
        }

        $platform->save();

        return redirect()
            ->route('admin.platforms')
            ->with('success', 'Platform updated successfully.');
    }

    /**
     * Delete a platform and its logo file.
     */
    public function destroy(Platform $platform)
    {
        if ($platform->logo && file_exists(public_path($platform->logo))) {
            @unlink(public_path($platform->logo));
        }

        $platform->delete();

        return back()->with('success', 'Platform deleted successfully.');
    }

    /**
     * Move the uploaded logo into public/platforms and return its relative path.
     */
    private function storeLogo(Request $request): string
    {
        $file = $request->file('logo');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getClientOriginalName());
        
        // Move to public/platforms directory
        $file->move(public_path('platforms'), $filename);

        return 'platforms/' . $filename;
    }
}