<?php

namespace App\Mail;

use App\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusChangeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;
    protected $statusId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$statusId)
    {
        $this->order = $order;
        $this->statusId = $statusId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        switch ($this->statusId){
            case OrderStatus::PROCESSING:
                echo "qza";
        }
        return $this->markdown('emails.order-status-change');
    }
}
