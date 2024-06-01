<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['select_value'];
    protected $fillable = ['name', 'excerpt', 'description', 'slug', 'image', 'order'];
    public static $headers = ['id' => 'Id', 'name' => 'Name', 'excerpt' => 'Excerpt', 'description' => 'Description', 'slug' => 'Slug', 'image' => 'Image', 'order' => 'Order', 'created_at' => 'Created at', 'updated_at' => 'Updated at', 'deleted_at' => 'Deleted at'];

    /**
     * Mutators
     */

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getTranslation($attributes['id'] ?? null)['value']['name'] ?? $attributes['name'] ?? ''
        );
    }

    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getTranslation($attributes['id'] ?? null)['value']['excerpt'] ?? $attributes['excerpt'] ?? ''
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getTranslation($attributes['id'] ?? null)['value']['description'] ?? $attributes['description'] ?? ''
        );
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getTranslation($attributes['id'] ?? null)['value']['slug'] ?? $attributes['slug'] ?? ''
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $value ? json_decode($value, true) : null,
            set: fn (mixed $value) => json_encode($value)
        );
    }

    protected function selectValue(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ucfirst(($attributes['name'] ?? ''))
        );
    }

    /**
     * Relationships
     */

    public function translations(): HasMany
    {
        $classPath = explode('\\', self::class);
        return $this->hasMany(Translation::class, 'model_id', 'id')->where('model_name', end($classPath));
    }

    /**
     * Translation
     */

    public function getTranslation($model_id)
    {
        $classPath = explode('\\', self::class);
        $translation = Translation::where('model_name', end($classPath))
            ->where('model_id', $model_id)
            ->where('lang', App::getLocale() ?? 'es');

        return $translation->first() ? $translation->first()->toArray() : [];
    }

}
