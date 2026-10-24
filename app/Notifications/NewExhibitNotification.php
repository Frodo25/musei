<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewExhibitNotification extends Notification
{
    use Queueable;

    protected $exhibit;

    public function __construct($exhibit)
    {
        $this->exhibit = $exhibit;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'exhibit_id' => $this->exhibit->id,
            'title' => $this->exhibit->title,
            'message' => 'Добавлен новый экспонат: ' . $this->exhibit->title,
        ];
    }
}