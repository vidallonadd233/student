<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query activity logs with search filter
        $logs = Activity::when($search, function ($query, $search) {
                return $query->where('description', 'like', "%{$search}%")
                             ->orWhereDate('created_at', '=', $search); // Fixed date filtering
            })
            ->orderBy('id', 'desc') // Order by ID in descending order
            ->paginate(10); // Paginate the results

        return view('admin.activity-logs', compact('logs'));
    }


    // Example of manually logging an activity
    public function logCustomActivity()
    {
        activity()
            ->causedBy(auth()->user()) // The logged-in user (for example, an admin)
            ->withProperties(['some' => 'data'])
            ->log('Custom activity logged');

        return redirect()->route('admin.activity-logs')->with('success', 'Activity logged successfully.');
    }







}
