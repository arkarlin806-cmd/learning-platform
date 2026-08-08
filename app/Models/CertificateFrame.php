<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateFrame extends Model
{
    use HasFactory;

    protected $fillable = [

        'category',
        'frame_name',
        'background',
        'border_image',
        'watermark',
        'logo',
        'seal',
        'primary_color',
        'secondary_color',
        'accent_color',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
