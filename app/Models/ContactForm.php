<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['page', 'service', 'ip_address', 'first_name', 'last_name', 'company', 'phone', 'email', 'message'];
    public static $headers = ['id' => 'Id', 'page' => 'Page', 'service' => 'Service', 'ip_address' => 'IP Address', 'first_name' => 'First name', 'last_name' => 'Last name', 'company' => 'Company', 'phone' => 'Phone', 'email' => 'Email', 'message' => 'Message', 'created_at' => 'Created at', 'updated_at' => 'Updated at', 'select_value' => 'Name'];

    protected function selectValue(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ucfirst(($attributes['first_name'] ?? '') . ' ' . ($attributes['last_name'] ?? ''))
        );
    }
}
