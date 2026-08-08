<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupChat extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'photo',
        'created_by'
    ];

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_chat_members');
    }

    public function messages()
    {
        return $this->hasMany(GroupMessage::class);
    }
}
