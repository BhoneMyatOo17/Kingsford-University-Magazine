<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'student.faculty', 'staff.faculty'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $faculties = Faculty::orderBy('name')->get();
        $roles = \Spatie\Permission\Models\Role::all();

        return view('users.create', compact('faculties', 'roles'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_type' => 'required|exists:roles,name',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'student_id' => ['nullable', 'string', 'max:50', 'regex:/^ksf[a-z0-9]{4}$/i', 'unique:students,student_id'],
            'faculty_id' => 'nullable|exists:faculties,id',
            'program' => 'nullable|string|max:255',
            'study_level' => 'nullable|in:undergraduate,postgraduate,doctorate',
            'enrollment_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'staff_id' => ['nullable', 'string', 'max:7', 'regex:/^STF\d{4}$/i', 'unique:staff,staff_id'],
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'office_location' => 'nullable|string|max:255',
        ]);

        // One coordinator per faculty check
        if ($validated['user_type'] === 'marketing_coordinator' && !empty($validated['faculty_id'])) {
            $existingCoordinator = \App\Models\Staff::whereHas('user', function ($q) {
                $q->role('marketing_coordinator');
            })->where('faculty_id', $validated['faculty_id'])->exists();

            if ($existingCoordinator) {
                return back()->withInput()->withErrors([
                    'faculty_id' => 'This faculty already has a Marketing Coordinator. Only one coordinator is allowed per faculty.',
                ]);
            }
        }

        // Auto-generate temporary password
        $temporaryPassword = \Illuminate\Support\Str::random(10) . '!1';

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($temporaryPassword),
            'email_verified_at' => now(),
            'is_active' => true,
            'must_change_password' => true,
        ]);

        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        // Assign role
        $user->assignRole($validated['user_type']);

        // Create student or staff record based on role
        if ($validated['user_type'] === 'student') {
            $user->student()->create([
                'student_id' => $validated['student_id'] ? strtoupper($validated['student_id']) : null,
                'faculty_id' => $validated['faculty_id'] ?? null,
                'program' => $validated['program'] ?? null,
                'study_level' => $validated['study_level'] ?? null,
                'enrollment_year' => $validated['enrollment_year'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);
        } elseif (in_array($validated['user_type'], ['marketing_coordinator', 'marketing_manager', 'admin'])) {
            $user->staff()->create([
                'staff_id' => $validated['staff_id'] ?? null,
                'faculty_id' => $validated['faculty_id'] ?? null,
                'department' => $validated['department'] ?? null,
                'position' => $validated['position'] ?? null,
                'hire_date' => $validated['hire_date'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'office_location' => $validated['office_location'] ?? null,
            ]);
        }

        // Send temporary password email
        try {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(
                new \App\Mail\UserCreatedMail($user, $temporaryPassword)
            );
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send temp password email: ' . $e->getMessage());
        }

        return redirect()->route('users.index')->with('success', 'User created successfully. Temporary password sent to ' . $user->email . '.');
    }

    public function show(User $user)
    {
        $user->load(['roles', 'student.faculty', 'staff.faculty']);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $user->load(['roles', 'student.faculty', 'staff']);
        $faculties = Faculty::orderBy('name')->get();

        return view('users.edit', compact('user', 'faculties'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'student_id' => ['nullable', 'string', 'max:50', 'regex:/^ksf[a-z0-9]{4}$/i', 'unique:students,student_id,' . ($user->student->id ?? 'NULL')],
            'faculty_id' => 'nullable|exists:faculties,id',
            'program' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'office_location' => 'nullable|string|max:255',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        // Update user table
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Update student or staff table
        if ($user->isStudent() && $user->student) {
            $user->student->update([
                'student_id' => $validated['student_id'] ? strtoupper($validated['student_id']) : $user->student->student_id,
                'faculty_id' => $validated['faculty_id'],
                'program' => $validated['program'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);
        } elseif ($user->staff) {
            $user->staff->update([
                'department' => $validated['department'],
                'position' => $validated['position'],
                'phone' => $validated['phone'],
                'office_location' => $validated['office_location'],
            ]);
        }

        return redirect()->route('users.show', $user)->with('success', 'User updated successfully.');
    }

    public function toggleStatus(User $user)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'You cannot deactivate your own account.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $message = $user->is_active ? 'Account activated successfully.' : 'Account deactivated successfully.';

        return redirect()->route('users.show', $user)->with('success', $message);
    }
}