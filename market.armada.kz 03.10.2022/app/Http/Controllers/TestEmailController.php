<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMails;

class TestEmailController extends Controller
{
    public function sendEmailsCart(){
        //user have cart and not sended for emails
        $users_id =DB::table("user_cart")->where("status",0)->select("user_id")->distinct()->get()->pluck("user_id")->toArray();

        //check for email
        $users = User::whereIn("id",$users_id)->where('email','like','%@%')->get();

        foreach ($users as $user){
            $checker = DB::table('user_cart')->where('user_id',$user->id)->orderBy('updated_at','ASC')->first();
            if (Carbon::now()->diff(Carbon::parse($checker->updated_at) )->format('%d') >= 1){


                $cards = [];
            $cards_category=[];
            foreach ($user->cartProducts as $card){
                array_push($cards,$card);
                array_push($cards_category,$card->subcatalog_id);
            }
            //check for last update

            $recommended = Product::whereIn("subcatalog_id",array_unique($cards_category))->distinct('title')->paginate(2);
            Mail::to($user)->queue(new TestMails($cards,$recommended,$user));
            DB::table("user_cart")->where("user_id",$user->id)->update(["status"=>1]);
            }



        }


    }

    public function refreshCart(Request $request){
        if (Auth::check()){
            $product_ids = [];
            foreach ($request->carts as $cart){
                array_push($product_ids,["product_id"=>$cart['id'],"count"=>$cart['count'],"status"=>0]);
            }

            Auth::user()->cartProducts()->sync($product_ids);
        }

        return $request;
    }
}
