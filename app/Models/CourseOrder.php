<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOrder extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'instructor_id',
        'order_no',
        'amount',
        'admin_amount',
        'instructor_amount',
        'payment_method',
        'payment_screenshot',
        'status',
        'paid_at',
        'percentage'
    ];

    protected $casts = [
        'paid_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}
