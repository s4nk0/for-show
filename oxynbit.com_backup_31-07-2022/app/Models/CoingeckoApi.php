<?php
namespace App\Models;

class CoingeckoApi {
    public function getCryptoInfo($currency,$crypto){

        $url = "https://api.coingecko.com/api/v3/coins/markets?vs_currency=".implode(",", $currency)."&ids=".implode(",", $crypto)."&order=market_cap_desc&per_page=100&page=1&sparkline=false";

        $response = file_get_contents($url);
        $responseArray = json_decode($response,true);

        return $responseArray;
    }
}
