<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::withTrashed()
            ->with('faculty')
            ->latest()
            ->paginate(15);

        $faculties = Faculty::where('is_active', true)->orderBy('name')->get();

        return view('programs.index', compact('programs', 'faculties'));
    }

    public function create()
    {
        $faculties = Faculty::where('is_active', true)->orderBy('name')->get();
        return view('programs.create', compact('faculties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'faculty_id'       => 'required|exists:faculties,id',
            'name' => 'required|string|max:255|unique:programs,name,NULL,id,deleted_at,NULL',
            'description'      => 'nullable|string',
            'level'            => 'required|in:undergraduate,postgraduate,doctorate',
            'duration_years'   => 'required|integer|min:1|max:10',
            'duration_mode'    => 'required|string|max:100',
            'fees_per_semester' => 'required|numeric|min:2000',
            'is_active'        => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Program::create($validated);

        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    public function show(Program $program)
    {
        $program->load('faculty');
        return view('programs.show', compact('program'));
    }

    public function edit(Program $program)
    {
        $faculties = Faculty::where('is_active', true)->orderBy('name')->get();
        return view('programs.edit', compact('program', 'faculties'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'faculty_id'       => 'required|exists:faculties,id',
            'name' => 'required|string|max:255|unique:programs,name,' . $program->id . ',id,deleted_at,NULL',
            'description'      => 'nullable|string',
            'level'            => 'required|in:undergraduate,postgraduate,doctorate',
            'duration_years'   => 'required|integer|min:1|max:10',
            'duration_mode'    => 'required|string|max:100',
            'fees_per_semester' => 'required|numeric|min:2000',
            'is_active'        => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $program->update($validated);

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }

    public function restore($id)
    {
        Program::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('programs.index')->with('success', 'Program restored successfully.');
    }

    // API: returns active programs for a given faculty (used by register form)
    public function byFaculty(Faculty $faculty)
    {
        $programs = $faculty->activePrograms()
            ->select('id', 'name', 'level')
            ->orderBy('level')
            ->orderBy('name')
            ->get();

        return response()->json($programs);
    }
}
