<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTaskProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal_id',
        'task_id',
        'completed',
        'completed_at'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'completed_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function goal()
    {
        return $this->belongsTo(LearningGoal::class, 'goal_id');
    }

    public function task()
    {
        return $this->belongsTo(RoadmapTask::class, 'task_id');
    }
}
