<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordChangeController extends Controller
{
    /**
     * Temporary password constant
     */
    const TEMPORARY_PASSWORD = 'kingsford123';

    /**
     * Show the password change form.
     */
    public function show(): View
    {
        // Ensure user must change password
        if (!session('must_change_password')) {
            return redirect()->route('verification.notice');
        }

        return view('auth.change-password');
    }

    /**
     * Update the password from temporary.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
                function ($attribute, $value, $fail) {
                    if (strtolower($value) === strtolower(self::TEMPORARY_PASSWORD)) {
                        $fail('Your new password cannot be the temporary password.');
                    }
                },
            ],
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        // Verify it's the temporary password
        if ($request->current_password !== self::TEMPORARY_PASSWORD) {
            throw ValidationException::withMessages([
                'current_password' => ['You can only use this form to change from the temporary password.'],
            ]);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        // Clear the session flag
        session()->forget('must_change_password');

        // Redirect to email verification
        return redirect()->route('verification.notice')
            ->with('status', 'Password changed successfully! Please verify your email address.');
    }
}