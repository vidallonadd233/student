<?php

namespace App\Http\Controllers;

use App\Mail\StudentRegisteredMail; // Ensure this matches the actual file name
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

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
        // Validate only required fields here
        $credentials = $request->validate([
            'student_number' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $student = auth()->guard('student')->user();

        // Retrieve the student by student_number
        $student = Student::where('student_number', $request->student_number)->first();

        if (!$student) {
            return back()->with('toast_error', 'Student number not found.')->withInput();
        }

        if ($student->status === 'pending ') {
            return back()->with('toast_error', 'Your account need a  permissions Admin.')->withInput();
        }

        if ($student->status === 'rejected') {
            return back()->with('toast_error', 'Your account has been rejected.')->withInput();
        }

        if ($student->status !== 'approved') {
            return back()->with('toast_warning', 'Your account is not approved yet.')->withInput();
        }

        $remember = $request->has('remember'); //
        if (Auth::guard('student')->attempt($credentials)) {
            if (Auth::guard('student')->user()->status !== 'approved') {
                Auth::guard('student')->logout();
                return back()->with('toast_error', 'Your account is not approved.')->withInput();
            }




            // Log activity
            activity()
                ->causedBy(auth()->guard('student')->user())
                ->withProperties([
                    'student_number' => $credentials['student_number'],
                    'login_location' => $request->ip(),
                ])
                ->log('Successful login attempt');

            // Notify admin (optional)
            Mail::to('admin@yourdomain.com')->send(new StudentRegisteredMail($student));

            // Redirect
            return redirect()->route('report_incidents.index')->with('toast_success', 'Logged in successfully and approved !');
        }

        return back()->with('toast_error', 'The provided credentials do not match our records.')->withInput();
    }

            }
