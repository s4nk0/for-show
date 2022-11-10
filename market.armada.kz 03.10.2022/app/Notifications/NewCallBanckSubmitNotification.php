<?php

namespace App\Notifications;

use App\Models\Callback;
use App\Notifications\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCallBanckSubmitNotification extends Notification
{
    use Queueable;

    private Callback $callback;
    private string $whatsAppNumber;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($callback, $whatsAppNumber)
    {
        $this->callback = $callback;
        $this->whatsAppNumber = $whatsAppNumber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }


    /**
     * Get the whatsapp representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toWhatsapp($notifiable)
    {

        $app_url = str_replace('https://', '', rtrim(env('APP_URL'), '/'));
        $text_auto = "Это автоматическое сообщение.\n" .
            "Пожалуйста, не отвечайте на него.\n" .
            "Номер клиента для связи вы видите в письме.";

        $callback_product = "";
        if ($this->callback->product_id != null) {
            $callback_product = "\nТовар: " . $this->callback->product->title;
            $callback_type = "Новая заявка на консультацию на сайте";
        }else{
            $callback_type = "Новый запрос на обратный звонок на сайте";
        }

        $body = $callback_type. ' ' . $app_url .
            "\n\nИмя: " . $this->callback->name .
            "\nТелефона: " . $this->callback->phone .
            $callback_product .
            "\nДата: " . $this->callback->created_at .
            "\n\n" . $text_auto;

//        $default_image = "https://armada.kz/img/logo-gray.png";
//        $img_url = env('APP_URL').'storage/' . $this->order->image;
//        if(env('APP_ENV') == 'local'){
//            $img_url = $default_image;
//        }
//        if ($this->order->getImage() == null){
//            $img_url = $default_image;
//        }
//        return [
//            'body' => $img_url,
//            'caption' => $body,
//            'filename' => $this->order->image,
//            'chatId' => $this->whatsAppNumber . '@c.us'
//        ];
        return [
            'body' => $body,
            'phone' => $this->whatsAppNumber
        ];
    }
}
