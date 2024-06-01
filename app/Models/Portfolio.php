<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class Portfolio extends Model
{
    use HasFactory;

    protected $appends = ['project_date_human', 'select_value'];
    protected $fillable = ['name', 'description', 'url', 'project_date', 'tags'];
    public static $headers = ['id' => 'Id', 'name' => 'Name', 'description' => 'Description', 'url' => 'Url', 'project_date' => 'Project Date', 'tags' => 'Tags', 'created_at' => 'Created at', 'updated_at' => 'Updated at'];

    /**
     * Mutators
     */

    protected $formatDates = [
        'es' => 'd \d\e M \d\e\l Y',
        'en' => 'M d, Y'
    ];

    protected function description(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $this->getTranslation($attributes['id'] ?? null)['value']['description'] ?? $attributes['description'] ?? ''
        );
    }

    protected function projectDate(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null
        );
    }

    protected function projectDateHuman(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Carbon\Carbon::parse($attributes['project_date'] ?? null)->translatedFormat($this->formatDates[Cookie::get('lang') ?? 'es'])
        );
    }

    protected function tags(): Attribute
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
