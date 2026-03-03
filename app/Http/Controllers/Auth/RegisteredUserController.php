<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Program;
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
    public function create(): View
    {
        $faculties = Faculty::where('is_active', true)
            ->with(['activePrograms' => fn($q) => $q->orderBy('name')->select('id', 'faculty_id', 'name', 'level')])
            ->orderBy('name')
            ->get();

        $programsByFaculty = $faculties->mapWithKeys(fn($f) => [
            $f->id => $f->activePrograms->map(fn($p) => ['id' => $p->id, 'name' => $p->name, 'level' => $p->level])
        ]);

        return view('auth.register', compact('faculties', 'programsByFaculty'));
    }

    public function store(Request $request): RedirectResponse
    {
        $email = strtolower($request->email);
        $isTestAccount = ($email === 'test@ksf.it.com');

        $rules = [
            'name'            => ['required', 'string', 'max:255'],
            'student_id'      => ['required', 'regex:/^ksf[a-z0-9]{4}$/i', 'unique:students,student_id'],
            'email'           => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'faculty_id'      => ['required', 'exists:faculties,id'],
            'program_id'      => ['required', 'exists:programs,id'],
            'enrollment_year' => ['required', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            'study_level'     => ['required', 'in:undergraduate,postgraduate,doctorate'],
            'password'        => ['required', 'confirmed', Rules\Password::defaults()],
            'terms'           => ['required', 'accepted'],
        ];

        if (!$isTestAccount) {
            $rules['email'][] = 'unique:users';
        }

        $rules['email'][] = function ($attribute, $value, $fail) {
            if (!Str::endsWith(strtolower($value), '@ksf.it.com')) {
                $fail('Only Kingsford University email addresses (@ksf.it.com) are allowed.');
            }
        };

        $validated = $request->validate($rules);

        $programName = Program::findOrFail($validated['program_id'])->name;

        DB::transaction(function () use ($validated, $programName, $isTestAccount, &$user) {
            if ($isTestAccount) {
                User::where('email', 'test@ksf.it.com')->forceDelete();
                Student::whereHas('user', fn($q) => $q->where('email', 'test@ksf.it.com'))->forceDelete();
            }

            $user = User::create([
                'name'                 => $validated['name'],
                'email'                => $validated['email'],
                'password'             => Hash::make($validated['password']),
                'is_active'            => true,
                'password_changed_at'  => now(),
                'must_change_password' => false,
                'email_verified_at'    => $isTestAccount ? now() : null,
            ]);

            $user->assignRole('student');

            Student::create([
                'user_id'         => $user->id,
                'student_id'      => strtoupper($validated['student_id']),
                'faculty_id'      => $validated['faculty_id'],
                'program'         => $programName,
                'enrollment_year' => $validated['enrollment_year'],
                'study_level'     => $validated['study_level'],
            ]);
        });

        if (!$isTestAccount) {
            event(new Registered($user));
        }

        Auth::login($user);

        return $isTestAccount
            ? redirect()->route('dashboard')->with('status', 'Test account created successfully!')
            : redirect()->route('verification.notice')->with('status', 'Registration successful! Please verify your email address to access all features.');
    }
}
