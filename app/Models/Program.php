<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'faculty_id',
        'name',
        'description',
        'level',
        'duration_years',
        'duration_mode',
        'fees_per_semester',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'fees_per_semester' => 'decimal:2',
        'duration_years' => 'integer',
    ];

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function getLevelLabelAttribute(): string
    {
        return match($this->level) {
            'undergraduate' => 'Undergraduate',
            'postgraduate'  => 'Postgraduate',
            'doctorate'     => 'Doctorate',
            default         => ucfirst($this->level),
        };
    }

    public function getDurationStringAttribute(): string
    {
        return "{$this->duration_years} Year" . ($this->duration_years > 1 ? 's' : '') . " ({$this->duration_mode})";
    }
}