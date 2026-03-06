<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Contribution;
use App\Models\ContributionFile;
use App\Models\Comment;
use App\Models\Report;
use App\Models\User;
use App\Mail\ContributionSubmitted;
use App\Notifications\NewSubmissionPending;
use App\Notifications\ContributionStatusUpdated;
use App\Notifications\NewReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContributionController extends Controller
{
    // -------------------------------------------------------------------------
    // Student: create contribution form
    // -------------------------------------------------------------------------
    public function create(Post $post)
    {
        abort_unless($post->isOpenForSubmission(), 403, 'Submissions are closed for this post.');

        $user = Auth::user();
        abort_unless($user->hasRole('student'), 403);

        $existing = $user->student->contributions()
            ->withoutTrashed()
            ->where('post_id', $post->id)
            ->first();

        if ($existing) {
            return redirect()->route('contributions.show', $existing)
                ->with('info', 'You have already submitted for this post.');
        }

        return view('contributions.create', compact('post'));
    }

    // -------------------------------------------------------------------------
    // Student: store contribution
    // -------------------------------------------------------------------------
    public function store(Request $request, Post $post)
    {
        abort_unless($post->isOpenForSubmission(), 403, 'Submissions are closed for this post.');

        $user = Auth::user();
        abort_unless($user->hasRole('student'), 403);

        $request->validate([
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'terms_accepted'  => 'accepted',
            'documents'       => 'required|array|min:1|max:2',
            'documents.*'     => 'file|mimes:docx,doc,pdf|max:10240',
            'images'          => 'nullable|array|max:5',
            'images.*'        => 'file|mimes:jpg,jpeg,png,gif,webp|max:5120',
        ]);

        DB::transaction(function () use ($request, $post, $user) {
            $contribution = Contribution::create([
                'student_id'        => $user->student->id,
                'post_id'           => $post->id,
                'academic_year_id'  => $post->academic_year_id,
                'title'             => $request->title,
                'description'       => $request->description,
                'terms_accepted'    => true,
                'terms_accepted_at' => now(),
                'status'            => 'submitted',
            ]);

            $this->uploadFiles($contribution, $request);

            $coordinator = $post->faculty->staff()
                ->whereHas('user', fn($q) => $q->whereHas('roles', fn($q) => $q->where('name', 'marketing_coordinator')))
                ->with('user')
                ->first();

            if ($coordinator) {
                Mail::to($coordinator->user->email)
                    ->send(new ContributionSubmitted($contribution, $coordinator->user));

                $coordinator->user->notify(new NewSubmissionPending($contribution));
            }
        });

        return redirect()->route('posts.index')
            ->with('success', 'Contribution submitted successfully.');
    }

    // -------------------------------------------------------------------------
    // Student / Coordinator / Manager: show contribution
    // -------------------------------------------------------------------------
    public function show(Contribution $contribution)
    {
        $user = Auth::user();
        $this->authorizeView($user, $contribution);

        $contribution->load(['student.user', 'post.faculty', 'files', 'comments.user', 'academicYear']);

        foreach ($contribution->files as $file) {
            $file->temp_url = cache()->remember(
                "file_url_{$file->id}",
                now()->addMinutes(55),
                fn() => Storage::disk($file->disk)->temporaryUrl($file->file_path, now()->addHour())
            );
        }

        $canEdit   = false;
        $canDelete = false;

        if ($user->hasRole('student') && $user->student->id === $contribution->student_id) {
            $canEdit   = $contribution->post->isOpenForEdit();
            $canDelete = $contribution->post->isOpenForSubmission();
        }

        $canComment  = $user->hasRole('marketing_coordinator');
        $canApprove  = $user->hasRole('marketing_coordinator');
        $canReport   = $user->hasRole('marketing_coordinator') || $user->hasRole('student');

        $hasCommented = $canApprove
            ? $contribution->comments->where('user_id', $user->id)->isNotEmpty()
            : false;

        $backUrl = url()->previous() !== url()->current()
            ? url()->previous()
            : route('posts.index');

        return view('contributions.show', compact(
            'contribution',
            'canEdit',
            'canDelete',
            'canComment',
            'canApprove',
            'canReport',
            'hasCommented',
            'backUrl'
        ));
    }

    // -------------------------------------------------------------------------
    // Student: edit contribution form
    // -------------------------------------------------------------------------
    public function edit(Contribution $contribution)
    {
        $user = Auth::user();
        abort_unless($user->hasRole('student'), 403);
        abort_unless($user->student->id === $contribution->student_id, 403);
        abort_unless($contribution->post->isOpenForEdit(), 403, 'The edit period has closed.');

        $contribution->load(['files', 'post']);

        return view('contributions.edit', compact('contribution'));
    }

    // -------------------------------------------------------------------------
    // Student: update contribution
    // -------------------------------------------------------------------------
    public function update(Request $request, Contribution $contribution)
    {
        $user = Auth::user();
        abort_unless($user->hasRole('student'), 403);
        abort_unless($user->student->id === $contribution->student_id, 403);
        abort_unless($contribution->post->isOpenForEdit(), 403, 'The edit period has closed.');

        $request->validate([
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'documents'      => 'nullable|array',
            'documents.*'    => 'file|mimes:docx,doc,pdf|max:10240',
            'images'         => 'nullable|array',
            'images.*'       => 'file|mimes:jpg,jpeg,png,gif,webp|max:5120',
            'remove_files'   => 'nullable|array',
            'remove_files.*' => 'exists:contribution_files,id',
        ]);

        DB::transaction(function () use ($request, $contribution) {
            $contribution->update([
                'title'       => $request->title,
                'description' => $request->description,
            ]);

            if ($request->remove_files) {
                $filesToRemove = $contribution->files()->whereIn('id', $request->remove_files)->get();
                foreach ($filesToRemove as $file) {
                    Storage::disk($file->disk)->delete($file->file_path);
                    $file->delete();
                }
            }

            $remainingDocs   = $contribution->fresh()->documents()->count();
            $remainingImages = $contribution->fresh()->images()->count();

            $newDocs   = $request->hasFile('documents') ? count($request->file('documents')) : 0;
            $newImages = $request->hasFile('images')    ? count($request->file('images'))    : 0;

            if ($remainingDocs + $newDocs > 2) {
                abort(422, 'You can have a maximum of 2 documents per contribution.');
            }
            if ($remainingImages + $newImages > 5) {
                abort(422, 'You can have a maximum of 5 images per contribution.');
            }

            if ($remainingDocs + $newDocs < 1) {
                abort(422, 'At least one document is required.');
            }

            $this->uploadFiles($contribution, $request);
        });

        return redirect()->route('contributions.show', $contribution)
            ->with('success', 'Contribution updated.');
    }

    // -------------------------------------------------------------------------
    // Student: delete contribution
    // -------------------------------------------------------------------------
    public function destroy(Contribution $contribution)
    {
        $user = Auth::user();
        abort_unless($user->hasRole('student'), 403);
        abort_unless($user->student->id === $contribution->student_id, 403);
        abort_unless($contribution->post->isOpenForSubmission(), 403, 'You can no longer delete this submission.');

        DB::transaction(function () use ($contribution) {
            foreach ($contribution->files as $file) {
                Storage::disk($file->disk)->delete($file->file_path);
                $file->forceDelete();
            }
            $contribution->forceDelete();
        });

        return redirect()->route('posts.index')
            ->with('success', 'Contribution deleted.');
    }

    // -------------------------------------------------------------------------
    // Coordinator / Manager / Admin: index
    // -------------------------------------------------------------------------
    public function index(Request $request)
    {
        $user      = Auth::user();
        $isManager = $user->hasAnyRole(['marketing_manager', 'admin']);

        $query = Contribution::with(['student.user', 'post.faculty', 'academicYear'])
            ->withCount('comments')
            ->orderBy('created_at', 'desc');

        if ($user->hasRole('marketing_coordinator')) {
            $facultyId = $user->staff->faculty_id;
            $query->whereIn('post_id', Post::where('faculty_id', $facultyId)->select('id'));
        }

        if ($isManager) {
            $status = $request->input('status', 'approved');
            if ($status !== 'all') {
                $query->where('status', $status);
            }
        }

        $contributions = $query->paginate(15)->withQueryString();

        $statusFilter = $isManager ? $request->input('status', 'approved') : null;

        return view('contributions.index', compact('contributions', 'isManager', 'statusFilter'));
    }

    // -------------------------------------------------------------------------
    // Coordinator: add comment
    // -------------------------------------------------------------------------
    public function comment(Request $request, Contribution $contribution)
    {
        $user = Auth::user();
        abort_unless($user->hasRole('marketing_coordinator'), 403);

        $request->validate(['content' => 'required|string|max:2000']);

        $contribution->comments()->create([
            'user_id' => $user->id,
            'content' => $request->content,
        ]);

        $contribution->load('student.user');
        $student = $contribution->student->user ?? null;
        if ($student) {
            $student->notify(new ContributionStatusUpdated($contribution, 'commented'));
        }

        return back()->with('success', 'Comment added.');
    }

    // -------------------------------------------------------------------------
    // Coordinator: toggle approval
    // -------------------------------------------------------------------------
    public function toggleApproval(Contribution $contribution)
    {
        $user = Auth::user();
        abort_unless($user->hasRole('marketing_coordinator'), 403);

        $hasCommented = $contribution->comments()->where('user_id', $user->id)->exists();
        if (!$hasCommented) {
            return back()->with('error', 'You must leave a comment before approving or revoking approval.');
        }

        $contribution->load('student.user');
        $student = $contribution->student->user ?? null;

        if ($contribution->is_selected) {
            $contribution->update([
                'is_selected' => false,
                'selected_at' => null,
                'selected_by' => null,
                'status'      => 'under_review',
            ]);
        } else {
            $contribution->update([
                'is_selected' => true,
                'selected_at' => now(),
                'selected_by' => $user->id,
                'status'      => 'approved',
            ]);

            if ($student) {
                $student->notify(new ContributionStatusUpdated($contribution, 'approved'));
            }
        }

        return back()->with('success', 'Publication status updated.');
    }

    // -------------------------------------------------------------------------
    // Coordinator: reject contribution
    // -------------------------------------------------------------------------
    public function reject(Contribution $contribution)
    {
        $user = Auth::user();
        abort_unless($user->hasRole('marketing_coordinator'), 403);

        $hasCommented = $contribution->comments()->where('user_id', $user->id)->exists();
        if (!$hasCommented) {
            return back()->with('error', 'You must leave a comment before rejecting a contribution.');
        }

        $contribution->update([
            'status'      => 'rejected',
            'is_selected' => false,
            'selected_at' => null,
            'selected_by' => null,
        ]);

        $contribution->load('student.user');
        $student = $contribution->student->user ?? null;
        if ($student) {
            $student->notify(new ContributionStatusUpdated($contribution, 'rejected'));
        }

        return back()->with('success', 'Contribution has been rejected.');
    }

    // -------------------------------------------------------------------------
    // Report a contribution
    // -------------------------------------------------------------------------
    public function report(Request $request, Contribution $contribution)
    {
        $request->validate(['reason' => 'required|string|max:1000']);

        $report = Report::create([
            'reportable_type' => Contribution::class,
            'reportable_id'   => $contribution->id,
            'reported_by'     => Auth::id(),
            'reason'          => $request->reason,
        ]);

        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewReport($report));
        }

        return back()->with('success', 'Report submitted. An administrator will review it.');
    }

    // -------------------------------------------------------------------------
    // Manager / Admin: download selected contributions as ZIP
    // -------------------------------------------------------------------------
    public function download(Request $request)
    {
        $user = Auth::user();
        abort_unless($user->hasAnyRole(['marketing_manager', 'admin']), 403);

        $ids = array_filter(explode(',', $request->input('ids', '')));
        abort_if(empty($ids), 422, 'No contributions selected.');

        $contributions = Contribution::with('files')
            ->whereIn('id', $ids)
            ->where('status', 'approved')
            ->get();

        abort_if($contributions->isEmpty(), 404, 'No approved contributions found for the selected IDs.');

        $zipName = 'contributions_' . now()->format('Y_m_d_His') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipName);

        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $zip = new \ZipArchive();
        abort_unless($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true, 500, 'Could not create ZIP file.');

        foreach ($contributions as $contribution) {
            $folderName = Str::slug($contribution->title) . '_' . $contribution->id;
            foreach ($contribution->files as $file) {
                $contents = Storage::disk($file->disk)->get($file->file_path);
                if ($contents) {
                    $zip->addFromString($folderName . '/' . $file->original_name, $contents);
                }
            }
        }

        $zip->close();

        return response()->download($zipPath, $zipName)->deleteFileAfterSend(true);
    }

    // -------------------------------------------------------------------------
    // Student: delete a single file (AJAX)
    // -------------------------------------------------------------------------
    public function destroyFile(ContributionFile $file)
    {
        $user = Auth::user();
        abort_unless($user->hasRole('student'), 403);
        abort_unless($file->contribution->student->user_id === $user->id, 403);

        Storage::disk($file->disk)->delete($file->file_path);
        $file->delete();

        return response()->json(['success' => true]);
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function authorizeView($user, Contribution $contribution): void
    {
        if ($user->hasRole('admin') || $user->hasRole('marketing_manager')) return;

        if ($user->hasRole('student')) {
            abort_unless($user->student->id === $contribution->student_id, 403);
            return;
        }

        if ($user->hasRole('marketing_coordinator')) {
            $facultyId = $user->staff->faculty_id;
            abort_unless($contribution->post->faculty_id === $facultyId, 403);
            return;
        }

        abort(403);
    }

    private function uploadFiles(Contribution $contribution, Request $request): void
    {
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->storeAs(
                    "contributions/{$contribution->id}/documents",
                    Str::uuid() . '.' . $file->getClientOriginalExtension(),
                    's3_documents'
                );

                ContributionFile::create([
                    'contribution_id' => $contribution->id,
                    'file_type'       => 'document',
                    'disk'            => 's3_documents',
                    'file_path'       => $path,
                    'original_name'   => $file->getClientOriginalName(),
                    'mime_type'       => $file->getMimeType(),
                    'file_size'       => $file->getSize(),
                ]);
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->storeAs(
                    "contributions/{$contribution->id}/images",
                    Str::uuid() . '.' . $file->getClientOriginalExtension(),
                    's3_images'
                );

                ContributionFile::create([
                    'contribution_id' => $contribution->id,
                    'file_type'       => 'image',
                    'disk'            => 's3_images',
                    'file_path'       => $path,
                    'original_name'   => $file->getClientOriginalName(),
                    'mime_type'       => $file->getMimeType(),
                    'file_size'       => $file->getSize(),
                ]);
            }
        }
    }
}
