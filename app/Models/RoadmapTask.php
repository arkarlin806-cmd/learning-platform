<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoadmapTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'phase_id',
        'title',
        'description',
        'course_id',
        'estimated_minutes',
        'lesson_count',
        'practice_count',
        'sort_order'
    ];

    public function phase()
    {
        return $this->belongsTo(RoadmapPhase::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progresses()
    {
        return $this->hasMany(UserTaskProgress::class, 'task_id');
    }
}
