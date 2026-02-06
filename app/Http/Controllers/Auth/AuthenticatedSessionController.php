<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Update last login timestamp
        if (method_exists(Auth::user(), 'updateLastLogin')) {
            Auth::user()->updateLastLogin();
        }

        // Redirect based on user role
        return $this->redirectBasedOnRole(Auth::user());
    }

    /**
     * Redirect user based on their role.
     */
    protected function redirectBasedOnRole($user): RedirectResponse
    {
        // Check if user has roles (Spatie)
        if (method_exists($user, 'hasRole')) {

                return redirect()->route('dashboard');
            
        }

        // Default redirect
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}