<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Maximum number of login attempts allowed.
     */
    protected int $maxAttempts = 3;

    /**
     * Number of minutes to throttle logins.
     */
    protected int $decayMinutes = 3;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        // Validate the input
        $this->validateLogin($request);

        // Check if user is locked out
        if ($this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // Login failed - increment attempts
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                function ($attribute, $value, $fail) {
                    if (!Str::endsWith(strtolower($value), '@ksf.it.com')) {
                        $fail('Only Kingsford University email address is allowed.');
                    }
                },
            ],
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     */
    protected function attemptLogin(Request $request): bool
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_active' => true, // Only allow active users
        ];

        return Auth::attempt($credentials, $request->filled('remember'));
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

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
    protected function redirectBasedOnRole($user)
    {
        // Check if user has roles (Spatie)
        if (method_exists($user, 'hasRole')) {
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            }

            if ($user->hasRole('marketing_manager')) {
                return redirect()->route('manager.dashboard');
            }

            if ($user->hasRole('marketing_coordinator')) {
                return redirect()->route('coordinator.dashboard');
            }

            if ($user->hasRole('student')) {
                return redirect()->route('student.dashboard');
            }

            if ($user->hasRole('guest')) {
                return redirect()->route('guest.dashboard');
            }
        }

        // Default redirect
        return redirect()->intended('/dashboard');
    }

    /**
     * Get the failed login response.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $attempts = RateLimiter::attempts($this->throttleKey($request));
        $remaining = $this->maxAttempts - $attempts;

        $message = 'These credentials do not match our records.';

        if ($attempts >= 1 && $remaining > 0) {
            $attemptsWord = $remaining === 1 ? 'attempt' : 'attempts';
            $message .= " You have {$remaining} {$attemptsWord} remaining.";
        }

        throw ValidationException::withMessages([
            'email' => [$message],
        ]);
    }

    /**
     * Redirect the user after determining they are locked out.
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = RateLimiter::availableIn($this->throttleKey($request));
        $minutes = ceil($seconds / 60);
        $minutesWord = $minutes === 1 ? 'minute' : 'minutes';

        $message = "🔒 Account Locked: Too many failed login attempts. Your account has been temporarily locked for {$minutes} {$minutesWord} for security reasons. Please try again later or contact support@ksf.it.com for immediate assistance.";

        throw ValidationException::withMessages([
            'email' => [$message],
        ])->status(429);
    }

    /**
     * Determine if the user has too many failed login attempts.
     */
    protected function hasTooManyLoginAttempts(Request $request): bool
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($request),
            $this->maxAttempts
        );
    }

    /**
     * Increment the login attempts for the user.
     */
    protected function incrementLoginAttempts(Request $request): void
    {
        RateLimiter::hit(
            $this->throttleKey($request),
            $this->decayMinutes * 60
        );
    }

    /**
     * Clear the login locks for the given user credentials.
     */
    protected function clearLoginAttempts(Request $request): void
    {
        RateLimiter::clear($this->throttleKey($request));
    }

    /**
     * Get the throttle key for the given request.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::transliterate(
            Str::lower($request->input('email')) . '|' . $request->ip()
        );
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}