<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Temporary password that requires change
     */
    const TEMPORARY_PASSWORD = 'kingsford123';

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $faculties = Faculty::where('is_active', true)->orderBy('name')->get();
        
        return view('auth.register', compact('faculties'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'student_id' => ['required','regex:/^ksf\d{4}$/',],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (!Str::endsWith(strtolower($value), '@ksf.it.com')) {
                        $fail('Only Kingsford University email addresses (@ksf.it.com) are allowed.');
                    }
                },
            ],
            'faculty_id' => ['required', 'exists:faculties,id'],
            'program' => ['required', 'string', 'max:255'],
            'enrollment_year' => ['required', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            'study_level' => ['required', 'in:undergraduate,postgraduate,doctorate'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        // Check if using temporary password
        $isTemporaryPassword = $request->password === self::TEMPORARY_PASSWORD;

        DB::transaction(function () use ($validated, $isTemporaryPassword, &$user) {
            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_active' => true,
            ]);

            // Assign student role
            $user->assignRole('student');

            // Create student profile
            Student::create([
                'user_id' => $user->id,
                'student_id' => $validated['student_id'],
                'faculty_id' => $validated['faculty_id'],
                'program' => $validated['program'],
                'enrollment_year' => $validated['enrollment_year'],
                'study_level' => $validated['study_level'],
            ]);

            // Mark for password change if using temporary password
            if ($isTemporaryPassword) {
                session(['must_change_password' => true]);
            }
        });

        // Fire the registered event
        event(new Registered($user));

        // Log the user in
        Auth::login($user);

        // Redirect based on password type
        if ($isTemporaryPassword) {
            return redirect()->route('password.change')
                ->with('warning', 'You are using a temporary password. Please change it now for security.');
        }

        // Redirect to email verification notice
        return redirect()->route('verification.notice')
            ->with('status', 'Registration successful! Please verify your email address to access all features.');
    }
}