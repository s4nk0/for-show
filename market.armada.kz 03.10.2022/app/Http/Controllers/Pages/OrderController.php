<?php

namespace App\Http\Controllers\Pages;

use App\Events\NewOrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Services\OrderService;
use App\Http\Services\Service;
use App\Mail\NewOrder;
use App\Models\City;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductLike;
use App\Models\Store;
use App\Models\TypeDelivery;
use App\Models\TypeDopservice;
use App\Models\TypePay;
use App\Models\User;
use App\Models\UserLoyalty;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use TypeError;

class OrderController extends Controller
{
    protected $service;
    protected OrderService $orderService;

    public function __construct(Service $service,OrderService $orderService)
    {
        $this->service = $service;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $cart_product_session =  Session::get(OrderStatus::CART_PRODUCT);
        if(!isset($cart_product_session)){
            return redirect()->route('cart')->with('error',__('messages.cart.empty_cart'));
        }
//        dd(Cache::has('ARMADA_PRODUCT_*'));
//        $ordersId = UserOrder::where('user_id',Auth::id())
//            ->pluck('product_id');
//        $products = Product::where('status',1)
//            ->where('price','!=',0)
//            ->whereIn('id',$ordersId)
//            ->with('store')->get();

        $likeIds = ProductLike::where('user_id', Auth::id())
            ->pluck('product_id');
        $likeIds = $likeIds->toArray();


        $countries = Country::isActive()
            ->select('id', 'title_ru')
            ->orderBy('title_ru')
            ->get();
        $cities = City::isActive()
            ->select('id', 'title_ru')
            ->orderBy('title_ru')
            ->get();




        $orders = collect();
        foreach ($cart_product_session as $product_session){
            $ordering_product_info = Product::select('id','title','slug','delivery_ids','pay_ids','store_id', 'discount','is_discount','is_price_none','is_price_from','price')
                ->where('id',$product_session['id'])->first();
            $product_session['product'] = $ordering_product_info;
            $orders->push($product_session);
        }





        // Todo Refactor later
        $dopServices = TypeDopservice::isActive()->get();
//        $ordersQuery = Order::where('token', csrf_token());
//        $ordersQuery = Auth::check() ? $ordersQuery->orWhere('user_id', Auth::id()) : $ordersQuery;
//        $orders = $ordersQuery->where('status_id', OrderStatus::DELIVERED)
//            ->with('product:id,title,slug,delivery_ids,pay_ids')->get();




//        $typeDeliverys = TypeDelivery::isActive();
        $typeDeliverys = TypeDelivery::isActive()->get();

        if (!$orders->isEmpty()) {
            try {
                if ($orders->pluck('product.delivery_ids')[0] != null) {
                    $typeDeliverys = TypeDelivery::isActive()->whereIn('id', $orders->pluck('product.delivery_ids')[0])->get();
                }
            } catch (TypeError $e) {
                return back()->withError('ошибка');
            }

        }



        $typePays = TypePay::isActive()->get();

        if (!$orders->isEmpty()) {
            try {
                if ($orders->pluck('product.pay_ids')[0] != null) {
                    $typePays = TypePay::isActive()->whereIn('id', $orders->pluck('product.pay_ids')[0])->get();
                }

            } catch (TypeError $e) {
                return back()->withError('ошибка');
            }

        }



        $order_store_query = $orders->pluck('store_id');

//        print_r($orders[0]['product']->store_id);
//        print_r($orders->pluck('product.delivery_ids')[0]);
//        dd($orders);

        $stores = $orders->pluck('product.store_id');
        if (!$orders->isEmpty()) {
            try {
                if ($orders->pluck('store_id')[0] != null) {
                    $stores = Store::whereIn('id', $orders->pluck('product.store_id'))->select('id', 'slug', 'title', 'pay_id', 'delivery_id', 'dopservice_id')->get();

                }
            } catch (TypeError $e) {
                return back()->withError($e->getMessage());
            }
        }



        $loyalties = [];
        if (Auth::check()) {
            $storeIds = UserLoyalty::where('user_id', Auth::id())->whereIn('store_id', $stores->pluck('id'))->pluck('store_id');

            if ($storeIds != null and $storeIds->count() > 0) {
                foreach ($storeIds as $storeId) {
                    $sum = UserLoyalty::where('user_id', Auth::id())->where('store_id', $storeId)->sum('amt');
                    $loyalties[$storeId] = round($sum, 2);
                }
            }
        }
        return view('pages.orders.index', compact('likeIds', 'countries', 'cities', 'typeDeliverys', 'typePays', 'dopServices', 'orders', 'stores', 'loyalties'));
    }

//    public function orderPost(Request $request)
//    {
//        $data = '$request->products';
//        return response(123);
//    }

