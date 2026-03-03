<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Contribution extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'post_id',
        'academic_year_id',
        'title',
        'description',
        'terms_accepted',
        'terms_accepted_at',
        'is_selected',
        'selected_at',
        'selected_by',
        'status',
    ];

    protected $casts = [
        'terms_accepted'  => 'boolean',
        'terms_accepted_at' => 'datetime',
        'is_selected'     => 'boolean',
        'selected_at'     => 'datetime',
    ];

    // --- Relationships ---

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function selectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'selected_by');
    }

    public function files(): HasMany
    {
        return $this->hasMany(ContributionFile::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(ContributionFile::class)->where('file_type', 'document');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ContributionFile::class)->where('file_type', 'image');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'asc');
    }

    public function reports(): MorphMany
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
