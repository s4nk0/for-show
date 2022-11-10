<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Laravel\Jetstream\Jetstream;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:32','regex:/([a-z])+/','unique:users,user_name','alpha_dash'],
//            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],
            //custom messages
            [
                'user_name.regex'=> 'Your user name must be in latin lowercase letters and must not contain spaces (can contain underscore, must not start with underscore)', // custom message
            ]

        );

        //generate btc
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bitaps.com/btc/v1/create/wallet",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"callback_link\":\"https://magio-team.ru/bitaps.php\", \"password\":\"testpassword\"}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $responce = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $btcWallet = json_decode($responce);

        //generate ltc
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bitaps.com/ltc/v1/create/wallet",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"callback_link\":\"https://magio-team.ru/bitaps.php\", \"password\":\"testpassword\"}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $responce = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $ltcWallet = json_decode($responce);

        //generate eth
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bitaps.com/eth/v1/create/wallet",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"callback_link\":\"https://magio-team.ru/bitaps.php\", \"password\":\"testpassword\"}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json"
            ),
        ));

        $responce = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }

        $ethWallet = json_decode($responce);

        $currency_btc = 'btc';

        $params = array("wallet_id"=> $btcWallet->wallet_id, "confirmations" => 2);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bitaps.com/".$currency_btc."/v1/create/wallet/payment/address",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params)
        ));

        $response_btc = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $btc_address = json_decode($response_btc, true);
        }

        $currency_ltc = 'ltc';

        $params = array("wallet_id"=> $ltcWallet->wallet_id, "confirmations" => 2);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bitaps.com/".$currency_ltc."/v1/create/wallet/payment/address",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($params)
        ));

        $response_ltc = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $ltc_address = json_decode($response_ltc, true);
        }

        $user = User::create([
//            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'btc_wallet_id' => $btcWallet->wallet_id,
            'btc_wallet_id_hash' => $btcWallet->wallet_id_hash,
            'ltc_wallet_id' => $ltcWallet->wallet_id,
            'ltc_wallet_id_hash' => $ltcWallet->wallet_id_hash,
            'eth_wallet_id' => $ethWallet->wallet_id,
            'btc_address' => $btc_address['address'],
            'ltc_address' => $ltc_address['address'],
        ]);

//        если пользователя пригласили
        session_start();
        if (isset($_SESSION["invited_by"])){
            DB::table('users_invited_user')->insert(['user_id'=>$_SESSION["invited_by"],'invited_user_id'=>$user->id]);
        }

        event(new Registered($user));

        Auth::login($user);


        return redirect(RouteServiceProvider::HOME);
    }
}
