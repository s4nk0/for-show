<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\SmscRu\SmscRuChannel;
use NotificationChannels\SmscRu\SmscRuMessage;

class SmscSendCode extends Notification
{
//    use Queueable;

    public $phone_verified_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($phone_verified_id = 0)
    {
        $this->phone_verified_id = $phone_verified_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [SmscRuChannel::class];
    }


    public function toSmscRu($notifiable)
    {
        return SmscRuMessage::create("Task #{$notifiable->id} is complete!")->content('code')->call('1')->phone_verified_id($this->phone_verified_id);
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
