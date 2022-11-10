<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $from = $request->from;
        $to =  $request->to;
        $amount = $request->amount;
        $currency = $request->currency;

        $user = Auth::user();
        
        $sFrom = DB::table('users')->where('btc_wallet_id', '=', $from)->orWhere('ltc_wallet_id', '=', $from)->orWhere('eth_wallet_id', '=', $from)->first();
        
        if ($user->id == $sFrom->id) {
            
            if ($currency == "btc") {
                $wallet_id = $sFrom->btc_wallet_id;
                $wallet_id_hash = $sFrom->btc_wallet_id_hash;
            } elseif ($currency == "ltc") {
                $wallet_id = $sFrom->btc_wallet_id;
                $wallet_id_hash = $sFrom->btc_wallet_id_hash;
            } elseif ($currency == "eth") {
                $message = "ETH is not supported yet";
                $status = "200";
                goto end;
            }
            $amount = $amount/0.00000001;
            $params = array("receivers_list"=> array(array("address" => $to, "amount" =>  $amount)));
            $params = json_encode($params);
            
            $nonce=round(microtime(true) * 1000);
            $key = hash("sha256",(hash("sha256",$wallet_id.$password,true)),true);
            $msg = $wallet_id_hash.$params.$nonce;
            $signature = hash_hmac("sha256",$msg,$key);

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bitaps.com/".$currency."/v1/wallet/send/payment/".$wallet_id_hash,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array("Access-Nonce: ".$nonce,"Access-Signature: ".$signature),
            CURLOPT_POSTFIELDS => $params
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                print_r ($err);
            } else {
                //if you need, you can write in db something like tx_hash or other things
                // json_decode($response, true);
            }
            $message = "Transaction was successfully sended!";
            $status = "200";
        } else {
            $message = "Something went wrong, please reaload the page and try again.";
            $status = "500";
        }
        end:
        $callback = json_encode(['message' => $message, 'status' => $status]);
        echo $callback;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
