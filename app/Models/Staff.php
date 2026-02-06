<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'staff_id',
        'faculty_id',
        'department',
        'position',
        'hire_date',
        'phone',
        'office_location',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'hire_date' => 'date',
        ];
    }

    /**
     * Get the user that owns the staff profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the faculty the staff belongs to (nullable for Marketing Managers).
     */
    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * Check if staff member is assigned to a faculty
     */
    public function hasFaculty(): bool
    {
        return !is_null($this->faculty_id);
    }

    /**
     * Scope to filter by faculty
     */
    public function scopeInFaculty($query, $facultyId)
    {
        return $query->where('faculty_id', $facultyId);
    }

    /**
     * Scope to get staff without faculty assignment
     */
    public function scopeWithoutFaculty($query)
    {
        return $query->whereNull('faculty_id');
    }
}