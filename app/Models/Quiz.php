<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'course_id',
        'title',
        'description',
        'passing_score',
        'shuffle_questions',
        'show_answers',
        'status',
        'end_at',
    ];

    public function questions()
    {
        return $this->hasMany(
            Question::class
        )->orderBy('position');
    }

    public function studentAnswers()
    {
        return $this->hasMany(
            StudentAnswer::class
        );
    }
    public function course()
    {
        return $this->belongsTo(
            Course::class
        );
    }
}
