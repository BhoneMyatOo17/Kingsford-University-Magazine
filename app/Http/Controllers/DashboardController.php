<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user               = Auth::user();
        $overdueContributions = collect();
        $stats              = [];
        $recentContributions = collect();
        $activeYear         = AcademicYear::where('is_active', true)->first();

        if ($user->hasRole('student')) {
            $student = $user->student;

            if ($student) {
                $contributions = $student->contributions()->whereNull('deleted_at');

                $stats = [
                    'total'    => $contributions->count(),
                    'pending'  => $contributions->whereIn('status', ['submitted', 'under_review'])->count(),
                    'approved' => $contributions->where('status', 'approved')->count(),
                    'selected' => $contributions->where('is_selected', true)->count(),
                ];

                $total            = $stats['total'];
                $stats['approval_rate'] = $total > 0 ? round(($stats['approved'] / $total) * 100) : 0;

                $recentContributions = $student->contributions()
                    ->with('comments')
                    ->whereNull('deleted_at')
                    ->orderByDesc('created_at')
                    ->limit(5)
                    ->get();
            }
        } elseif ($user->hasRole('marketing_coordinator')) {
            $faculty = $user->getFaculty();

            if ($faculty) {
                $overdueContributions = Contribution::whereDoesntHave('comments')
                    ->whereHas('student', fn($q) => $q->where('faculty_id', $faculty->id))
                    ->where('created_at', '<=', now()->subDays(14))
                    ->whereNull('deleted_at')
                    ->orderBy('created_at', 'asc')
                    ->get();

                $facultyContributions = Contribution::whereHas('student', fn($q) => $q->where('faculty_id', $faculty->id))
                    ->whereNull('deleted_at');

                $total    = (clone $facultyContributions)->count();
                $approved = (clone $facultyContributions)->where('status', 'approved')->count();

                $stats = [
                    'total'         => $total,
                    'overdue'       => $overdueContributions->count(),
                    'approved'      => $approved,
                    'selected'      => (clone $facultyContributions)->where('is_selected', true)->count(),
                    'approval_rate' => $total > 0 ? round(($approved / $total) * 100) : 0,
                ];

                $recentContributions = Contribution::whereHas('student', fn($q) => $q->where('faculty_id', $faculty->id))
                    ->with(['comments', 'student.user'])
                    ->whereNull('deleted_at')
                    ->orderByDesc('created_at')
                    ->limit(5)
                    ->get();
            }
        } elseif ($user->hasRole('admin') || $user->hasRole('marketing_manager')) {
            $total    = Contribution::whereNull('deleted_at')->count();
            $approved = Contribution::whereNull('deleted_at')->where('status', 'approved')->count();

            $stats = [
                'total'         => $total,
                'pending'       => Contribution::whereNull('deleted_at')->whereIn('status', ['submitted', 'under_review'])->count(),
                'approved'      => $approved,
                'selected'      => Contribution::whereNull('deleted_at')->where('is_selected', true)->count(),
                'approval_rate' => $total > 0 ? round(($approved / $total) * 100) : 0,
            ];

            $recentContributions = Contribution::with(['comments', 'student.user'])
                ->whereNull('deleted_at')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get();
        }

        return view('dashboard', [
            'overdueContributions' => $overdueContributions,
            'stats'                => $stats,
            'recentContributions'  => $recentContributions,
            'activeYear'           => $activeYear,
        ]);
    }
}
