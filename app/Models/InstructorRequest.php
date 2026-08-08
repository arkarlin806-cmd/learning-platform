<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorRequest extends Model
{
    protected $fillable = [

        'user_id',
        'full_name',
        'email',
        'phone',
        'profession',
        'experience',
        'bio',
        'cv',
        'certificate',
        'status',
        'reject_reason',
        'approved_at',
        'approved_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
