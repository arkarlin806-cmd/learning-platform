<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearningRoadmap extends Model
{
    use HasFactory;

    protected $fillable = [
        'career',
        'description',
        'source',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function phases()
    {
        return $this->hasMany(RoadmapPhase::class, 'roadmap_id')
            ->orderBy('sort_order');
    }
    public function tasks()
    {
        return $this->hasManyThrough(RoadmapTask::class, RoadmapPhase::class, 'roadmap_id', 'phase_id');
    }

    public function scopeDefault($query)
    {
        return $query->where('source', 'default');
    }

    public function scopeAI($query)
    {
        return $query->where('source', 'ai');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
