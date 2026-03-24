<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Magazine extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'academic_year_id',
        'created_by',
        'title',
        'description',
        'published_date',
        'cover_image_path',
        'cover_image_disk',
        'pdf_path',
        'pdf_disk',
        'content',
        'view_count',
    ];

    protected function casts(): array
    {
        return [
            'published_date' => 'date',
        ];
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getCoverUrlAttribute(): ?string
    {
        if (!$this->cover_image_path || !$this->cover_image_disk) return null;
        return Storage::disk($this->cover_image_disk)->url($this->cover_image_path);
    }

    public function getPdfUrlAttribute(): ?string
    {
        if (!$this->pdf_path || !$this->pdf_disk) return null;
        return Storage::disk($this->pdf_disk)->url($this->pdf_path);
    }
}
