<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use App\Notifications\GuestAccountCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredGuestController extends Controller
{
  public function create(): View
  {
    $faculties = Faculty::active()->orderBy('name')->get();

    return view('auth.register-guest', compact('faculties'));
  }

  public function store(Request $request): RedirectResponse
  {
    $validated = $request->validate([
      'name'             => ['required', 'string', 'max:255'],
      'email'            => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
      'password'         => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
      'guest_faculty_id' => ['required', 'exists:faculties,id'],
    ]);

    $faculty = Faculty::findOrFail($validated['guest_faculty_id']);

    $user = User::create([
      'name'             => $validated['name'],
      'email'            => $validated['email'],
      'password'         => Hash::make($validated['password']),
      'guest_faculty_id' => $faculty->id,
      'is_active'        => true,
      'email_verified_at' => now(), // guests don't need email verification
    ]);

    $user->assignRole('guest');

    // Notify Marketing Coordinator of this faculty
    $coordinator = User::role('marketing_coordinator')
      ->whereHas('staff', fn($q) => $q->where('faculty_id', $faculty->id))
      ->first();

    if ($coordinator) {
      $coordinator->notify(new GuestAccountCreated($user, $faculty));
    }

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('analytics.faculty.show', $faculty->id)
      ->with('status', 'Welcome! You are now viewing ' . $faculty->name . '.');
  }
}
