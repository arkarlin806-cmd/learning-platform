<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LearnerWarningNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $reason
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Warning',
            'message' => $this->reason,
            'type' => 'account_warning',
            'icon' => 'warning',
        ];
    }
}
