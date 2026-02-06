<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Boot method to add model events
     */
    protected static function boot()
    {
        parent::boot();

        // Validate email domain before creating/updating
        static::creating(function ($user) {
            if (!self::isUniversityEmail($user->email)) {
                throw new \InvalidArgumentException('Email must be a valid Kingsford University email (@ksf.it.com)');
            }
        });

        static::updating(function ($user) {
            if ($user->isDirty('email') && !self::isUniversityEmail($user->email)) {
                throw new \InvalidArgumentException('Email must be a valid Kingsford University email (@ksf.it.com)');
            }
        });
    }

    /**
     * Validate if email is university email
     *
     * @param string $email
     * @return bool
     */
    public static function isUniversityEmail(string $email): bool
    {
        return str_ends_with(strtolower($email), '@ksf.it.com');
    }

    /**
     * Get the student profile associated with the user.
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Get the staff profile associated with the user.
     */
    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }

    /**
     * Check if user is a student
     */
    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    /**
     * Check if user is marketing coordinator
     */
    public function isMarketingCoordinator(): bool
    {
        return $this->hasRole('marketing_coordinator');
    }

    /**
     * Check if user is marketing manager
     */
    public function isMarketingManager(): bool
    {
        return $this->hasRole('marketing_manager');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is guest
     */
    public function isGuest(): bool
    {
        return $this->hasRole('guest');
    }

    /**
     * Get user's faculty (works for both students and staff)
     */
    public function getFaculty()
    {
        if ($this->student) {
            return $this->student->faculty;
        }
        
        if ($this->staff && $this->staff->faculty) {
            return $this->staff->faculty;
        }
        
        return null;
    }

    /**
     * Update last login timestamp
     */
    public function updateLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }

    /**
     * Scope to get only active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get users by role
     */
    public function scopeWithRole($query, string $role)
    {
        return $query->role($role);
    }
}