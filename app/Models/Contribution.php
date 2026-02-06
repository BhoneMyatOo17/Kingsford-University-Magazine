<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contribution extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'academic_year_id',
        'title',
        'description',
        'document_path',
        'document_name',
        'terms_accepted',
        'terms_accepted_at',
        'is_selected',
        'selected_at',
        'selected_by',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'terms_accepted' => 'boolean',
            'terms_accepted_at' => 'datetime',
            'is_selected' => 'boolean',
            'selected_at' => 'datetime',
        ];
    }

    /**
     * Get the student who made this contribution.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the academic year this contribution belongs to.
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    /**
     * Get the user (coordinator) who selected this contribution.
     */
    public function selectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'selected_by');
    }

    /**
     * Get all images associated with this contribution.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ContributionImage::class);
    }

    /**
     * Get all comments on this contribution.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope to get only selected contributions.
     */
    public function scopeSelected($query)
    {
        return $query->where('is_selected', true);
    }

    /**
     * Scope to get contributions by status.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope to get contributions for a specific academic year.
     */
    public function scopeForAcademicYear($query, $academicYearId)
    {
        return $query->where('academic_year_id', $academicYearId);
    }

    /**
     * Scope to get contributions by student.
     */
    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    /**
     * Scope to get contributions by faculty (through student relationship).
     */
    public function scopeByFaculty($query, $facultyId)
    {
        return $query->whereHas('student', function ($q) use ($facultyId) {
            $q->where('faculty_id', $facultyId);
        });
    }

    /**
     * Scope to get contributions that need comments (no comments within 14 days).
     */
    public function scopeNeedingComments($query)
    {
        return $query->where('status', 'submitted')
            ->whereDoesntHave('comments')
            ->where('created_at', '<=', now()->subDays(14));
    }

    /**
     * Check if contribution has been commented on.
     */
    public function hasComments(): bool
    {
        return $this->comments()->exists();
    }

    /**
     * Check if contribution is overdue for comments (14 days).
     */
    public function isOverdueForComments(): bool
    {
        return !$this->hasComments() 
            && $this->status === 'submitted'
            && $this->created_at->diffInDays(now()) > 14;
    }

    /**
     * Mark contribution as selected for publication.
     */
    public function markAsSelected(User $coordinator): void
    {
        $this->update([
            'is_selected' => true,
            'selected_at' => now(),
            'selected_by' => $coordinator->id,
            'status' => 'selected',
        ]);
    }

    /**
     * Unmark contribution as selected.
     */
    public function unmarkAsSelected(): void
    {
        $this->update([
            'is_selected' => false,
            'selected_at' => null,
            'selected_by' => null,
            'status' => 'under_review',
        ]);
    }

    /**
     * Accept terms and conditions.
     */
    public function acceptTerms(): void
    {
        $this->update([
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ]);
    }

    /**
     * Get the faculty this contribution belongs to (through student).
     */
    public function getFaculty()
    {
        return $this->student->faculty;
    }

    /**
     * Get the full path to the document.
     */
    public function getDocumentFullPath(): string
    {
        return storage_path('app/' . $this->document_path);
    }

    /**
     * Check if document exists.
     */
    public function documentExists(): bool
    {
        return file_exists($this->getDocumentFullPath());
    }
}