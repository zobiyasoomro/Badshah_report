<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Remove: use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $availableUsers = UserAccount::all();
        return view('auth.auth', compact('availableUsers'));
    }

    public function register(Request $request)
    {
        // Validate the incoming request including all contact and social fields
        $request->validate([
            'user_name' => 'required|string|exists:user_accounts,user_account',
            'password' => 'required|string|min:8',
            'full_name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'city' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email',

            // --- CONTACT INFO FIELDS ---
            'address' => 'nullable|string|max:500',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',

            // --- SOCIAL PROFILES FIELDS ---
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
        ]);

        try {
            // Start transaction
            DB::beginTransaction();

            // Get the user account
            $userAccount = UserAccount::where('user_account', $request->user_name)->first();

            if (!$userAccount) {
                throw new \Exception('User account not found!');
            }

            // Check if this user already exists in users table
            $existingUser = User::where('user_name', $request->user_name)->first();

            if ($existingUser) {
                // If user already exists, update their details
                $existingUser->update([
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'whatsapp_number' => $request->whatsapp,
                    'city' => $request->city,

                    // --- CONTACT INFO FIELDS ---
                    'address' => $request->address,
                    'state' => $request->state,
                    'country' => $request->country,

                    // --- SOCIAL PROFILES FIELDS ---
                    'linkedin_url' => $request->linkedin_url,
                    'instagram_url' => $request->instagram_url,
                    'twitter_url' => $request->twitter_url,
                    'facebook_url' => $request->facebook_url,

                    // STORE PASSWORD IN PLAIN TEXT (NO HASH)
                    'password' => $request->password,
                    'register_account' => 1,
                    'unregister_account' => 0,
                ]);

                $user = $existingUser;
            } else {
                // Create new user in users table with PLAIN TEXT password
                $user = User::create([
                    'user_name' => $request->user_name,
                    'name' => $request->full_name,
                    'email' => $request->email,
                    // STORE PASSWORD IN PLAIN TEXT (NO HASH)
                    'password' => $request->password,
                    'whatsapp_number' => $request->whatsapp,
                    'city' => $request->city,

                    // --- CONTACT INFO FIELDS ---
                    'address' => $request->address,
                    'state' => $request->state,
                    'country' => $request->country,

                    // --- SOCIAL PROFILES FIELDS ---
                    'linkedin_url' => $request->linkedin_url,
                    'instagram_url' => $request->instagram_url,
                    'twitter_url' => $request->twitter_url,
                    'facebook_url' => $request->facebook_url,

                    'register_account' => 1,
                    'unregister_account' => 0,
                ]);
            }

            // Delete the user from user_accounts table (moved to users table)
            $userAccount->delete();

            // Commit transaction
            DB::commit();

            // Auto-login the user
            auth()->login($user);

            // Check if user is admin
            if ($user->isAdmin()) {
                return redirect()
                    ->route('admin.dashboard')
                    ->with('success', 'Welcome Admin!');
            }

            // Redirect to home page with success message
            return redirect()
                ->route('pages.home')
                ->with('success', 'Account created successfully! Welcome ' . $user->name . '!');

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('auth.auth')->with('error', 'Please login first.');
        }

        // Validation Rules
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'whatsapp_number' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            // Password validation - only if password fields are filled
            'current_password' => 'nullable|string|required_with:new_password',
            'new_password' => 'nullable|string|min:8|confirmed|required_with:current_password',
        ]);

        // Update profile information
        $user->name = $request->full_name;
        $user->email = $request->email;
        $user->whatsapp_number = $request->whatsapp_number;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->linkedin_url = $request->linkedin_url;
        $user->instagram_url = $request->instagram_url;
        $user->twitter_url = $request->twitter_url;
        $user->facebook_url = $request->facebook_url;

        // Image Upload in public/users
        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path('users/' . $user->image))) {
                @unlink(public_path('users/' . $user->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('users'), $filename);
            $user->image = $filename;
        }

        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            // Check if current password matches (plain text comparison)
            if ($user->password !== $request->current_password) {
                return back()->with('error', 'Current password is incorrect.');
            }

            // Store new password in plain text
            $user->password = $request->new_password;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = User::where('user_name', $request->user_name)->first();

        // DIRECT PLAIN TEXT COMPARISON (NO HASH)
        if (!$user || $user->password !== $request->password) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Invalid username or password');
        }

        // Check if user is registered
        if ($user->register_account == 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Your account is not registered. Please contact support.');
        }

        // Login user
        auth()->login($user);

        // Check if user is admin using the isAdmin() method
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }

        // Redirect regular users to home page
        return redirect()->route('pages.home')->with('success', 'Welcome back, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.auth')->with('success', 'Logged out successfully.');
    }

    public function showLoginForm()
    {
        $availableUsers = \App\Models\User::all();
        return view('auth.auth', compact('availableUsers'));
    }


    public function showProfile()
    {
        $user = Auth::user();
        return view('admin.pages.profile.index', compact('user'));
    }

    // public function updateProfile(Request $request)
    // {
    //     $user = Auth::user();

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'whatsapp_number' => 'nullable|string|max:20',
    //     ]);

    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->whatsapp_number = $request->whatsapp_number;
    //     $user->save();

    //     return back()->with('success', 'Profile updated successfully!');
    // }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Since you store passwords in plain text, compare directly
        if ($user->password !== $request->current_password) {
            return back()->with('error', 'Current password is incorrect.');
        }

        // Store new password in plain text
        $user->password = $request->new_password;
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}