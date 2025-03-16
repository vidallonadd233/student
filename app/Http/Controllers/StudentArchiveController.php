<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentArchive;
use App\Models\Student;

class StudentArchiveController extends Controller
{
    /**
     * Display a listing of students with optional search functionality.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Student::when($search, function ($query, $search) {
            return $query->where('student_number', 'like', "%{$search}%")
                         ->orWhere('grade_level', 'like', "%{$search}%")
                         ->orWhere('age', 'like', "%{$search}%")
                         ->orWhere('gender', 'like', "%{$search}%"); // Added gender filter
        })
        ->orderBy('id', 'desc') // Order by ID in descending order
        ->paginate(10); // Paginate with 10 records per page

        return view('students.index', compact('students'));
    }

public function showArchived()
{
    $studentArchives = StudentArchive::onlyTrashed()->where('archived', true)->paginate(10);

    return view('students.showArchived', compact('studentArchives'));
}


    public function archive($id)
    {
        $student = Student::findOrFail($id);

        // Create a new student archive entry with 'archived' set to true
        StudentArchive::create([
            'student_number' => $student->student_number,
            'grade_level' => $student->grade_level,
            'age' => $student->age,
            'gender' => $student->gender,
            'archived' => true,
        ]);

        // Delete the student from the original students table
        $student->delete();

        return redirect()->route('students.showArchived')->with('success', 'Student archived successfully.');
    }

    /**
     * Restore a student from the archive back to the students table.
     */
    public function restore($id)
    {
        // Find the archived student using soft deletes
        $student = StudentArchive::onlyTrashed()->findOrFail($id);

        // Restore the student from the archive
        $student->restore();

        // Set the 'archived' flag to false to unarchive the student
        $student->archived = false;
        $student->save();

        return redirect()->route('students.showArchived')->with('success', 'Student restored successfully.');
    }

    /**
     * Permanently delete an archived student.
     */
    public function destroy($id)
    {
        // Find the student in the archive and delete it permanently
        $student = StudentArchive::findOrFail($id);
        $student->forceDelete();

        return redirect()->route('students.showArchived')->with('success', 'Student deleted permanently.');
    }
}
