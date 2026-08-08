<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class ContactNotification extends Notification
{

    use Queueable;



    public $contact;



    public function __construct($contact)
    {
        $this->contact = $contact;
    }



    public function via($notifiable)
    {
        return ['database'];
    }



    public function toDatabase($notifiable)
    {

        return [

            'contact_id' => $this->contact->id,

            'title' => 'New Contact Message',

            'message' => $this->contact->subject,

            'sender' => $this->contact->sender->name,


        ];
    }
}
