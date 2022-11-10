<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMails extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $card;
    public $recommended;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($card,$recommended,$user)
    {
        $this->card = $card;
        $this->recommended = $recommended;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("🔔Мы сохранили товары, которые вы просматривали")->markdown('testMail');
    }
}
