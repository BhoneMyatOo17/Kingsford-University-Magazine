<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $overdueContributions = collect();

        if ($user->hasRole('marketing_coordinator')) {
            $faculty = $user->getFaculty();

            if ($faculty) {
                $overdueContributions = Contribution::whereDoesntHave('comments')
                    ->whereHas('student', function ($q) use ($faculty) {
                        $q->where('faculty_id', $faculty->id);
                    })
                    ->where('created_at', '<=', now()->subDays(14))
                    ->whereNull('deleted_at')
                    ->with('student.user')
                    ->orderBy('created_at', 'asc')
                    ->get();
            }
        }

        return view('dashboard', [
            'overdueContributions' => $overdueContributions,
        ]);
    }
}
