<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ContributionFile extends Model
{
    protected $fillable = [
        'contribution_id',
        'file_type',
        'disk',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
    ];

    // --- Relationships ---

    public function contribution(): BelongsTo
    {
        return $this->belongsTo(Contribution::class);
    }

    // --- Helpers ---

    /**
     * Returns a temporary signed URL for private documents (60 min).
     * Returns a public URL for images.
     */
    public function getUrl(int $minutes = 60): string
    {
        if ($this->file_type === 'document') {
            return Storage::disk($this->disk)->temporaryUrl($this->file_path, now()->addMinutes($minutes));
        }

        return Storage::disk($this->disk)->url($this->file_path);
    }

    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1048576) return round($bytes / 1024, 1) . ' KB';
        return round($bytes / 1048576, 1) . ' MB';
    }
}
