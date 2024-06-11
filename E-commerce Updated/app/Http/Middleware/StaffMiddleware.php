<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user's role is not admin or employee
            if ($request->user()->role != 'admin' && $request->user()->role != 'employee') {
                return redirect()->route('user.dashboard');
            }
            
            // Check if the user's status is 'inactive'
            if ($request->user()->status === 'inactive') {
                // Redirect to the home route
                return redirect()->route('home');
            }
        } else {
            // If user is not authenticated, redirect to login page
            return redirect()->route('login');
        }

        return $next($request);
    }
}
