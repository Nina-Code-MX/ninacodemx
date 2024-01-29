<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'value' => 'array'
    ];
    protected $fillable = ['model_id', 'model_name', 'lang', 'value'];

    /**
     * Mutators
     */

    /*protected function lang(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => mb_convert_case(config('app.locale_available')[$value] ?? 'Español', MB_CASE_TITLE, 'UTF-8'),
            set: fn (mixed $value, array $attributes) => strtolower(isset(config('app.locale_available')[$value]) ? $value : 'es')
        );
    }*/

    /**
     * Relationships
     */
}
