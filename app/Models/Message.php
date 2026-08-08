<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'role',
        'content',
        'audio_path',
        'audio_name',
        'audio_duration',
        'mime_type',
        'is_audio'
    ];

    public function conversation()
    {
        return $this->belongsTo(
            Conversation::class
        );
    }
}
