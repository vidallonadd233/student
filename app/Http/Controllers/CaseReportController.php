<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaseReportController extends Controller
{
    // List all case reports
    public function index()
    {
        // Fetch case reports from the database and pass to view
        return view('case-reports.index');
    }

    public function create()
    {
        return view('case-reports.create');
    }


    public function store(Request $request)
    {

        return redirect()->route('case-reports.index');
    }

    public function show($id)
    {
        return view('case-reports.show');
    }

    public function edit($id)
    {
        return view('case-reports.edit');
    }


    public function update(Request $request, $id)
    {

        return redirect()->route('case-reports.index');
    }

    public function destroy($id)
    {

        return redirect()->route('case-reports.index');
    }
}
