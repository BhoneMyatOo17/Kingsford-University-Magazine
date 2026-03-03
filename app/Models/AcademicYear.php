<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'year',
        'closure_date',
        'final_closure_date',
        'is_active',
        'description',
    ];

    protected $casts = [
        'closure_date'       => 'date',
        'final_closure_date' => 'date',
        'is_active'          => 'boolean',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }

    public static function getActive(): ?self
    {
        return self::where('is_active', true)->first();
    }
}
