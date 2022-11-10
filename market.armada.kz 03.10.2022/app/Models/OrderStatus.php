<?php

namespace App\Models;

use App\Traits\AddEdit;
use App\Traits\Scopes;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use AddEdit;
    use Scopes;

    protected $table = 'order_statuses';

    protected $fillable = [
        'slug','title_ru','title_kz','title_en',
    ];

    const PROCESSING = 1; // Заказ в обработке
    const CONFIRMED = 2; // Заказ подтвержден
    const EXPECT = 3; // Ожидаем оплаты
    const SHIPPED = 4; // На доставке
    const DELIVERED = 5; // Доставлен
    const PAID = 6; // Оплачен
    const CART_PRODUCT = 'cart_orders';

//Заказ в обработке - Processing -hot
//Заказ подтвержден - confirmed -active
//Ожидаем оплаты - Awaiting payment -five
//На доставке - Shipped -five
//Доставлен - Delivered -active
//Оплачен - Paid -hot

//    const PROCESSING = 1; // выполнен
//    const CONFIRMED = 2; // отменён
//    const AWAIT_PAYMENT = 3; // в ожидании
//    const SHIPPED = 4; // заморожен
//    const DELIVERED = 5; // в корзине
//    const PAID = 6; // оплачен
//    const BASKET = 7; // в корзин

//Заказ в обработке - Processing -hot
//Заказ подтвержден - confirmed -active
//Ожидаем оплаты - Awaiting payment -five
//На доставке - Shipped -five
//Доставлен - Delivered -active
//Оплачен - Paid -hot
//в корзин BASKET
}
