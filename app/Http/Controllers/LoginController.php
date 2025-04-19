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
        // List of allowed emails (trimmed and clean)
        $allowedEmails = array_map('trim', [
            'admin1@deped.gov.ph',
            'admin2@deped.gov.ph',
            'admin3@deped.gov.ph',
            'admin4@deped.gov.ph',
            'admin5@deped.gov.ph',
            'admin6@deped.gov.ph',
            'admin7@deped.gov.ph',
            'admin8@deped.gov.ph',
            'admin9@deped.gov.ph',
            'admin10@deped.gov.ph',
            'admin11@deped.gov.ph',
            'admin12@deped.gov.ph',
            'admin13@deped.gov.ph',
            'admin14@deped.gov.ph',
        ]);

        // Validate input
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',        // At least one uppercase letter
                'regex:/[0-9]/',        // At least one number
                'regex:/[@$!%*?&]/',    // At least one special character
            ],
            'profile_picture' => ['nullable', 'image'],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one number, and one special character.',
        ]);

        // Normalize email
        $data['email'] = strtolower(trim($data['email']));

        // Reject emails outside deped.gov.ph
        if (!str_ends_with($data['email'], '@deped.gov.ph')) {
            return back()->withErrors(['email' => 'Only  emails are allowed for admin access.']);
        }

        // ❌ Reject if email is not in the strict admin list
        if (!in_array($data['email'], $allowedEmails)) {
            return back()->withErrors(['email' => 'This email is not authorized for admin login.']);
        }

        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Check if admin exists or create new
        $admin = Admin::where('email', $data['email'])->first();

        if (!$admin) {
            $admin = Admin::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'profile_picture' => $data['profile_picture'] ?? null,
                'role' => 'admin',
            ]);

            activity()
                ->causedBy($admin)
                ->withProperties(['email' => $data['email']])
                ->log('New admin account created.');

            Log::info('New admin account created for email: ' . $data['email']);
        }

        // Attempt login
        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->regenerate();
            Log::info('Login successful for email: ' . $data['email']);

            return redirect()->route('admin.dashboard')->with('toast_success', 'Login successful!');
        }

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
