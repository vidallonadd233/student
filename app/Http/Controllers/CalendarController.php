<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\CalendarArchive;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\ScheduleCreatedMail;

class CalendarController extends Controller
{
    // Display all calendars
    public function index(Request $request)
    {
        $search = $request->input('search');

        $events = Calendar::when($search, function ($query, $search) {
                return $query->where('id', 'like', "%$search%")
                             ->orWhere('student_number', 'like', "%$search%")
                             ->orWhere('grade_level', 'like', "%$search%")
                             ->orWhere('age', 'like', "%$search%")
                             ->orWhere('gender', 'like', "%$search%")
                             ->orWhere('time', 'like', "%$search%")
                             ->orWhere('date', 'like', "%$search%")
                             ->orWhere('description', 'like', "%$search%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10); // Paginate results (10 per page)

        // Pass events to the view
        return view('admin.calendar', compact('events'));

    }

    // Display events in calendar view
        public function events()
        {
            $calendars = Calendar::all(); // Fetching all events from the Calendar model
            return view('student.calendar_date', compact('calendars'));
        }

        public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'student_number' => 'required|numeric|digits_between:1,12',
            'age' => 'required|integer|min:16|max:60',
            'grade_level' => 'required|string',
            'gender' => 'required|string',
            'time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        // Prevent duplicate bookings


        // Create event in the database
        $calendar = Calendar::create($validated);

        // Log the activity if user is authenticated
        if (Auth::check()) {
            activity()
                ->causedBy(Auth::user())
                ->performedOn($calendar)
                ->withProperties($validated)
                ->log('New calendar event created.');
        }

        // Send email notification (ensure email exists)

        // ✅ Stay on the calendar page & show success toast
        return redirect()->back()->with('toast_success', 'Appointment successfully sent.');

    }

    // Edit an existing event
    public function edit($id)
    {
        $calendar = Calendar::findOrFail($id); // Fetch calendar by its ID
        return view('admin.calendar.edit', compact('calendar'));
    }

    // Update an existing event
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_number' => 'required|integer',
            'grade_level' => 'required|string',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'time' => 'required|date_format:H:i',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $calendar = Calendar::findOrFail($id);
        $calendar->update($validated); // Update the calendar with new data

        return redirect()->route('admin.calendar')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $calendar = Calendar::onlyTrashed()->findOrFail($id);

        if ($calendar->trashed()) {
            // If already soft deleted, permanently delete
            $calendar->forceDelete();
            return redirect()->route('admin.archives.calendar')->with('success', 'Calendar permanently deleted.');
        } else {
            // Soft delete the calendar (archive)
            $calendar->delete();
            return redirect()->route('admin.calendar')->with('success', 'Calendar archived successfully.');
        }
    }

    // Generate PDF with all calendars

    // Archive an event
    public function archive($id)
    {
        // Find the calendar
        $calendar = Calendar::findOrFail($id);

        // Mark as archived and soft delete
        $calendar->archived = true;
        $calendar->save();
        $calendar->delete(); // Soft delete

        return redirect()->route('admin.archives.calendar')->with('success', 'Calendar archived successfully.');
    }
    public function showArchivedCalendars()
    {
        // Get only soft-deleted calendars
        $archivedSchedules = Calendar::onlyTrashed()->orderBy('id', 'desc')->paginate(10);

        return view('admin.archives.calendar', compact('archivedSchedules'));
    }

    public function restore($id)
    {
        // Find the soft-deleted calendar
        $calendar = Calendar::onlyTrashed()->findOrFail($id);

        // Unmark as archived and restore
        $calendar->archived = false;
        $calendar->save();
        $calendar->restore(); // Restore the calendar

        return redirect()->route('admin.calendar')->with('success', 'Calendar restored successfully.');
    }
}
