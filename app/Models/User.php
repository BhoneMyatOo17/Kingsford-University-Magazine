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

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'is_active',
        'last_login_at',
        'previous_login_at',
        'last_login_browser',
        'profile_picture',
        'password_changed_at',
        'must_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at'    => 'datetime',
            'last_login_at'        => 'datetime',
            'previous_login_at'    => 'datetime',
            'password_changed_at'  => 'datetime',
            'password'             => 'hashed',
            'is_active'            => 'boolean',
            'must_change_password' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

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

    public static function isValidEmail(string $email, $user = null): bool
    {
        $email = strtolower($email);

        if ($email === 'test@ksf.it.com') {
            return true;
        }

        if ($user && $user->hasRole('guest')) {
            return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
        }

        return str_ends_with($email, '@ksf.it.com');
    }

    public static function isUniversityEmail(string $email): bool
    {
        return str_ends_with(strtolower($email), '@ksf.it.com');
    }

    public function shouldSkipEmailVerification(): bool
    {
        return strtolower($this->email) === 'test@ksf.it.com';
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }

    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    public function isMarketingCoordinator(): bool
    {
        return $this->hasRole('marketing_coordinator');
    }

    public function isMarketingManager(): bool
    {
        return $this->hasRole('marketing_manager');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isGuest(): bool
    {
        return $this->hasRole('guest');
    }

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

    public function updateLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithRole($query, string $role)
    {
        return $query->role($role);
    }
}
