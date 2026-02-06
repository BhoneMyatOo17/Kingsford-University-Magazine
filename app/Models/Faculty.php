<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get all students in this faculty.
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    /**
     * Get all staff in this faculty.
     */
    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class);
    }

    /**
     * Get the marketing coordinator for this faculty
     */
    public function marketingCoordinator()
    {
        return $this->staff()
            ->whereHas('user', function ($query) {
                $query->role('marketing_coordinator');
            })
            ->with('user')
            ->first();
    }

    /**
     * Get all contributions from students in this faculty
     */
    public function contributions()
    {
        return Contribution::whereHas('student', function ($query) {
            $query->where('faculty_id', $this->id);
        });
    }

    /**
     * Scope to get only active faculties
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}