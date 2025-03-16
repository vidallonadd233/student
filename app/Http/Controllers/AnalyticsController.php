<?php

namespace App\Http\Controllers;

use App\Models\IncidentReport;
use App\Models\TrackIncidentReport;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {

   // Total repory incident
   $reportCount = IncidentReport::count();

   // Track incident reports count
   $reportsCount = IncidentReport::where('status', 'tracked')->count(); // Replace 'tracked' with actual status or condition

   // Total registered students
   $studentsCount = Student::count();

   return view('analytics', compact('reportCount', 'reportsCount', 'studentsCount'));
}

    }

