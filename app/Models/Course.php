<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\B2StorageService;

class Course extends Model
{
    protected $fillable = [
        'instructor_id',
        'title',
        'description',
        'category',
        'level',
        'price',
        'thumbnail',
        'start_date',
        'end_date',
        'status',
    ];

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class);
    }
    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }
    public function instructor()    //single course show instructor
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function orders()
    {
        return $this->hasMany(CourseOrder::class, 'course_id');
    }
    public function lessons()
    {
        return $this->hasMany(Lesson::class)->latest();
    }
    public function groupChat()
    {
        return $this->hasOne(GroupChat::class, 'course_id');
    }
    public function quiz()
    {
        return $this->hasMany(
            Quiz::class
        );
    }
    public function liveSessions()
    {
        return $this->hashMany(CourseLiveSession::class);
    }
    public function ratings()
    {
        return $this->hasMany(CourseRating::class, 'course_id');
    }
    public function getAverageRatingAttribute()
    {
        return round($this->ratings()->avg('rating'), 1);
    }
    public function getRatingCountAttribute()
    {
        return $this->ratings()->count();
    }
    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail) {
            return null;
        }

        try {
            return app(B2StorageService::class)
                ->getDownloadUrl($this->thumbnail, 3600);
        } catch (\Throwable $e) {
            return null;
        }
    }
}
