<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportIncident;

class ReportArchiveController extends Controller
{
    public function showArchivedReports()
    {


        $admin = auth()->guard('admin')->user();

        if (!$admin || $admin->role !== 'admin') {
            return redirect()->route('admin.login')->with('error', 'Access denied');
        }



    $archivedReports = ReportIncident::onlyTrashed()->get();

        // Pass the data to the view
        return view('archive.report', compact('archivedReport'));
    }

    public function archiveReport($id)
    {
        // Find the specific report to archive
        $report = ReportIncident::onlyTrashed()->findOrFail($id);

        // Mark the report as archived

       $archivedReport->delete();

        return redirect()->route('archive.report')->with('success', 'Report archived successfully.');
    }

    public function restoreArchivedReport($id)
    {
        // Find the archived report
        $report = ReportIncident::onlyTrashed()->findOrFail($id);
        $report->restore();

        return redirect()->route('report_incidents.index')->with('success', 'Report restored successfully.');
    }

    public function deleteArchivedReport($id)
    {
        // Find the specific archived report
        $report = ReportIncident::onlyTrashed()->findOrFail($id);

        // Permanently delete the report
        $report->forceDelete();

        return redirect()->route('archive.report')->with('success', 'Archived report deleted successfully.');
    }

}
