<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Cart;

class CheckAddressSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the 'address' session exists and if the request is not for COD payment
         if (!Session::has('address') && $request->route()->getName() !== 'user.cod.payment') {
            // Redirect the user to the checkout page or perform any other action
            return redirect()->route('user.checkout')->with('error', 'Please provide your address.');
        }

        return $next($request);
    }
}
