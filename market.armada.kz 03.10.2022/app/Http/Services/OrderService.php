<?php

namespace App\Http\Services;

use App\Events\NewOrderCreated;
use App\Mail\NewOrder;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderService
{

    private function dateStart($period)
    {
        return Str::before($period, ' - ');
    }

    private function dateEnd($period)
    {
        return Str::after($period, ' - ');
    }

    public function filter($ordersQuery, $request)
    {
        if (isset($_GET['period'])) {
            $dataStart = Carbon::createFromFormat('d.m.Y',$this->dateStart($_GET['period']));

            $dataEnd = Carbon::createFromFormat('d.m.Y',$this->dateEnd($_GET['period']));

            $ordersQuery = $ordersQuery->where('created_at', '>', $dataStart)->where('created_at', '<', $dataEnd);
        }
        else {
            $ordersQuery = $ordersQuery->where('created_at', '>', now()->addMonth(-1));
        }

        if ($request->has('status_id')) {
            $ordersQuery = $ordersQuery->whereIn('status_id', $request->status_id);
        }
        else {
            $ordersQuery = $ordersQuery->whereIn('status_id', [OrderStatus::EXPECT,OrderStatus::PROCESSING,OrderStatus::CONFIRMED,OrderStatus::SHIPPED,OrderStatus::DELIVERED,OrderStatus::PAID]);
        }

//        if(Auth::user()->role_id == User::ADMIN){
//           if(!isset($request->start) && !isset($request->end)){
//                return $ordersQuery->where('created_at', '>', now()->addMonth(-1));
//           }
//           $date_start = Carbon::createFromFormat('d.m.Y',$request->start);
//           $date_end = Carbon::createFromFormat('d.m.Y',$request->end);
//
//           return $ordersQuery->where('created_at', '>', $date_start)->where('created_at', '<', $date_end);
//        }

//        if(!$request->has('status_id') && !$request->has('period')){
//            return $ordersQuery->where('status_id','=',OrderStatus::EXPECT)->$ordersQuery->where('created_at', '>', now()->addMonth(-1));
//        }

        return $ordersQuery;
    }


    public function notifyWhatsApp($order, $whatsAppNumber)
    {
        $text_auto = "Это автоматическое сообщение.\n" .
            "Пожалуйста, не отвечайте на него.\n" .
            "Номер клиента для связи вы видите в письме.";
        $body = "Новый заказ на сайте armada.kz:" .
            "\n\nФ.И.О: " . $order->fio .
            "\nТелефона: " . $order->phone .
            "\nТовар: " . $order->title .
            "\nЦена: " . $order->price . "тг" .
            "\nКомментарий клиента: " . $order->comment .
            "\nЗаказ создан: " . $order->created_at .
            "\n\n" . $text_auto;

        $default_image = "https://armada.kz/img/logo-gray.png";
        $img_url = env('APP_URL') . $order->image;
        if (env('APP_ENV') == 'local') {
            $img_url = $default_image;
        }
        if ($order->getImage() != null) {
            $img_url = $default_image;
        }
        $message = [
            'body' => $img_url,
            'caption' => $body,
            'filename' => $order->image,
            'chatId' => $whatsAppNumber . '@c.us'
        ];
        $instance = env('WHATSAPP_API_INSTANCE_ID');
        $token = env('WHATSAPP_API_TOKEN');
        $response = Http::post("https://eu289.chat-api.com/instance" . $instance . "/sendFile?token=" . $token, $message);
        print_r($response);

        return json_decode($response->body(), true);
    }

}
