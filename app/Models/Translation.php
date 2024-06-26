<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = ['value' => 'array'];
    protected $fillable = ['model_id', 'model_name', 'lang', 'value'];
    public static $headers = ['id' => 'Id', 'model_id' => 'Model ID', 'model_name' => 'Model name', 'lang' => 'Language', 'value' => 'Value', 'created_at' => 'Created at', 'updated_at' => 'Updated at', 'select_value' => 'Name'];

    /**
     * Mutators
     */

    protected function selectValue(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value, array $attributes) {
                if (isset($attributes['model_name']) && $attributes['model_name']) {
                    $model = 'App\Models\\' .  $attributes['model_name'];
                    return $attributes['model_name'] . ': '. ($model::find($attributes['model_id'])->select_value ?? 'Unknown');
                } else {
                    return '-';
                }
            }
        );
    }

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
