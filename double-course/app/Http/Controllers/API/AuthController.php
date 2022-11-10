<?php

namespace App\Http\Controllers\API;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\OTPverifyCodeRequest;
use App\Models\PhoneVerify;
use App\Models\User;
use App\Notifications\SmscSendCode;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller{

    public function OTPSendCode(Request $request){
        $phone_verify = PhoneVerify::create([
            'phone' => $request->phone,
            ]
        );
        $phone_verify->save();

        //start  для очистки базы данных от мусоров
        $thisUserPhoneVerifyError = PhoneVerify::where('phone',$phone_verify->phone)->where('id','!=',$phone_verify->id);
        $thisUserPhoneVerifyError->delete();
        //end  для очистки базы данных от мусоров

        $phone_verify->notify(new SmscSendCode($phone_verify->id));

        //пока smsc не подключен
        $phone_code = PhoneVerify::find($phone_verify->id)->code;

        return response()->json([
            'success'=>true,
            'data'=>[
                'code'=>$phone_code,
            ],
            'message'=>'Код отрпавлен!',
        ]);
        //пока smsc не подключен

//        когда smsc подключен
//        return response('Код отрпавлен!', 200);
        //        когда smsc подключен
    }

    public function OTPVerifyCode(OTPverifyCodeRequest $request){
        //для сокращения повторение кода
        $user = User::where('phone',$request->phone)->first();

        if (!$user){
            if(!$request->name){
                return 'Пользователь не найден пожалуйста зарегистрируйтесь';
            }
            //если это новый юзер
            $email = 'email-'.$this->getLastUserId()+1;
            $user =  User::create([
                'phone' => $request->phone,
                'name' => $request->name,
                'email' => $email,
            ]);
            if ($request['invite_code']){
                User::where('code',$request['invite_code'])->first()->invited_users()->save($user);
            }
            $user->roles()->attach(2);
        }
        return $this->login($user);
    }

    private function login($user){
        Auth::login($user);

        // Authentication passed...
        return response()->json([
            'success'=>true,
            'data'=>[
                'token'=>Auth::user()->createToken(Auth::user()->phone)->plainTextToken,
                'user'=>Auth::user(),
            ],
            'message'=>'User logged in',
        ]);
    }

    private function getLastUserId(){
        $user = User::latest()->first();
        if (!$user){
            return 0;
        }
        return $user->id;
    }
}
