<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamSocial extends Model
{
    use HasFactory;

    protected $appends = ['logo', 'select_value'];
    protected $fillable = ['team_id', 'type', 'link'];
    protected $icons = [
        'bitbucket' => 'fa-brands fa-bitbucket',
        'dog' => 'fa-solid fa-dog',
        'facebook' => 'fa-brands fa-square-facebook',
        'github' => 'fa-brands fa-github',
        'gitlab' => 'fa-brands fa-gitlab',
        'instagram' => 'fa-brands fa-instagram',
        'linkedin' => 'fa-brands fa-linkedin',
        'twitter' => 'fa-brands fa-square-x-twitter',
        'youtube' => 'fa-brands fa-youtube'
    ];

    /**
     * Mutators
     */

    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->icons[$attributes['type'] ?? 'dog']
        );
    }

    protected function selectValue(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ($attributes['team_id'] ?? '') . ': ' .ucfirst(($attributes['type'] ?? ''))
        );
    }

    /**
     * Relationships
     */

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
