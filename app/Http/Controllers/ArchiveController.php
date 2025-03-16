<?php

namespace App\Http\Controllers;
use App\Models\ReportIncident;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {

        $reports = ReportIncident::paginate(10);
        return view('archive.report', compact('reports'));
    }
}
