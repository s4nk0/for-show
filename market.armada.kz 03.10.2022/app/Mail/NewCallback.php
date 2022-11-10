<?php


namespace App\Mail;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCallback extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        if($this->user->role_id == User::SELLER){
            $subject = "Новая заявка на консультацию";
        }else{
            $subject = "Новый запрос на обратный звонок";
        }
        return $this->subject($subject )->view('emails.seller.NewCallback');
    }
}
