<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'quiz_id',
        'type',
        'question',
        'points',
        'position',
        'correct_answer',
        'difficulty',
        'blooms_level',
        'explanation',
        'media',
    ];

    public function quiz()
    {
        return $this->belongsTo(
            Quiz::class
        );
    }

    public function options()
    {
        return $this->hasMany(
            QuestionOption::class
        );
    }

    public function studentAnswers()
    {
        return $this->hasMany(
            StudentAnswer::class
        );
    }
}
