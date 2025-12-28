<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'email',
        'whatsapp',
        'whatsapp_message',
        'facebook',
        'instagram',
        'pinterest',
        'youtube'
    ];

    /**
     * Get the site settings (singleton pattern)
     */
    public static function getSettings()
    {
        return self::firstOrCreate([]);
    }
}
