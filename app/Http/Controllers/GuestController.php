<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GuestController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $query = User::with('guestFaculty')
            ->whereNotNull('guest_faculty_id')
            ->withTrashed();

        if ($user->isMarketingCoordinator()) {
            $facultyId = $user->staff->faculty_id;
            $query->where('guest_faculty_id', $facultyId);
        }

        $guests = $query->latest()->paginate(20);

        return view('guests.index', compact('guests'));
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_unless($user->isGuest(), 403);

        $user->update(['is_active' => false]);
        $user->delete();

        return redirect()->route('guests.index')
            ->with('success', 'Guest account has been deactivated and removed.');
    }
}
