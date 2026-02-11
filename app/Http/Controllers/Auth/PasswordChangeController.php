<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordChangeController extends Controller
{
    /**
     * Show the temporary password change form.
     */
    public function showChangePasswordForm()
    {
        $user = Auth::user();
        
        // Only show this form if user must change password
        if (!$user->must_change_password) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.change-password', compact('user'));
    }

    /**
     * Handle temporary password change.
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'new_password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        // Update password and reset flags
        $user->update([
            'password' => Hash::make($request->new_password),
            'must_change_password' => false,
            'password_changed_at' => now(),
            'email_verified_at' => now(), // Auto-verify email for admin-created users
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Password changed successfully! Welcome to Kingsford University.');
    }
}