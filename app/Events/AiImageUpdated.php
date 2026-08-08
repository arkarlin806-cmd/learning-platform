<?php

namespace App\Events;

use App\Models\AiImage;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class AiImageUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $aiImage;

    public function __construct(AiImage $aiImage)
    {
        $this->aiImage = $aiImage;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('ai.' . $this->aiImage->user_id);
    }

    public function broadcastAs()
    {
        return 'ai.updated';
    }
}
