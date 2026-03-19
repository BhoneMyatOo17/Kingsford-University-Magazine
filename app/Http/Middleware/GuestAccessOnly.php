<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestAccessOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->isGuest()) {
            $allowedRoutes = [
                'analytics.faculty.show',
                'contributions.index',
                'contributions.show',
                'profile.show',
                'profile.edit',
                'profile.update',
                'profile.password.form',
                'profile.password.update',
                'logout',
                'notifications.read',
                'notifications.read-all',
            ];

            if (!$request->routeIs($allowedRoutes)) {
                return redirect()->route('analytics.faculty.show', $user->guest_faculty_id);
            }
        }

        return $next($request);
    }
}
