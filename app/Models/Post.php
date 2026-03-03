<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'faculty_id',
        'academic_year_id',
        'created_by',
        'closure_date',
        'is_published',
    ];

    protected $casts = [
        'closure_date' => 'date',
        'is_published'  => 'boolean',
    ];

    // --- Relationships ---

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    // --- Helpers ---

    /**
     * Whether students can still submit new contributions.
     * Uses the post's own closure_date.
     */
    public function isOpenForSubmission(): bool
    {
        return Carbon::today()->lte($this->closure_date);
    }

    /**
     * Whether students can still edit/delete their contribution.
     * Uses the academic year's final_closure_date.
     */
    public function isOpenForEdit(): bool
    {
        return Carbon::today()->lte($this->academicYear->final_closure_date);
    }
}
