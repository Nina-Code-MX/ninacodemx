<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['page', 'service', 'ip_address', 'first_name', 'last_name', 'company', 'phone', 'email', 'message'];
}
