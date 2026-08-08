<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessageAttachment extends Model
{
    protected $table = 'group_message_attachments';
    protected $fillable = [
        'group_message_id',
        'file',
        'type'
    ];
}