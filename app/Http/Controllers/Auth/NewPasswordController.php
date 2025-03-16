<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use App\Models\Student;



class NewPasswordController extends Controller
{
    public function showCreateForm()
    {
        return view('auth.passwords.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'student_number' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);


        $student = Student::where('student_number', $request->student_number)->first();

        if (!$student) {
            return back()->withErrors(['student_number' => 'User not found.']);
        }


        $student->password = bcrypt($request->password);
        $student->save();

        return redirect()->route('logins.form')->with('status', 'Password created successfully.');
    }
}
