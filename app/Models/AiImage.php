<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiImage extends Model
{
    protected $fillable = [
        'user_id',
        'prompt',
        'negative_prompt',
        'image_url',
        'status',
        'image_type',
        'progress',
        'provider'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
