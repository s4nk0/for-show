<?php

namespace App\Notifications\Channels;

use App\Models\WhatsAppNotify;
use App\Notifications\NewOrderNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class WhatsAppChannel
{
    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toWhatsapp($notifiable);

        $whatsAppNotify = new WhatsAppNotify();

        $response = $whatsAppNotify->sendMessage($message);

        return json_decode($response->body(), true);
    }

}
