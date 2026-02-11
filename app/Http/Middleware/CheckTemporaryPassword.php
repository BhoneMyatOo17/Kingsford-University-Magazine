<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTemporaryPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If user must change password, redirect to password change page
        if ($user && $user->must_change_password) {
            // Allow access to temporary password change routes and logout
            if (!$request->routeIs('temporary-password.change') && 
                !$request->routeIs('temporary-password.update') && 
                !$request->routeIs('logout')) {
                return redirect()->route('temporary-password.change')
                    ->with('warning', 'You must change your temporary password before continuing.');
            }
        }

        return $next($request);
    }
}