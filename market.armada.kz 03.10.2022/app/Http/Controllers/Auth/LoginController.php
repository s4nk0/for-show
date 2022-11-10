<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Service;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Services\user\UserService;
use App\Models\FirebaseModel;
use App\Rules\VerifyPhone;
use Kreait\Laravel\Firebase\Facades\Firebase;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    protected $service;
    protected $userService;

    public function __construct(Service $service,UserService $userService)
    {
        $this->service = $service;
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    public function showLoginForm()
    {
        $redirect_cart = url()->previous() == route('cart');

//        $likesCount = $this->service->likesCount();
//        $userBasket = $this->service->userBasket();
        return view('auth.login',['from_cart'=>$redirect_cart]);
    }

    public function loginOTP(Request $request)
    {

        $this->validate($request, [
            'user_firebase' => ['required', new VerifyPhone],
        ]);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request))
        {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $authenticate = Auth::attempt(
            $request->only(['phones'])
        );

        if($authenticate || User::where('contact_phone',$request->user_firebase["phone"])->first()) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            $user = User::where('contact_phone',$request->user_firebase["phone"])->first();

            if ($user->isActive != true) {
                Auth::logout();
                return redirect()->route('home')->with('error', 'Доступ запрещён');
            }

            $user->ip_address = $request->server('HTTP_X_FORWARDED_FOR');
            $user->seller_device_info = $request->server('HTTP_USER_AGENT');
            $user->last_login_date = now();
            $user->save();

            Auth::Login($user,true);
        }else{
            $user = new User;
            $user->contact_phone = $request->user_firebase["phone"];
            $user->phones = [$request->user_firebase["phone"]];
            $user->email = 'armada-mail'.(User::orderBy('id', 'desc')->first()->id+1);
            $user->save();

            Auth::Login($user,true);
        }



        $this->incrementLoginAttempts($request);

//        throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);

        return $this->sendFailedLoginResponse($request);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request))
        {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $authenticate = Auth::attempt(
            $request->only(['email','password']),
            $request->filled('remember')
        );

        if($authenticate)
        {

//            dd($_SERVER['HTTP_USER_AGENT'],$request->server('HTTP_USER_AGENT'),$_SERVER['HTTP_X_FORWARDED_FOR'],$request->server('HTTP_X_FORWARDED_FOR'));
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            $user = Auth::user();

            if($user->isActive != true)
            {
                Auth::logout();
                return redirect()->route('home')->with('error','Доступ запрещён');
            }

            $user->ip_address = $request->server('HTTP_X_FORWARDED_FOR');
            $user->seller_device_info = $request->server('HTTP_USER_AGENT');
            $user->last_login_date = now();
            $user->save();

            if($request->from_cart){
                return redirect()->route('orders');
            }
            if($user->role_id == User::ADMIN)
            {
                return redirect()->route('admin.home');
            }
            if($user->role_id == User::SELLER)
            {
                return redirect()->route('seller.home');
            }

            if($user->role_id == UserRole::DESIGNER)
            {
                return redirect()->route('designer.home');
            }

//            if($user->is_verified !== User::EMAIL_CONFIRMED)
//            {
//                Auth::logout();
//                return back()->with('error','You need to confirm your accaunt. Please check your email.');
//            }


            if($request->route == 'home')
            {
                return redirect()->intended(route('home'));
            }
            else
            {
                return redirect()->intended(url()->previous());
            }
        }

        $this->incrementLoginAttempts($request);

//        throw ValidationException::withMessages(['email' => [trans('auth.failed')]]);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function handleProviderGoogleCallback(){
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in

            $existingUser->last_login_date = now();
            $existingUser->save();
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $full_name = explode(" ", $user->name);
            $newUser->name            = $full_name[0];
            $newUser->sname            = $full_name[1];
            $newUser->email           = $user->email;
//                $user = User::add($request->only('email','name','sname'));
            $user->role_id = UserRole::USER;
            $user->verify_token = Str::random(40);
//                $user->ip_address = $request->server('HTTP_X_FORWARDED_FOR');
//                $user->seller_device_info = $request->server('HTTP_USER_AGENT');
            $user->last_login_date = now();
            $newUser->save();

            auth()->login($newUser, true);
        }
        return redirect()->to('/user');
    }

    public function handleProviderFacebookCallback(){
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }


        // check if they're an existing user
        $existingUser = User::where('facebook_id', $user->id)->first();

        try {
            if($existingUser){
                // log them in

                $existingUser->last_login_date = now();
                $existingUser->save();
                auth()->login($existingUser, true);
            } else {
                // create a new user
                $newUser                  = new User;
                $full_name = explode(" ", $user->name);
                $newUser->name            = $full_name[0];
                $newUser->facebook_id            = $user->id;
                $newUser->sname            = $full_name[1];
                if($newUser->email != null){
                    $newUser->email           = $user->email;
                }else{
                    $newUser->email           = $user->id . '@.facebook.email';
                }

//                $user = User::add($request->only('email','name','sname'));
                $user->role_id = UserRole::USER;
                $user->verify_token = Str::random(40);
//                $user->ip_address = $request->server('HTTP_X_FORWARDED_FOR');
//                $user->seller_device_info = $request->server('HTTP_USER_AGENT');
                $user->last_login_date = now();
                $newUser->save();

                auth()->login($newUser, true);
            }
        }catch (\Exception $e){
            dd($e);
        }

        return redirect()->to('/user');
    }


    //
//    public function redirectToProvider($service)
//    {
//        return Socialite::driver($service)->redirect();
//    }
//
//    public function handleProviderCallback($service)
//    {
//        $user = Socialite::driver($service)->user();
////dd($user);
//        // $user->token;
//        $user = User::firstOrCreate(
//            ['email'=>$user->getEmail()],
//            ['provider_id'=>$user->getId(),]
//        );
//
//        Auth::Login($user,true);
//
//        return redirect()->route('home');
//    }
}
