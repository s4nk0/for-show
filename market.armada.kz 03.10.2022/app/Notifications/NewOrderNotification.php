<?php

namespace App\Notifications;

use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use App\Notifications\Channels\WhatsAppChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    private ?Order $order;
    private string $whatsAppNumber;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $whatsAppNumber)
    {
        $this->order = $order;
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
            'phone' => '7477334496',
            'body' => 'WhatsApp API on Chat API works good',
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

        $app_url = str_replace('https://','',rtrim(env('APP_URL'),'/'));
        $text_auto = "Это автоматическое сообщение.\n" .
            "Пожалуйста, не отвечайте на него.\n" .
            "Номер клиента для связи вы видите в письме.";
        $body = "Новый заказ на сайте ". $app_url .
            "\n\nФ.И.О: " . $this->order->fio .
            "\nТелефона: " . $this->order->phone .
            "\nТовар: " . $this->order->title .
            "\nЦена: " . $this->order->price . "тг" .
            "\nКомментарий клиента: " . $this->order->comment .
            "\nЗаказ создан: " . $this->order->created_at .
            "\n\n" . $text_auto;

        $default_image = "https://armada.kz/img/logo-gray.png";
        $img_url = env('APP_URL').'storage/' . $this->order->image;
        if(env('APP_ENV') == 'local'){
            $img_url = $default_image;
        }
        if ($this->order->getImage() == null){
            $img_url = $default_image;
        }

        return [
            "template" => "order_created",
            "language" => [
                "policy" => "deterministic",
                "code" => "ru"
            ],
            "namespace"=>env('WHATSAPP_API_TEMPLATE_NAMESPACE'),
            "params" => [
                [
                    "type" => "header",
                    "parameters" => [
                        [
                            "type" => "image",
                            "image" => [
                                "link" => $img_url
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "body",
                    "parameters" => [
                        [
                            "type" => "text",
                            "text" => $app_url
                        ],
                        [
                            "type" => "text",
                            "text" => $this->order->fio
                        ],
                        [
                            "type" => "text",
                            "text" => $this->order->phone
                        ],
                        [
                            "type" => "text",
                            "text" => $this->order->title
                        ],
                        [
                            "type" => "text",
                            "text" => $this->order->price . "тг"
                        ],
                        [
                            "type" => "text",
                            "text" => $this->order->comment
                        ],
                        [
                            "type" => "text",
                            "text" => $this->order->created_at
                        ]
                    ]
                ]
            ],
            "phone" => $this->whatsAppNumber
        ];
    }
}
