<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AmbassadorNotifications extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $notification;
    public $route;
    public function __construct($notification,$route)
    {
        $this->notification=$notification;
        $this->route=$route;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'msg' => $this->notification,
            'from'=>auth()->user()->id,
            'url'=>$this->route
        ];
    }
    public function toArray($notifiable)
    {
        return [
            'msg' => $this->notification,
            'from'=>auth()->user()->id,
            'url'=>$this->route
        ];
    }
}
