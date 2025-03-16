<?php

namespace App\Http\Controllers;

use App\Models\ReportIncident;
use App\Models\ReportArchive;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\IncidentReportMail;
use Illuminate\Support\Facades\Log;

class ReportIncidentsController extends Controller
{
    // Display a listing of the reports
    public function index(Request $request)
    {
        $student = Auth::user();
        $query = ReportIncident::query();

        // Apply search filter if search term is provided
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('student_number', 'like', "%$search%")
                  ->orWhere('age', 'like', "%$search%")
                  ->orWhere('report_date', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%")
                  ->orWhere('status', 'like', "%$search%");
            });
        }

        // Fetch reports with pagination
        $reports = $query->orderByDesc('id')->paginate(10);


        // Return the view with data
        return view('report_incidents.index', compact('reports', 'student'));
    }


    // Show the form for creating a new report
    public function create()
    {
        return view('report_incidents.create');
    }

    public function store(Request $request)
    {

            // Validate input
            $validated = $request->validate([
                'student_number'   => 'required|numeric|digits_between:1,12',
                'age'              => 'required|integer|min:16|max:60',
                'report_date'      => 'required|date',
                'category'         => 'required|string',
                'description'      => 'required|string',
                'location'         => 'required|string',
                'person_involved'  => 'required|string|max:255',
                'evidence'         => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov,webm,mkv|max:10240',
            ]);

            // Handle file upload
            if ($request->hasFile('evidence')) {
                $file = $request->file('evidence');
                $filePath = $file->store('evidence_files', 'public');
                $validated['evidence'] = 'evidence_files/' . $file->hashName();
            }

            // Add default status
            $validated['status'] = 'Unsolved';

            // Store the report
            $report = ReportIncident::create($validated);

            // Check if report was stored
            if (!$report) {
                throw new \Exception('Report not saved');
            }

            // Log activity
            activity()
                ->causedBy(Auth::user())
                ->withProperties(['report_id' => $report->id])
                ->log('Report created');

            // Send email notification
            Mail::to('admin@example.com')->send(new IncidentReportMail($report));

            return redirect()->route('report_incidents.index')->with('toast_success', 'Report created successfully.');


    }


    // Update a report
    public function update(Request $request, $id)
    {
        $report = ReportIncident::findOrFail($id);

        $validated = $request->validate([
          'student_number' => 'required|numeric|digits_between:1,12',
            'age' => 'required|integer|min:16|max:60',
            'report_date' => 'required|date',
            'category' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|string',
            'evidence' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov,webm,mkv|max:51200',

        ]);

        if ($request->hasFile('evidence')) {
            $file = $request->file('evidence');
            $filePath = $file->store('evidence_files', 'public');
            $validated['evidence'] = $filePath;
        }
             Log::info('Updating Report: ', $request->all());
        $report->update($validated);

        return redirect()->route('report_incidents.index')->with('success', 'Report updated successfully.');
    }





    // Update the status of a report
    public function updateStatus(Request $request, $id)
    {
        $report = ReportIncident::findOrFail($id);
        $report->update(['status' => $request->status]);

        if ($request->status === 'Solved') {
            return redirect()->route('admin.solvedReports')->with('success', 'Report moved to solved cases.');
        }

        return redirect()->route('admin.viewReports')->with('success', 'Status updated successfully.');
    }



    public function solvedReports(Request $request)
    {
        $query = ReportIncident::where('status', 'Solved');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('student_number', 'like', "%$search%")
                  ->orWhere('age', 'like', "%$search%")
                  ->orWhere('report_date', 'like', "%$search%")
                  ->orWhere('category', 'like', "%$search%")
                  ->orWhere('status', 'like', "%$search%");
            });
        }

        $solvedReports = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.solved-reports', compact('solvedReports'));
    }



    // Show a specific report
    public function show($id)
    {
        $report = ReportIncident::findOrFail($id);
        return view('report_incidents.show', compact('report'));
    }

    // Delete a report
    public function destroy($id)
    {
        $report = ReportIncident::findOrFail($id);

        if ($report->status !== 'Solved') {
            return redirect()->route('report_incidents.index')->with('error', 'Only solved reports can be deleted.');
        }

        $report->delete();
        return redirect()->route('report_incidents.index')->with('success', 'Report deleted successfully.');


        $report->forceDelete();
        return redirect()->route('report_incidents.index')->with('success', 'Report deleted successfully.');
    }




    // Monitor and search reports
        public function viewReports(Request $request)
        {
            $query = ReportIncident::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', "%$search%")
                    ->orWhere('student_number', 'like', "%$search%")
                    ->orWhere('age', 'like', "%$search%")
                    ->orWhere('report_date', 'like', "%$search%")
                    ->orWhere('category', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%");
                });
            }


            $students = $query->orderBy('id', 'desc')->paginate(10);
            return view('admin.view-reports', compact('students'));
        }

        public function ShowArchived(Request $request)
        {

 $query = ReportIncident::query();

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', "%$search%")
                    ->orWhere('student_number', 'like', "%$search%")
                    ->orWhere('age', 'like', "%$search%")
                    ->orWhere('report_date', 'like', "%$search%")
                    ->orWhere('category', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%");
                });
            }

            // Retrieve only soft-deleted reports
            $reports = ReportIncident::onlyTrashed('id' , 'desc')->paginate(10);

            return view('archive.report', compact('reports'));
        }



        public function archive($id)
{
    // Find the report by ID
    $report = ReportIncident::findOrFail($id);

    // Soft delete the report (moves to archive)
    $report->save();

    return redirect()->route('archive.report')->with('success', 'Report archived successfully.');
}




public function restore($id)
{
    // Restore the report directly
    ReportIncident::onlyTrashed()->where('id', $id)->restore();

    // Redirect to the report_incidents page after restoring
    return redirect()->route('report_incidents.index')->with('success', 'Report restored successfully.');
}



}
