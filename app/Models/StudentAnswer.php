<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'question_id',
        'answer',
        'is_correct',
        'marks_obtained',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function quiz()
    {
        return $this->belongsTo(
            Quiz::class
        );
    }

    public function question()
    {
        return $this->belongsTo(
            Question::class
        );
    }
}
