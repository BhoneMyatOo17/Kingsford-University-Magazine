<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                function ($attribute, $value, $fail) {
                    if (!Str::endsWith(strtolower($value), '@ksf.it.com')) {
                        $fail('Only Kingsford University email addresses (@ksf.it.com) are allowed.');
                    }
                },
            ],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey(), $this->decayMinutes * 60);

            throw ValidationException::withMessages([
                'email' => $this->getFailedLoginMessage(),
            ]);
        }

        // Check if user is active
        if (!Auth::user()->is_active) {
            Auth::logout();
            
            throw ValidationException::withMessages([
                'email' => 'Your account has been deactivated. Please contact the administrator at support@ksf.it.com',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Get the failed login message with remaining attempts.
     */
    protected function getFailedLoginMessage(): string
    {
        $attempts = RateLimiter::attempts($this->throttleKey());
        $remaining = $this->maxAttempts - $attempts;

        $message = 'These credentials do not match our records.';

        if ($attempts >= 1 && $remaining > 0) {
            $attemptsWord = $remaining === 1 ? 'attempt' : 'attempts';
            $message .= " You have {$remaining} {$attemptsWord} remaining.";
        }

        return $message;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), $this->maxAttempts)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = ceil($seconds / 60);

        // Format message with exact time for JavaScript countdown
        throw ValidationException::withMessages([
            'email' => "Account Locked: Too many failed login attempts. Your account has been temporarily locked for {$minutes} minutes for security reasons. Please try again later or contact support@ksf.it.com for immediate assistance.",
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}