<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'description' => $request->description,
            'is_read' => false, // New contacts are unread
        ]);

        return back()->with('success', 'Message sent successfully!');
    }

    /**
     * Show all contact messages to the admin, newest first.
     * Mark all as read when viewing the page.
     */
    public function index()
    {
        // Get all contacts
        $contacts = Contact::latest()->get();
        
        // Mark all unread as read when admin views the page
        Contact::where('is_read', false)->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        return view('admin.pages.contact.index', compact('contacts'));
    }

    /**
     * Delete a single contact message.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Message deleted successfully.');
    }

    /**
     * Get unread contacts count for header notification
     */
    public static function getUnreadCount()
    {
        return Contact::where('is_read', false)->count();
    }

    /**
     * Get recent unread contacts for header notification dropdown
     * ADD THIS METHOD - It was missing
     */
    public static function getRecentUnreadContacts($limit = 5)
    {
        return Contact::where('is_read', false)
            ->latest()
            ->take($limit)
            ->get();
    }

    /**
     * Mark a specific contact as read (via AJAX)
     */
    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update([
            'is_read' => true,
            'read_at' => now()
        ]);
        
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        
        return redirect()->back()->with('success', 'Message marked as read.');
    }

    /**
     * Mark all contacts as read
     */
    public function markAllAsRead()
    {
        Contact::where('is_read', false)->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        return redirect()->back()->with('success', 'All messages marked as read.');
    }
}