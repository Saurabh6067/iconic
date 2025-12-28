<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'whatsapp_updates',
        'status'
    ];

    protected $casts = [
        'whatsapp_updates' => 'boolean',
    ];
}
