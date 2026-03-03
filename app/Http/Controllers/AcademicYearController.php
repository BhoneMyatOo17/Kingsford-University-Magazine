<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::orderBy('year', 'desc')->paginate(10);
        return view('academic-years.index', compact('academicYears'));
    }

    public function create()
    {
        return view('academic-years.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'required|string|max:50|unique:academic_years,name',
            'year'               => 'required|digits:4|integer',
            'closure_date'       => 'required|date',
            'final_closure_date' => 'required|date|after:closure_date',
            'description'        => 'nullable|string',
            'is_active'          => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($validated['is_active']) {
            AcademicYear::where('is_active', true)->update(['is_active' => false]);
        }

        AcademicYear::create($validated);

        return redirect()->route('academic-years.index')
            ->with('success', 'Academic year created successfully.');
    }

    public function show(AcademicYear $academicYear)
    {
        $academicYear->load(['posts.faculty', 'posts' => function ($q) {
            $q->withCount('contributions');
        }]);

        return view('academic-years.show', compact('academicYear'));
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $validated = $request->validate([
            'name'               => ['required', 'string', 'max:50', Rule::unique('academic_years', 'name')->ignore($academicYear->id)],
            'year'               => 'required|digits:4|integer',
            'closure_date'       => 'required|date',
            'final_closure_date' => 'required|date|after:closure_date',
            'description'        => 'nullable|string',
            'is_active'          => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($validated['is_active']) {
            AcademicYear::where('is_active', true)
                ->where('id', '!=', $academicYear->id)
                ->update(['is_active' => false]);
        }

        $academicYear->update($validated);

        return redirect()->route('academic-years.show', $academicYear)
            ->with('success', 'Academic year updated.');
    }

    public function destroy(AcademicYear $academicYear)
    {
        if ($academicYear->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete an academic year that has posts assigned to it.');
        }

        $academicYear->delete();

        return redirect()->route('academic-years.index')
            ->with('success', 'Academic year deleted.');
    }
}
