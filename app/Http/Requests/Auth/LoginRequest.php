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
    protected int $maxAttempts = 3;
    protected int $decayMinutes = 3;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey(), $this->decayMinutes * 60);

            throw ValidationException::withMessages([
                'email' => $this->getFailedLoginMessage(),
            ]);
        }

        if (!Auth::user()->is_active) {
            Auth::logout();

            throw ValidationException::withMessages([
                'email' => 'Your account has been deactivated. Please contact the administrator at support@ksf.it.com',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function getFailedLoginMessage(): string
    {
        $attempts  = RateLimiter::attempts($this->throttleKey());
        $remaining = $this->maxAttempts - $attempts;

        $message = 'These credentials do not match our records.';

        if ($attempts >= 1 && $remaining > 0) {
            $attemptsWord = $remaining === 1 ? 'attempt' : 'attempts';
            $message .= " You have {$remaining} {$attemptsWord} remaining.";
        }

        return $message;
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), $this->maxAttempts)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        $minutes = ceil($seconds / 60);

        throw ValidationException::withMessages([
            'email' => "Account Locked: Too many failed login attempts. Your account has been temporarily locked for {$minutes} minutes for security reasons. Please try again later or contact support@ksf.it.com for immediate assistance.",
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
