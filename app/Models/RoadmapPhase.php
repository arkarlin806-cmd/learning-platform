<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoadmapPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'roadmap_id',
        'phase_no',
        'title',
        'description',
        'estimated_days',
        'sort_order'
    ];

    public function roadmap()
    {
        return $this->belongsTo(LearningRoadmap::class);
    }

    public function tasks()
    {
        return $this->hasMany(RoadmapTask::class, 'phase_id')
            ->orderBy('sort_order');
    }
}
