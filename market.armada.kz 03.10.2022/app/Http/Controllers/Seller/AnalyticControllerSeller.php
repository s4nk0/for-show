<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Presence;
use App\Models\Product;
use App\Models\Store;
use App\Models\UserInfo;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyticControllerSeller extends Controller
{
    public function index()
    {
        $storeIds = Store::where('user_id',Auth::id())->pluck('id');
        $productActiveCount = Product::whereIn('store_id',$storeIds)->isActive(1)->count();
        $productNotActiveCount = Product::whereIn('store_id',$storeIds)
            ->where('presence_id',4)
            ->count();

        $allSalesCount = Order::whereIn('store_id',$storeIds)
            ->where('status_id',[OrderStatus::PROCESSING])
            ->count();
        $allOrdersActiveCount = Order::whereIn('store_id',$storeIds)
            ->where('status_id',[OrderStatus::EXPECT])
            ->count();
        $salesCount = Order::whereIn('store_id',$storeIds)
            ->where('status_id',[OrderStatus::PROCESSING])
            ->count();

        if(isset($_GET['start']))
        {
            $arrStart = explode('.',$_GET['start']);
            $start = $arrStart[2].'.'.$arrStart[0].'.'.$arrStart[1].' 00:00:00';
            $dataStart = '20'.$arrStart[2].'-'.$arrStart[0].'-'.$arrStart[1];
        }
        else
        {
            $start = now()->addMonth(-1);
            $dataStart = $start->format('Y-m-d');
        }
        if(isset($_GET['end']))
        {
            $arrEnd = explode('.',$_GET['end']);
            $end = $arrEnd[2].'.'.$arrEnd[0].'.'.$arrEnd[1].' 00:00:00';
            $dataEnd = '20'.$arrEnd[2].'-'.$arrEnd[0].'-'.$arrEnd[1];
        }
        else
        {
            $end = now()->addDay(1);
            $dataEnd = $end->format('Y-m-d');
        }

        $salesCanceledCount = Order::whereIn('store_id',$storeIds)
            ->whereBetween('updated_at',[$start,$end])
            ->where('status_id',[OrderStatus::CONFIRMED])
            ->count();

        $allCount = ($salesCount + $salesCanceledCount) > 0 ? ($salesCount + $salesCanceledCount) : 1;
        $percent = $salesCount/$allCount*100;

        $oderUserIds = Order::whereIn('store_id',$storeIds)
            ->whereBetween('updated_at',[$start,$end])
            ->where('user_id','!=',null)
            ->pluck('user_id');

        $users = UserInfo::whereIn('user_id',$oderUserIds)
            ->with('city')
            ->get();

        $period = new DatePeriod(
            new DateTime($dataStart),
            new DateInterval('P1D'),
            new DateTime($dataEnd)
        );

        foreach ($period as $key => $value) {
            $labels[] = $value->format('d.m.y');
            $ordersCount[] = Order::whereIn('store_id',$storeIds)
                ->where('status_id',OrderStatus::PROCESSING)
                ->whereDate('created_at',$value)->count();
        }

        return view('sellers.analytics.index',compact('productActiveCount','productNotActiveCount','allSalesCount','salesCount','allOrdersActiveCount',
            'salesCanceledCount','percent','users','labels','ordersCount'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
