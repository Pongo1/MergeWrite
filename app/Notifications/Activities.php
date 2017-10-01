<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class Activities extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($liker,$piece)
    {
        $this->liker =$liker;
        $this->piece = $piece;

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

            'liker'=>$this->liker,
            'piece'=>$this->piece,
            'coins'=>$this->piece->bank->coins
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
