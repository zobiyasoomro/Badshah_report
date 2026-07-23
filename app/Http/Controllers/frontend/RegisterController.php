<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// Remove: use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite; // Google OAuth

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $availableUsers = UserAccount::all();
        return view('auth.auth', compact('availableUsers'));
    }

    public function register(Request $request)
    {
        // user_name and password are auto-assigned from the oldest available
        // user_accounts row below — not submitted by the form.
        $request->validate([
            'full_name' => 'required|string|max:255',
            // CHANGED: WhatsApp number must be between 11 and 12 digits/characters
            'whatsapp' => 'required|string|min:11|max:12',
            'city' => 'required|string|max:255',
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

            // Auto-assign the oldest available user_accounts row
            // (FIFO — first admin-created account goes to the first
            // person who signs up) instead of reading user_name from
            // the request.
            $userAccount = UserAccount::oldest()->first();

            if (!$userAccount) {
                // No accounts left for admin to hand out — fail cleanly
                // instead of crashing on a null object.
                throw new \Exception('No accounts are currently available. Please contact support.');
            }

            // Create new user in users table with PLAIN TEXT password,
            // using the auto-assigned username/password from user_accounts.
            $user = User::create([
                'user_name' => $userAccount->user_account,
                'name' => $request->full_name,
                'email' => $request->email,
                // STORE PASSWORD IN PLAIN TEXT (NO HASH)
                'password' => $userAccount->user_password,
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

            // Delete the user_accounts row now that it's been claimed
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

    // ==========================================================
    // Google OAuth — redirect step
    // Sends the user to Google's consent screen.
    // ==========================================================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // ==========================================================
    // Google OAuth — callback step
    // Google sends the user back here after they approve.
    // We only pull their name/email and stash it in session so the
    // signup form can prefill Full Name and Email.
    // ==========================================================
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()
                ->route('auth.auth')
                ->with('error', 'Google sign-in failed. Please try again.');
        }

        session()->flash('google_full_name', $googleUser->getName());
        session()->flash('google_email', $googleUser->getEmail());

        return redirect()
            ->route('auth.auth', ['signup' => 1])
            ->with('success', 'Google details loaded. Please complete your account setup.');
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
            'current_password' => 'nullable|string|required_with:new_password',
            'new_password' => 'nullable|string|min:8|confirmed|required_with:current_password',
        ]);

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

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path('users/' . $user->image))) {
                @unlink(public_path('users/' . $user->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('users'), $filename);
            $user->image = $filename;
        }

        if ($request->filled('current_password') && $request->filled('new_password')) {
            if ($user->password !== $request->current_password) {
                return back()->with('error', 'Current password is incorrect.');
            }

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

        $user = User::where('user_name', $request->user_name)->first();

        if (!$user || $user->password !== $request->password) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Invalid username or password');
        }

        if ($user->register_account == 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Your account is not registered. Please contact support.');
        }

        auth()->login($user);

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
        }

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

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($user->password !== $request->current_password) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->password = $request->new_password;
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }
}