    public function create()
    {
        //
    }

    public function orderСonfirm(Request $request)
    {

        if ($request->has('vip') and $request->vip == "on" and Auth::user()->vip == 0) {
            $user = Auth::user();
            $user->vip = User::VIP_SILVER;
            $user->save();
        }
        if ($request->has('orders')) {
            $orders = json_decode($request->orders);

            $order_id = uniqid();
            $order = null;


            foreach ($orders as $orderData) {
                $data = collect($orderData);
                // orderStatus => COMPLETED is equal to PROCESSING for future updates
                $order = Order::firstOrNew(['user_id' => Auth::id(), 'status_id' => OrderStatus::PROCESSING, 'product_id' => $data['id']]);//'token_stat'=>$data['token'],
//                print_r($orderData);

                $order->edit(collect($data)->all());
                $order->order_id = $order_id;
                $product = Product::where('id',$data['id'])->select('id','price','is_discount', 'discount')->first();
                $order->price_2 =  $product->is_discount ? $product->price*(1-$product->discount/100) : null;
//                $order->token_stat = $data['token'];///
                $pay_result[] = isset($data['pay_result']) ? $data['pay_result'] : null;
                $order->status_id = (is_array($pay_result) and array_filter($pay_result) != null)
                    ? OrderStatus::PAID
                    : OrderStatus::EXPECT;
                $order->pay_result = $pay_result;
//                $order->is_callback = $request->has('is_callback')
//                if($data['dop_services_id'] != null)
//                {
//                    $order->dop_services_id = implode(',',$data['dop_services_id']);
//                }
                $order->user_id = Auth::check() ? Auth::id() : $order->getOriginal('user_id');
                $order->created_at = now();
                $order->save();
                $cart_product_session = Session::get(OrderStatus::CART_PRODUCT);
                for ($i = 0; $i < count($cart_product_session); $i++){
                    if($cart_product_session[$i]['id'] == $order->product_id && $cart_product_session[$i]['userId'] == $order->user_id){
                        unset($cart_product_session[$i]);
                    }
                }

                Session::put(OrderStatus::CART_PRODUCT,array_values($cart_product_session));

                if (Auth::check() and Auth::user()->vip != 0) {
                    if (Auth::user()->vip == User::VIP_SILVER) {
                        $discount = 3;
                        $addMonth = 12;
                    } elseif (Auth::user()->vip == User::VIP_GOLD) {
                        $discount = 5;
                        $addMonth = 18;
                    } elseif (Auth::user()->vip == User::VIP_PLATINUM) {
                        $discount = 8;
                        $addMonth = 120;
                    } else {
                        $discount = 0;
                        $addMonth = 0;
                    }
                    $loyalty = UserLoyalty::add([], false);
                    $loyalty->user_id = Auth::id();
                    $loyalty->type = UserLoyalty::INCOME;
                    $loyalty->order_id = $order->id;
                    $loyalty->store_id = $order->store_id;
                    $loyalty->discount = round($discount, 2);
                    $loyalty->amt = round($order->price * $discount / 100, 2);
                    $loyalty->data_end = now()->addMonth($addMonth);
                    $loyalty->save();
                }
                if (isset($order) and $order != null) {

                    $product = Product::find($order->product_id);
                    $store = $product != null ? Store::find($product->store_id) : null;
                    $user = $store != null ? User::find($store->user_id) : null;


                    if ($user != null and $user->email != null) {
                        try {
//                            Mail::to($user->email)->send(new NewOrder($order, $orders, $user, $store));
                        }catch (Exception $exception){
                            Order::where('order_id',$order->order_id)->delete();
                            return "Email failed to send";
                        }

                    }

                    if ( $store->whatsapp != null) {
                        event(new NewOrderCreated($order,$store->whatsapp));
                    }

                }


                // trash code

                $order = null;

            }
        }

        $data = [
            'answer' => 'success',
            'message' => __('messages.order.success')
        ];
        return response($data);
    }

