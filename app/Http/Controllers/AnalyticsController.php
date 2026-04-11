<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Contribution;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AnalyticsController extends Controller
{
    public function contributions(Request $request): View
    {
        $academicYears  = AcademicYear::orderByDesc('year')->get();
        $selectedYearId = $request->get('academic_year_id', $academicYears->firstWhere('is_active', true)?->id ?? $academicYears->first()?->id);
        $selectedYear   = $academicYears->firstWhere('id', $selectedYearId);

        $faculties = Faculty::active()->with(['students.contributions' => function ($q) use ($selectedYearId) {
            $q->where('academic_year_id', $selectedYearId)->whereNull('deleted_at');
        }])->get();

        $totalContributions = 0;

        $facultyStats = $faculties->map(function ($faculty) use (&$totalContributions) {
            $contributions = $faculty->students->flatMap->contributions;
            $total         = $contributions->count();
            $totalContributions += $total;

            return [
                'name'         => $faculty->name,
                'code'         => $faculty->code,
                'total'        => $total,
                'approved'     => $contributions->where('status', 'approved')->count(),
                'rejected'     => $contributions->where('status', 'rejected')->count(),
                'under_review' => $contributions->where('status', 'under_review')->count(),
                'submitted'    => $contributions->where('status', 'submitted')->count(),
                'contributors' => $contributions->pluck('student_id')->unique()->count(),
            ];
        });

        // Add percentage now that we have the total
        $facultyStats = $facultyStats->map(function ($row) use ($totalContributions) {
            $row['percentage'] = $totalContributions > 0
                ? round(($row['total'] / $totalContributions) * 100, 1)
                : 0;
            return $row;
        });

        $totalApproved  = $facultyStats->sum('approved');
        $totalRejected  = $facultyStats->sum('rejected');
        $totalContributors = $facultyStats->sum('contributors');

        return view('analytics.contributions', compact(
            'facultyStats',
            'academicYears',
            'selectedYearId',
            'selectedYear',
            'totalContributions',
            'totalApproved',
            'totalRejected',
            'totalContributors'
        ));
    }

    public function users(Request $request): View
    {
        $role  = $request->get('role', 'all');
        $order = $request->get('order', 'desc');

        $query = User::with(['student', 'staff'])
            ->whereNull('guest_faculty_id')
            ->withCount([
                'student as contribution_count' => function ($q) {
                    $q->join('contributions', 'contributions.student_id', '=', 'students.id')
                        ->whereNull('contributions.deleted_at');
                },
            ]);

        if ($role !== 'all') {
            $query->role($role);
        }

        $users = $query->get()->map(function ($user) {
            if ($user->hasRole('student')) {
                $user->activity_score = $user->contribution_count ?? 0;
                $user->activity_label = 'contributions';
            } elseif ($user->hasRole('marketing_coordinator')) {
                $commentCount  = Comment::where('user_id', $user->id)->count();
                $approvalCount = Contribution::where('selected_by', $user->id)->count();
                $user->activity_score = $commentCount + $approvalCount;
                $user->activity_label = 'comments & approvals';
            } else {
                $user->activity_score = 0;
                $user->activity_label = '—';
            }
            return $user;
        });

        $users = $order === 'asc'
            ? $users->sortBy('activity_score')->values()
            : $users->sortByDesc('activity_score')->values();

        $perPage     = 20;
        $currentPage = (int) $request->get('page', 1);
        $total       = $users->count();
        $paginated   = $users->forPage($currentPage, $perPage);

        $roles = ['all', 'student', 'marketing_coordinator'];

        return view('analytics.users', [
            'users'       => $paginated,
            'role'        => $role,
            'order'       => $order,
            'roles'       => $roles,
            'total'       => $total,
            'perPage'     => $perPage,
            'currentPage' => $currentPage,
            'lastPage'    => (int) ceil($total / $perPage),
        ]);
    }

    public function facultyIndex(): View
    {
        $faculties = Faculty::active()->withCount('students')->get();
        return view('analytics.faculty.index', compact('faculties'));
    }

    public function facultyShow(Request $request, Faculty $faculty): View|RedirectResponse
    {
        $user = auth()->user();

        if ($user->isGuest()) {
            if (!$user->guest_faculty_id) {
                abort(403);
            }
            if ($user->guest_faculty_id !== $faculty->id) {
                $guestFaculty = Faculty::find($user->guest_faculty_id);
                if (!$guestFaculty) {
                    abort(403);
                }
                return redirect()->route('analytics.faculty.show', $guestFaculty);
            }
        }

        $contributions = Contribution::whereHas('student', fn($q) => $q->where('faculty_id', $faculty->id))->get();

        $stats = [
            'student_count'       => $faculty->students()->count(),
            'contribution_count'  => $contributions->count(),
            'approved_count'      => $contributions->where('status', 'approved')->count(),
            'latest_contribution' => $contributions->sortByDesc('created_at')->first()?->created_at,
        ];

        $adminStats = null;
        if ($user->isAdmin()) {
            $adminStats = [
                'no_comment_count' => Contribution::whereHas('student', fn($q) => $q->where('faculty_id', $faculty->id))
                    ->doesntHave('comments')
                    ->count(),
                'no_comment_14d'   => Contribution::whereHas('student', fn($q) => $q->where('faculty_id', $faculty->id))
                    ->doesntHave('comments')
                    ->where('created_at', '<=', now()->subDays(14))
                    ->count(),
            ];
        }

        return view('analytics.faculty.show', compact('faculty', 'stats', 'adminStats'));
    }
}
