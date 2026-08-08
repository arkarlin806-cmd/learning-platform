<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'instructor_id',
        'amount',
        'payment_method',
        'account_name',
        'account_number',
        'note',
        'status',
        'approved_at',
        'rejected_reason'
    ];

    public function wallet()
    {
        return $this->belongsTo(InstructorWallet::class, 'wallet_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
