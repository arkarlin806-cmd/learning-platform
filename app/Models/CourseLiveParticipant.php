<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLiveParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'live_session_id',
        'user_id',
        'role',
        'joined_at',
        'left_at',
        'duration_seconds',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
    ];

    public function session()
    {
        return $this->belongsTo(CourseLiveSession::class, 'live_session_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
