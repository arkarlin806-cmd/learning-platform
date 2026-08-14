<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // protected $table = 'lessons';
    protected $fillable = [

        'course_id',
        'title',
        'description',
        'lesson_type',
        'file_path',
        'summary_status',
        'summary_progress',
        'summary_error',
        'ai_generated',
    ];
    protected $casts = [
        'ai_generated' => 'array',
    ];

    // public function summary()
    // {
    //     return $this->hasMany(
    //         lesson_summary::class,
    //     );
    // }
    public function summary()
    {
        return $this->hasOne(lesson_summary::class, 'lesson_id');
    }
    public function s()
    {
        return $this->hasMany(
            lesson_summary::class,
        );
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function liveSession()
    {
        return $this->belongsTo(CourseLiveSession::class, 'live_session_id');
    }
}
