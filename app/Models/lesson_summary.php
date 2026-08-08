<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lesson_summary extends Model
{
    protected $table = 'lesson_summaries';
    protected $fillable = [
        'lesson_id',
        'title',
        'summary',
        'key_points',
        'source_type'
    ];

    protected $casts = [
        'key_points' => 'array',
    ];

    /* ---------------- RELATION ---------------- */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
