<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['full_name'];
    protected $fillable = ['first_name', 'last_name', 'title', 'image', 'order'];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ucfirst($attributes['first_name'] . ' ' . $attributes['last_name'])
        );
    }

    public function teamSocials(): HasMany
    {
        return $this->hasMany(TeamSocial::class);
    }
}
