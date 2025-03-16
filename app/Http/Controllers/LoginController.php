<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    /**
     * Handle login or create account logic.
     */
    public function loginOrCreate(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
            'profile_picture' => ['nullable', 'image'], // Optional profile picture
        ]);

        // Normalize email
        $data['email'] = strtolower($data['email']);

        // Handle file upload
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Check if the admin already exists
        $admin = Admin::where('email', $data['email'])->first();

        // If the admin does not exist, create a new one
        if (!$admin) {
            $admin = Admin::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'profile_picture' => $data['profile_picture'] ?? null,
                'role' => 'admin', // Default role for newly created admins
            ]);

            // Log the account creation activity
            activity()
                ->causedBy($admin) // The user who created the account
                ->withProperties(['email' => $data['email']])
                ->log('New admin account created.');

            Log::info('New admin account created for email: ' . $data['email']);
        }

        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            Log::info('Login successful for email: ' . $data['email']);

            return redirect()->route('admin.dashboard')->with('toast_success', 'Login successful!');

        }

        // Handle login failure
        return back()->withErrors(['email' => 'Unable to log in with the provided credentials.']);
    }
    /**
     * Handle the admin logout logic.
     */
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout(); // Log out the current user

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token for the new session
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
