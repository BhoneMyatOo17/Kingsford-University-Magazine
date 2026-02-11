<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'student_id' => 'nullable|string|max:50|unique:students,student_id',
            'faculty_id' => 'nullable|exists:faculties,id',
            'program' => 'nullable|string|max:255',
            'study_level' => 'nullable|in:undergraduate,graduate,doctorate',
            'enrollment_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'staff_id' => 'nullable|string|max:50|unique:staff,staff_id',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'hire_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'office_location' => 'nullable|string|max:255',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'email_verified_at' => now(),
            'is_active' => true,
            'must_change_password' => false,
        ]);

        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        // Assign role
        $user->assignRole($validated['role']);

        // Create student or staff record based on role
        if ($validated['role'] === 'student') {
            $user->student()->create([
                'student_id' => $validated['student_id'],
                'faculty_id' => $validated['faculty_id'],
                'program' => $validated['program'],
                'study_level' => $validated['study_level'],
                'enrollment_year' => $validated['enrollment_year'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
            ]);
        } elseif (in_array($validated['role'], ['marketing_coordinator', 'marketing_manager', 'admin'])) {
            $user->staff()->create([
                'staff_id' => $validated['staff_id'],
                'faculty_id' => $validated['faculty_id'] ?? null,
                'department' => $validated['department'],
                'position' => $validated['position'],
                'hire_date' => $validated['hire_date'],
                'phone' => $validated['phone'],
                'office_location' => $validated['office_location'],
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
            'student_id' => 'nullable|string|max:50|unique:students,student_id,' . ($user->student->id ?? 'NULL'),
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
                'student_id' => $validated['student_id'] ?? $user->student->student_id,
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