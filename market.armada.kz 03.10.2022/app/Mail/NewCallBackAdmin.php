<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCallBackAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $callback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Новый запрос на обратный звонок(продвижение маркетплейса)")
            ->view('emails.admin.newCallbackAdmin')->with(['callback'=>$this->callback]);
    }
}
