<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    /**
     * Store a new review
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string|min:10|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Handle image upload
        $imageName = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();

            // Store in public/reviews directory
            $image->move(public_path('reviews'), $imageName);
        }

        // Create the review
        $review = Review::create([
            'name' => $validated['name'],
            'rating' => $validated['rating'],
            'description' => $validated['description'],
            'image' => $imageName,
            'status' => 'pending'
        ]);

        // Return for web (redirect back)
        return redirect()->back()->with('success', 'Review submitted successfully! Your review will be published after approval.');
    }

    /**
     * Get all approved reviews (for frontend)
     */
    public function getApprovedReviews()
    {
        $reviews = Review::approved()
            ->orderBy('created_at', 'desc')
            ->get();

        $reviews->each(function ($review) {
            $review->stars = $review->stars;
            $review->initials = $review->initials;
            $review->image_url = $review->image_url;
        });

        return response()->json([
            'success' => true,
            'reviews' => $reviews
        ]);
    }

    /**
     * Get all reviews (admin)
     */
    public function index()
    {
        // Use paginate instead of get
        $reviews = Review::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pages.reviews.index', compact('reviews'));
    }

    /**
     * Update review status (admin) - FIXED for form submission
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $review = Review::findOrFail($id);
        $review->status = $request->status;
        $review->save();

        return response()->json(['success' => true, 'message' => 'Status updated!']);
    }

    /**
     * Delete a review (admin)
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Delete image if exists
        if ($review->image && file_exists(public_path('reviews/' . $review->image))) {
            @unlink(public_path('reviews/' . $review->image));
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }

    /**
     * Bulk approve reviews (admin)
     */
    public function bulkApprove(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:reviews,id'
        ]);

        Review::whereIn('id', $request->ids)->update(['status' => 'approved']);

        return response()->json([
            'success' => true,
            'message' => 'Reviews approved successfully!'
        ]);
    }
}