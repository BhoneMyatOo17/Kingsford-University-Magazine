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
        'email_verified_at',
        'is_active',
        'last_login_at',
        'profile_picture',
        'password_changed_at',
        'must_change_password',
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
            'password_changed_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'must_change_password' => 'boolean',
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
            if (!self::isValidEmail($user->email, $user)) {
                throw new \InvalidArgumentException('Invalid email domain for this user type.');
            }
        });

        static::updating(function ($user) {
            if ($user->isDirty('email') && !self::isValidEmail($user->email, $user)) {
                throw new \InvalidArgumentException('Invalid email domain for this user type.');
            }
        });
    }

    /**
     * Validate if email is valid based on user role
     *
     * @param string $email
     * @param User|null $user
     * @return bool
     */
    public static function isValidEmail(string $email, $user = null): bool
    {
        $email = strtolower($email);
        
        // Exception 1: test@ksf.it.com is always valid
        if ($email === 'test@ksf.it.com') {
            return true;
        }

        // Exception 2: Guest role can use any email domain
        if ($user && $user->hasRole('guest')) {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        // All other roles must use @ksf.it.com domain
        return str_ends_with($email, '@ksf.it.com');
    }

    /**
     * Validate if email is university email (for backward compatibility)
     *
     * @param string $email
     * @return bool
     */
    public static function isUniversityEmail(string $email): bool
    {
        return str_ends_with(strtolower($email), '@ksf.it.com');
    }

    /**
     * Check if email verification should be skipped
     *
     * @return bool
     */
    public function shouldSkipEmailVerification(): bool
    {
        return strtolower($this->email) === 'test@ksf.it.com';
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