<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\TypeDelivery;
use App\Models\TypePay;
use Illuminate\Http\Request;

class OrderControllerAdmin extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $ordersQuery = Order::with('store','product','product.item','product.item.subcatalog','product.item.subcatalog.catalog','orderStatus','country','city','userInfo');
        $this->orderService->filter($ordersQuery,$request);

        $orders = $ordersQuery->latest()->get();
        $statuses = OrderStatus::select('id','title_ru')->get();

        return view('admin.orders.index',compact('orders','statuses','request'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Order::find($id);
        $product = Product::with('store')->find($data->product_id);

        if(!isset($product)){
            return redirect()->back()->with('error','Продукт не существует!!!');
        }
        $cities = City::isActive()->get();
        $deliveryTypes = TypeDelivery::isActive()->select('id','title')->get();
        $payTypes = TypePay::isActive()->select('id','title')->get();
        $statuses = OrderStatus::select('id','title_ru')->get();
        $statuses_options = array();
        foreach ($statuses as $status){
            $statuses_options[$status->id] = $status->title_ru;
        }


        return view('admin.orders.credit',compact('data','product','cities','deliveryTypes','payTypes','statuses','statuses_options'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());
        $order->save();
        return back()->with('success','Информация изменена');
    }

    public function destroy($id)
    {
        //
    }
}
