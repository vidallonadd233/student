<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student; // Adjust based on your User model
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;
class PasswordResetController extends Controller
{

 public function showLinkRequestForm(){

    return view('auth.passwords.email');

 }





    public function showResetForm($token)
{

    return view('auth.passwords.reset', ['token' => $token]);

}

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'student_number' => 'required|exists:students,student_number',
            'password' => 'required|confirmed|min:8',
        ]);

        $student = Student::where('student_number', $request->student_number)->firstOrFail();

        $student->password = bcrypt($request->password);
        $student->save();

        return redirect()->route('logins.form')->with('status', 'Password has been reset!');
    }


}
