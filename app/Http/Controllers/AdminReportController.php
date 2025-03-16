<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportIncident;
use App\Models\ReportArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    public function archivedReports(Request $request)
    {
        $query = ReportIncident::onlyTrashed(); // Get soft-deleted reports

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

        $archivedReports = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.archive-reports', compact('archivedReports'));
    }


    public function archiveReport($id)
{
    $report = ReportIncident::find($id);

    if (!$report) {
        return redirect()->back()->with('error', 'Report not found.');
    }
$report->status = 'Archived'; // ✅ Correct: 'Archived' is a string
    $report->delete();
    return redirect()->route('admin.archive-reports')->with('success', 'Report archived successfully.');
}

    public function restoreReport($id)
{
    $report = ReportIncident::onlyTrashed()->findOrFail($id);
    $report->restore(); // Restore soft-deleted report
    return redirect()->route('admin.archive-reports')->with('success', 'Report restored successfully.');
}

public function deleteReport($id)
{
    $report = ReportIncident::onlyTrashed()->findOrFail($id);
    $report->forceDelete(); // Permanently delete report
    return redirect()->route('admin.archive-reports')->with('success', 'Report permanently deleted.');
}



}
