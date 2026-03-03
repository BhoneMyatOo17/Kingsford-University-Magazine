<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::with(['reportedBy', 'resolvedBy', 'reportable'])
            ->orderByRaw("FIELD(status, 'pending', 'reviewed', 'resolved', 'dismissed')")
            ->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reports = $query->paginate(20)->withQueryString();

        $counts = [
            'all'       => Report::count(),
            'pending'   => Report::where('status', 'pending')->count(),
            'reviewed'  => Report::where('status', 'reviewed')->count(),
            'resolved'  => Report::where('status', 'resolved')->count(),
            'dismissed' => Report::where('status', 'dismissed')->count(),
        ];

        return view('reports.index', compact('reports', 'counts'));
    }

    public function edit(Report $report)
    {
        $report->load(['reportedBy', 'resolvedBy', 'reportable.student.user', 'reportable.post.faculty']);

        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'status'          => 'required|in:pending,reviewed,resolved,dismissed',
            'resolution_note' => 'nullable|string|max:2000',
        ]);

        $data = ['status' => $request->status];

        if (in_array($request->status, ['resolved', 'dismissed'])) {
            $data['resolved_by']      = Auth::id();
            $data['resolved_at']      = now();
            $data['resolution_note']  = $request->resolution_note;
        } elseif ($request->status === 'reviewed') {
            $data['resolved_by']     = Auth::id();
            $data['resolved_at']     = null;
            $data['resolution_note'] = $request->resolution_note;
        }

        $report->update($data);

        return redirect()->route('reports.index')
            ->with('success', 'Report updated successfully.');
    }
}
