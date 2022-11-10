<?php

namespace App\Listeners;

use App\Events\NewCallBackSubmitted;
use App\Notifications\Channels\WhatsAppChannel;
use App\Notifications\NewCallBanckSubmitNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewCallBackSubmitListener
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
     * @param NewCallBackSubmitted $event
     * @return void
     */
    public function handle(NewCallBackSubmitted $event)
    {
        Notification::send(WhatsAppChannel::class,
            new NewCallBanckSubmitNotification($event->getCallback(), $event->getWhatsAppNumber())
        );
    }
}
