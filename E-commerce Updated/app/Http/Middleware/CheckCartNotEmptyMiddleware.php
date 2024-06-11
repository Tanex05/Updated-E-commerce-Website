<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Cart;

class CheckCartNotEmptyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if cart is empty
        if (Cart::content()->count() === 0) {
            // Redirect the user to the home page or perform any other action
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        return $next($request);
    }
}
