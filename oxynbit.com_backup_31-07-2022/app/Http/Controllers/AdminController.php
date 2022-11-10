<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    public function index()
    {
//        abort_if(Gate::denies('adminDashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = DB::table('users')->get();
        return view('admin', ['users' => $users]);

    }


    public function dashboard(){
        abort_if(Gate::denies('adminDashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.dashboard');
    }


    public function show(Request $request)
    {
        abort_if(Gate::denies('adminDashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user_id = $request->user_id;
        $currency =  $request->currency;
        $action = $request->action;

        $user = Auth::user();

        if ($currency == 'btc') {
            //wallet_id need to be for requested user_id, not for current logedin
            $wallet_id = $user->btc_wallet_id;
            $wallet_id_hash = $user->btc_wallet_id_hash;
        } else if ($currency == 'ltc') {
            $wallet_id = $user->ltc_wallet_id;
            $wallet_id_hash = $user->ltc_wallet_id_hash;
        } else {
            echo 'ETH is not supported yet.';
            exit;
        }

        if ($action == "check") {

            $password = "testpassword";

                $nonce = round(microtime(true) * 1000);
                $key = hash("sha256", (hash("sha256", $wallet_id.$password, true)), true);
                $msg = $wallet_id_hash.$nonce;
                $signature = hash_hmac("sha256", $msg, $key);

                $url = "https://api.bitaps.com/".$currency."/v1/wallet/state/".$wallet_id_hash;

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array("Access-Nonce: ".$nonce, "Access-Signature: ".$signature),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $satoshi = json_decode($response, true)["balance_amount"];
                    $balance_amount = number_format($satoshi*0.00000001, 8,'.',' ');
                    echo "Баланс пользователя: ".$balance_amount." ".$currency;
                }

        } else if ($action == "get") {
            $params = array("wallet_id"=> $wallet_id, "confirmations" => 2);

            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.bitaps.com/".$currency."/v1/create/wallet/payment/address",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => json_encode($params)
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              echo "Send this address to get payment: ".json_decode($response, true)["address"];
              exit;
            }
        } else if ($action == "send") {
            echo "Send payment function is not available right now. Comeback later.";
            exit;
        }
    }


}
