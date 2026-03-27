<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MagazineController extends Controller
{
    public function index(Request $request)
    {
        $academicYears = AcademicYear::orderBy('name', 'desc')->get();

        if ($request->boolean('trash') && Auth::check() && Auth::user()->hasAnyRole(['marketing_manager', 'admin'])) {
            $magazines = Magazine::onlyTrashed()
                ->with('academicYear')
                ->orderBy('deleted_at', 'desc')
                ->paginate(12)
                ->withQueryString();

            return view('magazine.index', compact('magazines', 'academicYears'));
        }

        $query = Magazine::with('academicYear')->orderBy('published_date', 'desc');

        if ($request->filled('year')) {
            $query->where('academic_year_id', $request->year);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->boolean('annual')) {
            $query->where('title', 'like', '%annual%');
        }

        $magazines = $query->paginate(12)->withQueryString();

        return view('magazine.index', compact('magazines', 'academicYears'));
    }

    public function show(Magazine $magazine)
    {
        $magazine->increment('view_count');
        $magazine->load('academicYear');

        $coverUrl = $magazine->cover_image_path && $magazine->cover_image_disk
            ? Storage::disk($magazine->cover_image_disk)->url($magazine->cover_image_path)
            : null;

        $pdfUrl = $magazine->pdf_path && $magazine->pdf_disk
            ? Storage::disk($magazine->pdf_disk)->url($magazine->pdf_path)
            : null;

        return view('magazine.show', compact('magazine', 'coverUrl', 'pdfUrl'));
    }

    public function create()
    {
        abort_unless(Auth::user()->hasAnyRole(['marketing_manager', 'admin']), 403);

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();

        return view('magazine.create', compact('academicYears'));
    }

    public function store(Request $request)
    {
        abort_unless(Auth::user()->hasAnyRole(['marketing_manager', 'admin']), 403);

        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'published_date'   => 'required|date',
            'cover_image'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'pdf_file'         => 'nullable|file|mimes:pdf|max:51200',
            'content'          => 'required|string',
        ]);

        $data = [
            'academic_year_id' => $request->academic_year_id,
            'created_by'       => Auth::id(),
            'title'            => $request->title,
            'description'      => $request->description,
            'published_date'   => $request->published_date,
            'content'          => $request->content,
        ];

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $path = $file->storeAs(
                'magazines/covers',
                Str::uuid() . '.' . $file->getClientOriginalExtension(),
                's3_images'
            );
            $data['cover_image_path'] = $path;
            $data['cover_image_disk'] = 's3_images';
        }

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $path = $file->storeAs(
                'magazines/pdfs',
                Str::uuid() . '.pdf',
                's3_documents'
            );
            $data['pdf_path'] = $path;
            $data['pdf_disk'] = 's3_documents';
        }

        $magazine = Magazine::create($data);

        return redirect()->route('magazine.show', $magazine)
            ->with('success', 'Magazine published successfully.');
    }

    public function edit(Magazine $magazine)
    {
        abort_unless(Auth::user()->hasAnyRole(['marketing_manager', 'admin']), 403);

        $academicYears = AcademicYear::orderBy('name', 'desc')->get();

        $coverUrl = $magazine->cover_image_path && $magazine->cover_image_disk
            ? Storage::disk($magazine->cover_image_disk)->url($magazine->cover_image_path)
            : null;

        $pdfUrl = $magazine->pdf_path && $magazine->pdf_disk
            ? Storage::disk($magazine->pdf_disk)->url($magazine->pdf_path)
            : null;

        return view('magazine.edit', compact('magazine', 'academicYears', 'coverUrl', 'pdfUrl'));
    }

    public function update(Request $request, Magazine $magazine)
    {
        abort_unless(Auth::user()->hasAnyRole(['marketing_manager', 'admin']), 403);

        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'published_date'   => 'required|date',
            'cover_image'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'pdf_file'         => 'nullable|file|mimes:pdf|max:51200',
            'content'          => 'required|string',
        ]);

        $data = [
            'academic_year_id' => $request->academic_year_id,
            'title'            => $request->title,
            'description'      => $request->description,
            'published_date'   => $request->published_date,
            'content'          => $request->content,
        ];

        if ($request->hasFile('cover_image')) {
            if ($magazine->cover_image_path) {
                Storage::disk($magazine->cover_image_disk)->delete($magazine->cover_image_path);
            }
            $file = $request->file('cover_image');
            $path = $file->storeAs(
                'magazines/covers',
                Str::uuid() . '.' . $file->getClientOriginalExtension(),
                's3_images'
            );
            $data['cover_image_path'] = $path;
            $data['cover_image_disk'] = 's3_images';
        }

        if ($request->hasFile('pdf_file')) {
            if ($magazine->pdf_path) {
                Storage::disk($magazine->pdf_disk)->delete($magazine->pdf_path);
            }
            $file = $request->file('pdf_file');
            $path = $file->storeAs(
                'magazines/pdfs',
                Str::uuid() . '.pdf',
                's3_documents'
            );
            $data['pdf_path'] = $path;
            $data['pdf_disk'] = 's3_documents';
        }

        $magazine->update($data);

        return redirect()->route('magazine.show', $magazine)
            ->with('success', 'Magazine updated successfully.');
    }

    public function destroy(Magazine $magazine)
    {
        abort_unless(Auth::user()->hasAnyRole(['marketing_manager', 'admin']), 403);

        if ($magazine->cover_image_path) {
            Storage::disk($magazine->cover_image_disk)->delete($magazine->cover_image_path);
        }
        if ($magazine->pdf_path) {
            Storage::disk($magazine->pdf_disk)->delete($magazine->pdf_path);
        }

        $magazine->delete();

        return redirect()->route('magazine.index')
            ->with('success', 'Magazine deleted.');
    }

    public function restore($id)
    {
        abort_unless(Auth::user()->hasAnyRole(['marketing_manager', 'admin']), 403);

        $magazine = Magazine::onlyTrashed()->findOrFail($id);
        $magazine->restore();

        return redirect()->route('magazine.index', ['trash' => 1])
            ->with('success', 'Magazine restored successfully.');
    }

    public function forceDelete($id)
    {
        abort_unless(Auth::user()->hasAnyRole(['marketing_manager', 'admin']), 403);

        $magazine = Magazine::onlyTrashed()->findOrFail($id);

        if ($magazine->cover_image_path) {
            Storage::disk($magazine->cover_image_disk)->delete($magazine->cover_image_path);
        }
        if ($magazine->pdf_path) {
            Storage::disk($magazine->pdf_disk)->delete($magazine->pdf_path);
        }

        $magazine->forceDelete();

        return redirect()->route('magazine.index', ['trash' => 1])
            ->with('success', 'Magazine permanently deleted.');
    }
}
