<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $fillable = [
        'group_chat_id',
        'user_id',
        'reply_id',
        'message',
        'is_edited'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(
            GroupMessageAttachment::class,
            'group_message_id');
    }

    public function reply()
    {
        return $this->belongsTo(GroupMessage::class, 'reply_id');
    }
}