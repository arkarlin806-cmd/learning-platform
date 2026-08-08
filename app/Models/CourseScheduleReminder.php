<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseScheduleReminder extends Model
{

    protected $fillable = [

        'course_schedule_id',
        'sent_date'

    ];



    public function schedule()
    {
        return $this->belongsTo(
            CourseSchedule::class,
            'course_schedule_id'
        );
    }
}
