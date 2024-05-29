<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cookie;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['full_name'];
    protected $fillable = ['first_name', 'last_name', 'title', 'image', 'order'];
    public static $headers = ['id' => 'Id', 'first_name' => 'First name', 'last_name' => 'Last name', 'title' => 'Title', 'image' => 'Image', 'order' => 'Order', 'created_at' => 'Created at', 'updated_at' => 'Updated at', 'deleted_at' => 'Deleted at'];

    /**
     * Mutators
     */

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $value ? json_decode($value, true) : null,
            set: fn (mixed $value) => json_encode($value)
        );
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ucfirst(($attributes['first_name'] ?? '') . ' ' . ($attributes['last_name'] ?? ''))
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getTranslation($attributes['id'] ?? null)['value']['title'] ?? $attributes['title'] ?? ''
        );
    }

    /**
     * Relationships
     */

    public function teamSocials(): HasMany
    {
        return $this->hasMany(TeamSocial::class);
    }

    /**
     * Translation
     */

    public function getTranslation($model_id)
    {
        $classPath = explode('\\', self::class);
        $translation = Translation::where('model_name', end($classPath))
            ->where('model_id', $model_id)
            ->where('lang', Cookie::get('lang') ?? 'es');

        return $translation->first() ? $translation->first()->toArray() : [];
    }
}
