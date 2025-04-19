<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StrictAdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        $allowedEmails = [
         ' admin1@deped.gov.ph',
            'admin3@deped.gov.ph',
            'admin4@deped.gov.ph',
            'admin5@deped.gov.ph',
            'admin6@deped.gov.ph',
           ' admin7@deped.gov.ph',
            'admin8@deped.gov.ph',
           'admin9@deped.gov.ph',
            'admin10@deped.gov.ph',
            'admin11@deped.gov.ph',
           'admin12@deped.gov.ph',
           'admin13@deped.gov.ph',
            'admin14@deped.gov.ph',
        ];

        if (Auth::check() && Auth::user()->role === 'admin' && in_array(Auth::user()->email, $allowedEmails)) {
            return $next($request);
        }

        abort(403, 'Unauthorized: Only allowed admins can access this page.');
    }
}
