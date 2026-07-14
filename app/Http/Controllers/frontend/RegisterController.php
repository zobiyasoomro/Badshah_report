<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        // Validate the incoming request
        $request->validate([
            'user_name' => 'required|string|exists:user_accounts,user_account',
            'password' => 'required|string|min:8',
            'full_name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'city' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:users,email',
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
                    'password' => Hash::make($request->password),
                    'register_account' => 1,
                    'unregister_account' => 0,
                ]);

                $user = $existingUser;
            } else {
                // Create new user in users table with encrypted password
                $user = User::create([
                    'user_name' => $request->user_name,
                    'name' => $request->full_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'whatsapp_number' => $request->whatsapp,
                    'city' => $request->city,
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
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && file_exists(storage_path('app/public/' . $user->image))) {
                unlink(storage_path('app/public/' . $user->image));
            }

            // Store new image
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
            $user->save();
        }

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

        if (!$user || !Hash::check($request->password, $user->password)) {
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
    // Fetch users from your model
    $availableUsers = \App\Models\User::all(); // Or whatever model you use
    
    return view('auth.auth', compact('availableUsers'));
}
}