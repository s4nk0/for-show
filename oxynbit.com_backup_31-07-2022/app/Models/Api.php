<?php
namespace App\Models;

class Api
{
    const PASSWORD = 'testpassword';
    const SERVICE_FEE_BTC = 0.00045;
    const SERVICE_FEE_LTC = 0.0004;

    public function get_wallet_api(User $user,$query,$wallet){
        if ($wallet == 'btc') {
            $wallet_id = $user->btc_wallet_id;
            $wallet_id_hash = $user->btc_wallet_id_hash;
        } else if ($wallet == 'ltc') {
            $wallet_id = $user->ltc_wallet_id;
            $wallet_id_hash = $user->ltc_wallet_id_hash;
        } else {
            echo 'ETH is not supported yet.';
            exit;
        }

        $nonce = round(microtime(true) * 1000);
        $key = hash("sha256", (hash("sha256", $wallet_id.self::PASSWORD, true)), true);
        $msg = $wallet_id_hash.$nonce;
        $signature = hash_hmac("sha256", $msg, $key);

        $url = "https://api.bitaps.com/".$wallet."/v1/wallet/".$query."/".$wallet_id_hash;

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
            $satoshi = json_decode($response, true);
            return $satoshi;
        }

    }

    public function post_wallet_api(User $user,$query,$wallet,$params){

        if ($wallet == 'btc') {
            $wallet_id = $user->btc_wallet_id;
            $wallet_id_hash = $user->btc_wallet_id_hash;
        } else if ($wallet == 'ltc') {
            $wallet_id = $user->ltc_wallet_id;
            $wallet_id_hash = $user->ltc_wallet_id_hash;
        } else {
            echo 'ETH is not supported yet.';
            exit;
        }

        $wallet_id = $user->btc_wallet_id;
        $wallet_id_hash = $user->btc_wallet_id_hash;

        $params = json_encode($params);

        $nonce=round(microtime(true) * 1000);
        $key = hash("sha256",(hash("sha256",$wallet_id.self::PASSWORD,true)),true);
        $msg = $wallet_id_hash.$params.$nonce;
        $signature = hash_hmac("sha256",$msg,$key);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bitaps.com/".$wallet."/v1/wallet/".$query."/".$wallet_id_hash,
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
//            if you need, you can write in db something like tx_hash or other things
            dd($response);

        }

    }

    public function post_send_payment_btc(User $user,$amount,$address){
        $amount_res = (floatval($amount) - self::SERVICE_FEE_BTC)/0.00000001;
        $params = array("receivers_list"=> array(array("address" => $address, "amount" =>  $amount_res)));

        return $this->post_wallet_api($user,"send/payment","btc",$params);
    }

    public function post_send_payment_ltc(User $user,$amount,$address){
        $amount = ($amount - self::SERVICE_FEE_LTC)/0.00000001;
        $params = array("receivers_list"=> array(array("address" => $address, "amount" =>  $amount)));

        return $this->post_wallet_api($user,"send/payment","ltc",$params);
    }

    public function get_user_transactions_btc(User $user){
        $btc_wallet = $this->get_wallet_api($user,'transactions','btc')['transactions']['tx_list'];
        return $this->get_wallet_api($user,'transactions','btc')['transactions']['tx_list'];
    }
    public function get_user_transactions_ltc(\App\Models\User $user){
        return $this->get_wallet_api($user,'transactions','ltc')['transactions']['tx_list'];
    }

    public function get_user_transactions_all(User $user){
        //get all wallet transactions
        $result = [];

        if (count($this->get_user_transactions_btc($user))>0 )
        {
            foreach ($this->get_user_transactions_btc($user) as $btc_transactions){
                $btc_transactions['currency'] = 'btc';
                array_push($result,$btc_transactions);
            }
        }

        if (count($this->get_user_transactions_ltc($user))>0 )
        {
            foreach ($this->get_user_transactions_ltc($user) as $ltc_transactions){
                $ltc_transactions['currency'] = 'ltc';
                array_push($result,$ltc_transactions);
            }
        }

        if (count($this->get_user_transactions_ltc($user))>0 || count($this->get_user_transactions_btc($user))>0 ) {
            //sorting
            foreach ($result as $key => $node) {
                $timestamps[$key] = $node['timestamp'];
            }

        array_multisort($timestamps, SORT_ASC, $result);
        }
        return $result;
    }

}
