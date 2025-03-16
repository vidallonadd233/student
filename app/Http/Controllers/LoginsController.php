<?php

namespace App\Http\Controllers;

use App\Mail\StudentRegisteredMail; // Ensure this matches the actual file name
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoginsController extends Controller
{
    // Show the login form for students
    public function Showformlogins()
    {
        if (Auth::check()) {
            // If the user is already logged in, redirect to dashboard
            return redirect()->route('dashboard');  // Ensure 'dashboard' is the correct route name
        }

        return view('students.logins');
    }

    // Handle student login
    public function logins(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'student_number' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the student
        if (Auth::guard('student')->attempt($credentials)) {
            // Log successful login details
            activity()
                ->causedBy(auth()->guard('student')->user())
                ->withProperties([
                    'student_number' => $credentials['student_number'],
                    'login_location' => $request->ip(),
                ])
                ->log('Successful login attempt');

            // Optional: Send login notification
            $report = (object)[
                'student_number' => $credentials['student_number'],
                'location' => $request->ip(),
                'description' => 'Successful login attempt',
                'assigned_staff' => 'Admin',
                'person_involved' => 'Student',
                'status' => 'Logged In'
            ];


            $student = (object) [
                'student_number' => $credentials['student_number'],
                'age' => 'Unknown', // Set a default if age is missing
                'gender' => 'Unknown'
            ];

            Mail::to('admin@yourdomain.com')->send(new StudentRegisteredMail($student));

            // Redirect to the dashboard
            return redirect()->route('report_incidents.index')->with('toast_success', 'Report created successfully!');

 };

        // Authentication failed
        return back()->withErrors(['student_number' => __('The provided credentials do not match our records.')])->withInput();
    }




}
