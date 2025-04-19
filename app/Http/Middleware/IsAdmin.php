<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          $user = Auth::guard('admin')->user(); // Assuming you're using the 'admin' guard

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Unauthorized access - Admins only.');
        }

        return $next($request);


    }
}
