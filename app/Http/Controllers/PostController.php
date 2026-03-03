<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Faculty;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = Post::with(['faculty', 'academicYear'])
            ->where('is_published', true)
            ->orderBy('closure_date', 'desc');

        // Coordinator: only their faculty's posts
        if ($user->hasRole('coordinator')) {
            $facultyId = $user->staff->faculty_id;
            $query->where('faculty_id', $facultyId);
        }

        // Student: only their faculty's posts
        if ($user->hasRole('student')) {
            $facultyId = $user->student->faculty_id;
            $query->where('faculty_id', $facultyId);
        }

        // Admin and Manager see all posts (no filter)

        $posts = $query->paginate(12);

        // Attach student's own submission per post (if student)
        $submittedPostIds = collect();
        if ($user->hasRole('student') && $user->student) {
            $submittedPostIds = $user->student->contributions()
                ->pluck('post_id')
                ->flip();
        }

        return view('posts.index', compact('posts', 'submittedPostIds'));
    }

    public function show(Post $post)
    {
        $post->load(['faculty', 'academicYear', 'createdBy']);

        $user = Auth::user();
        $studentSubmission = null;

        if ($user->hasRole('student') && $user->student) {
            $studentSubmission = $user->student->contributions()
                ->where('post_id', $post->id)
                ->first();
        }

        $contributions = $user->hasAnyRole(['marketing_coordinator', 'marketing_manager', 'admin'])
            ? $post->contributions()->with(['student.user', 'files'])->orderBy('created_at', 'desc')->paginate(15)
            : collect();

        return view('posts.show', compact('post', 'studentSubmission', 'contributions'));
    }

    public function create()
    {
        $faculties    = Faculty::where('is_active', true)->orderBy('name')->get();
        $academicYears = AcademicYear::orderBy('year', 'desc')->get();

        return view('posts.create', compact('faculties', 'academicYears'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'faculty_id'       => 'required|exists:faculties,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'closure_date'     => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $academicYear = AcademicYear::find($request->academic_year_id);
                    if ($academicYear && $value > $academicYear->closure_date) {
                        $fail('Post closure date must be on or before the academic year closure date.');
                    }
                },
            ],
            'is_published'     => 'boolean',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['is_published'] = $request->boolean('is_published', true);

        $post = Post::create($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        $faculties    = Faculty::where('is_active', true)->orderBy('name')->get();
        $academicYears = AcademicYear::orderBy('year', 'desc')->get();

        return view('posts.edit', compact('post', 'faculties', 'academicYears'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'faculty_id'       => 'required|exists:faculties,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'closure_date'     => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $academicYear = AcademicYear::find($request->academic_year_id);
                    if ($academicYear && $value > $academicYear->closure_date) {
                        $fail('Post closure date must be on or before the academic year closure date.');
                    }
                },
            ],
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $post->update($validated);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted.');
    }
}