    public function orderPost(Request $request)
    {
        if ($request->has('deleteAll') and $request->deleteAll === 'true') {
            Session::forget(OrderStatus::CART_PRODUCT);
        } elseif ($request->has('orders')) {
//            $uniqid = uniqid();//$uuid = Str::uuid();
//            $oldProductIds = Order::where('user_id', Auth::id())->pluck('product_id');
//            $diff = $oldProductIds->diff(collect($orders)->pluck('id'));
//            $this->diff_orders($diff);
            $orders = $request->orders;//json_decode();
            Session::put(OrderStatus::CART_PRODUCT, $orders);

        }elseif ($request->has('deleting_orders')){

            $session_cart = Session::get(OrderStatus::CART_PRODUCT);
            if($request->deleting_orders[0] == "on"){
                Session::forget(OrderStatus::CART_PRODUCT);
                return response('success');
            }
            $request_delete = $request->deleting_orders;
            for ($i = 0; $i < count($session_cart); $i++) {
                foreach ($request_delete as $reqItem){
                    if($session_cart[$i]['id'] == $reqItem){
                        unset($session_cart[$i]);
                        $session_cart = array_values($session_cart);
                    }
                }
            }
            Session::put(OrderStatus::CART_PRODUCT, $session_cart);
        }
        return response('success');
    }

    public function store(Request $request)
    {
        dd($request);
        if ($request->has('products')) {
            $uniqid = uniqid();//$uuid = Str::uuid();
            $products = json_decode($request->products);
            $token = $request->_token;//$products[0]->token
            $oldProductIds = Order::where('token', $token)->pluck('product_id');
            $diff = $oldProductIds->diff(collect($products)->pluck('id'));

            if ($diff != null and $diff->count() > 0) {
                foreach ($diff as $orderDel) {
                    $order = Order::where('token', $token)->where('product_id', $orderDel)->first();
                    $order->delete();
                }
            }

            foreach ($products as $product) {
                $order = Order::firstOrNew(['token' => $token, 'product_id' => $product->id]);
                $order->edit(collect($product)->all());
                $order->status_id = OrderStatus::DELIVERED;
                $order->order_id = $uniqid;//$uuid;
                $order->token = $token;
                $order->user_id = Auth::check() ? Auth::id() : null;
                $order->product_id = $product->id;
//                $order->title = $product->title;
//                $order->product_slug = $product->slug;
//                $order->image = $product->image;
//                $order->articul = $product->articul;
//                $order->price = $product->price;
//                $order->price_2 = $product->price_2;
                $order->count = $product->count;
                $order->store_title = $product->store_title;
                $order->store_id = $product->store_id;
                $order->save();
            }
        }

        return redirect()->route('orders');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    //
    public function diff_orders($diff)
    {
        if ($diff != null and $diff->count() > 0) {
            foreach ($diff as $orderDel) {
                $order = Order::where('user_id', Auth::id())->where('status_id', OrderStatus::DELIVERED)->where('product_id', $orderDel)->first();
                if ($order != null) {
                    $order->delete();
                }
            }
        }
    }
}
