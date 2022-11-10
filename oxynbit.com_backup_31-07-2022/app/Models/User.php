<?php

namespace App\Models;

use App\Models\Api;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'password',
        'btc_wallet_id',
        'btc_wallet_id_hash',
        'ltc_wallet_id',
        'ltc_wallet_id_hash',
        'eth_wallet_id',
        'eth_address',
        'btc_address',
        'ltc_address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

//    public function getPayment($currency){
//        if ($currency == 'btc') {
//            $wallet_id = $this->btc_wallet_id;
//            $wallet_id_hash = $this->btc_wallet_id_hash;
//        } else if ($currency == 'ltc') {
//            $wallet_id = $this->ltc_wallet_id;
//            $wallet_id_hash = $this->ltc_wallet_id_hash;
//        } else {
//            echo 'ETH is not supported yet.';
//            exit;
//        }
//        $params = array("wallet_id"=> $wallet_id, "confirmations" => 2);
//
//        $curl = curl_init();
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => "https://api.bitaps.com/".$currency."/v1/create/wallet/payment/address",
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_CUSTOMREQUEST => "POST",
//            CURLOPT_POSTFIELDS => json_encode($params)
//        ));
//
//        $response = curl_exec($curl);
//        $err = curl_error($curl);
//        curl_close($curl);
//
//        if ($err) {
//            echo "cURL Error #:" . $err;
//        } else {
//            return json_decode($response, true);
//        }
//    }

    public function getCrypto($currency)
    {
        if ($currency == 'btc') {
            $wallet_id = $this->btc_wallet_id;
            $wallet_id_hash = $this->btc_wallet_id_hash;
        } else if ($currency == 'ltc') {
            $wallet_id = $this->ltc_wallet_id;
            $wallet_id_hash = $this->ltc_wallet_id_hash;
        } else {
            echo 'ETH is not supported yet.';
            exit;
        }

            $password = "testpassword";

            if ($this->id  || $this->id == 1) {
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
                    return $balance_amount;
                }
            } else {
                return redirect('dashboard')->with('status', 'You are not an admin!');
            }
    }

    public function cryptoTomoney($crypto =['bitcoin','litecoin','ethereum',]){
        //api documentation https://www.coingecko.com/en/api/documentation



        $currency =[
            'usd',
        ];

        $result=[];

        $url = 'https://api.coingecko.com/api/v3/simple/price?ids='.implode(",", $crypto).'&vs_currencies='.implode(",", $currency);

        $response = file_get_contents($url);
        $responseArray = json_decode($response,true);

        if (in_array('bitcoin',$crypto)) {
            $currencyCrypto = 'btc';

            $cryptoRes = $this->getCrypto($currencyCrypto);
            $result['bitcoin']= ($cryptoRes * $responseArray['bitcoin']['usd']);
        }

        if (in_array('litecoin',$crypto)) {
            $currencyCrypto = 'ltc';
            $cryptoRes = $this->getCrypto($currencyCrypto);
            $result['litecoin']= ($cryptoRes * $responseArray['litecoin']['usd']);
        }

        //не поддерживается
        if (in_array('ethereum',$crypto)) {
//            $currencyCrypto = 'ltc';
//            $crypto = $this->getCrypto($currencyCrypto);
            $result['ethereum']=  (0);
        }

        return $result;
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            if (!$user->roles()->get()->contains(2)) {
                $user->roles()->attach(2);
            }
        });
    }

    public function transactions(){
        return (new Api)->get_user_transactions_all($this);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function invitedUsers()
    {
        return $this->belongsToMany(User::class,'users_invited_user','user_id','invited_user_id');
    }

    public function hasRoles($roles){
        return count(array_intersect($roles,$this->roles->pluck('title')->toArray()));
    }

}
