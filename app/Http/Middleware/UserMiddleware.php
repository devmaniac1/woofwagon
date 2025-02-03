<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure Auth facade is used and check the user type
        if (Auth::check() && Auth::user()->user_type === 'user') {
            return $next($request);
        }

        // Redirect back if the user is not an admin
        return redirect()->back()->with('error', 'Unauthorized access.');
    }
}
