<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\IncidentReport;
use App\Models\ReportIncident;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ensure student is authenticated

            // Get count of solved and unsolved incidents
            $solvedCount = ReportIncident::where('status', 'solved')->count();
            $unsolvedCount = ReportIncident::where('status', 'unsolved')->count();

            // Get the incident counts grouped by status (solved, unsolved, Archived)
            $statusCounts = ReportIncident::select('status', DB::raw('count(*) as count'))
                ->whereIn('status', ['solved', 'unsolved', 'Archived'])
                ->groupBy('status')
                ->get();

            // Get total students count and report count
            $studentsCount = Student::count();
            $reportCount = ReportIncident::count();

            $student = Auth::guard('student')->user();


                $maleCount = Student::where('gender', 'Male')->count();
                $femaleCount = Student::where('gender', 'Female')->count();

         // Return the view with the counts
         return view('admin.dashboard', compact(
            'solvedCount',
            'unsolvedCount',
            'statusCounts',
            'reportCount',
            'studentsCount',
              'maleCount',
              'femaleCount'
            // <-- Removed extra space
        ));



            // Redirect to login or another route if student is not authenticated
            return redirect()->route('logins');
        }
    }


