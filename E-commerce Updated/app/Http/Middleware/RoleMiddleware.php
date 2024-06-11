<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
           
            // Check if the user's status is 'inactive'
            if (Auth::user()->status === 'inactive') {
                return redirect()->route('home')->with('status', 'Your account is inactive.');
            }
        } else {
            // If user is not authenticated, redirect to login page
            return redirect()->route('login');
        }

        return $next($request);
    }
}
