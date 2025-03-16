<?php
use Illuminate\Support\Facades\App;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


function logActivity($userType, $userId, $activity)
{
    // Only call this if the app is not in console mode
    if (!App::runningInConsole()) {
        ActivityLog::create([
            'user_type' => $userType,
            'user_id' => $userId,
            'activity' => $activity,
        ]);
    }

}
