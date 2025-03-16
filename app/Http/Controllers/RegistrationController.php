<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentArchive;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Notifications\StudentNotification;

class RegistrationController extends Controller
{


    public function create()
    {
        return view('students.register');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'student_number' => 'required|numeric|digits_between:1,12|unique:students,student_number',
            'grade_level' => 'required|integer|between:11,12',
            'age'=> 'required|integer|min:16|max:100',
            'gender' => 'required|in:male,female',
            'password' => 'required|string|min:6',
             // Removed 'confirmed' rule

        ]);

        $student = Student::where('student_number', $request->student_number)->first();

        if ($student) {
            return redirect()->back()->withErrors(['student_number' => 'This student number is already registered.']);
        }

        // Create the student

        $student = Student::create([
            'student_number' => $request->student_number,
            'grade_level' => $request->grade_level,
            'age' => $request->age,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),

        ]);

        activity()
            ->causedBy(auth()->user())
            ->withProperties(['student_id' => $student->id, 'student_number' => $student->student_number])
            ->log('Student registered');

        // Redirect to the login form
        return redirect()->route('logins.form')->with('toast_success', 'Registration successful!');


    }



    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::when($search, function ($query, $search) {
            return $query->where('student_number', 'like', "%{$search}%")
                         ->orWhere('grade_level', 'like', "%{$search}%")
                         ->orWhere('age', 'like', "%{$search}%");
        })->orderBy('id','desc')
        ->paginate(10);

        return view('students.index', compact('students'));
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.index', compact('student'));
    }

    public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);

    // Validate input
    $validator = Validator::make($request->all(), [
        'student_number' => 'required|numeric|digits_between:1,12|unique:students,student_number,' . $id,
        'grade_level' => 'required|integer|between:11,12',
        'age' => 'required|integer|min:16|max:100',
        'gender' => 'required|in:male,female',
        'password' => 'nullable|string|min:6',
    // Allow picture update
    ]);



    // Update student details
    $student->update([
        'student_number' => $request->student_number,
        'grade_level' => $request->grade_level,
        'age' => $request->age,
        'gender' => $request->gender,
        'password' => $request->password ? Hash::make($request->password) : $student->password,

    ]);

    activity()
        ->causedBy(auth()->user())
        ->withProperties(['student_id' => $student->id, 'student_number' => $student->student_number])
        ->log('Student updated');

        return redirect()->route('students.index')->with('toast_success', 'Student updated successfully!');

}





    public function showArchived()
    {
        // Retrieve archived students from the Student table (soft deleted)
        $student = Student::onlyTrashed()->paginate(10);

        return view('students.showArchived', compact('student'));
    }

    // Archive a Student
    public function StudentArchive($id)
    {
        // Find the student in the main table
        $student = Student::findOrFail($id);

        // Move student to the archive table
        StudentArchive::create([
            'student_number' => $student->student_number,
            'grade_level'    => $student->grade_level,
            'age'            => $student->age,
            'gender'         => $student->gender,
            'archived'       => true,
        ]);

        // Soft delete the student from the original table
        $student->delete();

        // Redirect to the archived students page
        return redirect()->route('students.showArchived')->with('toast_success', 'Student archived successfully.');
    }


    // Restore an Archived Student

    public function restore($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
    $student->restore();
    return redirect()->route('students.showArchived')->with('toast_success', 'Student restored successfully.');
}

    // Permanently Delete an Archived Student
    public function destroy($id)
    {
        // Find the archived student
        $student = Student::onlyTrashed()->findOrFail($id);

        // Permanently delete the student
        $student->forceDelete();

        return redirect()->route('students.showArchived')->with('toast_success', 'Student permanently deleted.');
    }



    public function studentLogout(Request $request)
    {
        Auth::logout(); // Log out the current user from the dashboard

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token for security
        $request->session()->regenerateToken();

        // Redirect to the login page after logging out from the dashboard
        return redirect()->route('home')->with('toast_success', 'Logged out successfully!');
    }
}
