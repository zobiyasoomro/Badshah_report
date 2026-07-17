<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show registered (non-admin) users to the admin, newest first.
     */
    public function index()
    {
        $users = User::where('user_name', '!=', 'betproadmin')->latest()->get();

        return view('admin.pages.user.index', compact('users'));
    }

    /**
     * Delete a user account. Admin accounts are protected from deletion here.
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Admin accounts cannot be deleted from this page.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Admin-set a new password for a user.
     * Note: no Hash::make() here — the User model casts 'password' => 'hashed',
     * so Eloquent hashes it automatically on save. Hashing it manually here
     * would double-hash and lock the user out.
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user->password = $request->password;
        $user->save();

        return back()->with('success', 'Password updated for ' . $user->name . '.');
    }
}