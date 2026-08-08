<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearningGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'goal_name',
        'current_level',
        'target_role',
        'daily_hours',
        'daily_lessons',
        'study_days_per_week',
        'estimated_finish_date',
        'estimated_days',
        'status'
    ];

    protected $casts = [
        'estimated_finish_date' => 'date',
        'daily_hours' => 'float'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function progresses()
    {
        return $this->hasMany(UserTaskProgress::class, 'goal_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getRemainingDaysAttribute()
    {
        if (!$this->estimated_finish_date) {
            return null;
        }

        return now()->diffInDays($this->estimated_finish_date, false);
    }
}
