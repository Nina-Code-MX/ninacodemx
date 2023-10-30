<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Portfolio extends Model
{
    use HasFactory;

    protected $appends = ['project_date_human'];
    protected $casts = [
        'tags' => 'array'
    ];
    protected $fillable = ['name', 'description', 'url', 'project_date', 'tags'];

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
            get: fn (mixed $value, array $attributes) => $this->getTranslation($attributes['id'])['value']['description'] ?? $attributes['description']
        );
    }

    protected function projectDateHuman(): Attribute
    {

        return Attribute::make(
            get: fn (mixed $value, array $attributes) => \Carbon\Carbon::parse($attributes['project_date'])->translatedFormat($this->formatDates[Cookie::get('lang') ?? 'es'])
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
            ->where('lang', Cookie::get('lang'));
        return $translation->first() ? $translation->first()->toArray() : [];
    }
}
