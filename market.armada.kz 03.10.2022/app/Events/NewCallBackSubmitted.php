<?php

namespace App\Events;

use App\Models\Callback;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewCallBackSubmitted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Callback $callback;
    private string $whatsAppNumber;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($callback, $whatsAppNumber)
    {
        $this->callback = $callback;
        $this->whatsAppNumber = $whatsAppNumber;
    }

    /**
     * @return Callback
     */
    public function getCallback(): Callback
    {
        return $this->callback;
    }

    /**
     * @return string
     */
    public function getWhatsAppNumber(): string
    {
        return $this->whatsAppNumber;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
