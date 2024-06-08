<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes as EloquentSoftDeletes;


class Article extends Model
{
    use HasFactory, EloquentSoftDeletes;

    protected $fillable = [

        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'user_id',

    ];

    protected $dates = ['deleted_at'];


}
