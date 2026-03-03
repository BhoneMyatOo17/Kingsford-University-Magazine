<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::withTrashed()->latest()->paginate(10);
        return view('faculty.index', compact('faculties'));
    }

    public function create()
    {
        return view('faculty.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faculties,name',
            'code' => 'required|string|max:10|unique:faculties,code',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Faculty::create($validated);

        return redirect()->route('faculty.index')->with('success', 'Faculty created successfully.');
    }

    public function show(Faculty $faculty)
    {
        return view('faculty.show', compact('faculty'));
    }

    public function edit(Faculty $faculty)
    {
        return view('faculty.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faculties,name,' . $faculty->id,
            'code' => 'required|string|max:10|unique:faculties,code,' . $faculty->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $faculty->update($validated);

        return redirect()->route('faculty.index')->with('success', 'Faculty updated successfully.');
    }

    public function destroy(Faculty $faculty)
    {
        $faculty->delete();
        return redirect()->route('faculty.index')->with('success', 'Faculty deleted successfully.');
    }

    public function restore($id)
    {
        Faculty::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('faculty.index')->with('success', 'Faculty restored successfully.');
    }
}
