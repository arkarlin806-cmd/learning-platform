<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorWallet extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
        'total_earned',
        'pending_balance',
        'total_withdrawn'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
