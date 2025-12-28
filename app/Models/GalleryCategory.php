<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'order',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class)->where('status', true)->orderBy('order');
    }
}
