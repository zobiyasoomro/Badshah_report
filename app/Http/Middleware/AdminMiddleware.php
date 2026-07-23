<?php
// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please login first.'], 401);
            }
            return redirect()->route('auth.auth')->with('error', 'Please login first.');
        }

        // Check if user is admin
        if (Auth::user()->user_name !== 'betproadmin') {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Access denied. Admin only.'], 403);
            }
            return redirect()->route('pages.home')->with('error', 'Access denied. Admin only.');
        }

        return $next($request);
    }
}