<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Student;
use App\Models\Staff;
use App\Models\Faculty;
use App\Models\Contribution;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        
        // Determine if user is student or staff
        if ($user->isStudent()) {
            // Get student data with faculty relationship
            $student = $user->student()->with('faculty')->first();
            
            // Get student statistics
            $stats = [
                'total_contributions' => $student ? $student->contributions()->count() : 0,
                'approved' => $student ? $student->contributions()->where('status', 'approved')->count() : 0,
                'published' => $student ? $student->contributions()->where('is_selected', true)->count() : 0,
            ];
            
            return view('profile.show', compact('user', 'student', 'stats'));
        } else {
            // Get staff data (Marketing Coordinator, Marketing Manager, or Admin)
            $staff = $user->staff()->with('faculty')->first();
            
            return view('profile.show', compact('user', 'staff'));
        }
    }

    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::user();
        
        // Get all active faculties for dropdown
        $faculties = Faculty::active()->orderBy('name')->get();
        
        if ($user->isStudent()) {
            $student = $user->student()->with('faculty')->first();
            return view('profile.edit', compact('user', 'student', 'faculties'));
        } else {
            $staff = $user->staff()->with('faculty')->first();
            return view('profile.edit', compact('user', 'staff', 'faculties'));
        }
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validate basic user data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'ends_with:@ksf.it.com',
                Rule::unique('users')->ignore($user->id)
            ],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            
            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $path;
        }

        // Update user table
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'profile_picture' => $validatedData['profile_picture'] ?? $user->profile_picture,
        ]);

        // Update role-specific table (Student or Staff)
        if ($user->isStudent()) {
            $this->updateStudentData($request, $user);
        } else {
            $this->updateStaffData($request, $user);
        }

        return redirect()->route('profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    /**
     * Update student-specific data.
     */
    private function updateStudentData(Request $request, User $user)
    {
        $studentData = $request->validate([
            'faculty_id' => ['nullable', 'exists:faculties,id'],
            'program' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
        ]);

        $user->student()->update($studentData);
    }

    /**
     * Update staff-specific data.
     */
    private function updateStaffData(Request $request, User $user)
    {
        $staffData = $request->validate([
            'department' => ['nullable', 'string', 'max:255'],
            'position' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'office_location' => ['nullable', 'string', 'max:255'],
        ]);

        $user->staff()->update($staffData);
    }

    /**
     * Show the form for changing password.
     */
    public function showChangePasswordForm()
    {
        $user = Auth::user();
        return view('profile.password', compact('user'));
    }

    /**
     * Update the user's password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.show')
            ->with('success', 'Password changed successfully!');
    }
}