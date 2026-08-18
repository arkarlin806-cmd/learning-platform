<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class LearnerBannedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $reason = 'Your account has been banned by the administrator.'
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Account Banned',
            'message' => $this->reason,
            'type' => 'account_banned',
            'icon' => 'ban',
        ];
    }
}
