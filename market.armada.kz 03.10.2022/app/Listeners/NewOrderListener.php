<?php

namespace App\Listeners;

use App\Events\NewOrderCreated;
use App\Notifications\Channels\WhatsAppChannel;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewOrderCreated  $event
     * @return void
     */
    public function handle(NewOrderCreated $event)
    {
        Notification::send(WhatsAppChannel::class,
            new NewOrderNotification($event->getOrder(),$event->getWhatsAppNumber()));
    }
}
