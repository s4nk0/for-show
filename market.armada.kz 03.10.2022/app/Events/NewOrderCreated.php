<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Order $order;
    private string $whatsAppNumber;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $whatsAppNumber)
    {
       $this->order = $order;
       $this->whatsAppNumber = $whatsAppNumber;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

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
