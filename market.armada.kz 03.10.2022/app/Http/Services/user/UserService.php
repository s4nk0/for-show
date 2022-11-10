<?php

namespace App\Http\Services\user;

use Illuminate\Support\Facades\Auth;

class UserService
{
    public function phones($request)
    {
        $phones = [];
        foreach (['phone','phones'] as $name)
        {
            $phones = array_merge($phones, $this->intoArray($request,$name));
        }
        $phones = array_filter($phones);
        return $phones;
    }

    //для проверки с firebase
    public function getFirstPhone($value){

        $resFormat = str_replace(" ", '', $value);
        $resFormat = str_replace("-", '', $resFormat);
        $resFormat = str_replace(")", '', $resFormat);
        $resFormat = str_replace("(", '', $resFormat);

        return $resFormat;
    }

    public function intoArray($request,$names)
    {
        $datas = [];
        if($request->has($names))
        {
            foreach ((array) $request->$names as $name)
            {
                $datas[] = $name;
            }
        }

        return $datas;
    }

    public function infoUpdate($request){
        $data = Auth::user();
        $data->edit($request->all());
        
        if($request->has('images') and array_filter($request->images) != null)
        {
            $data->uploadDataImages($request->images,'avatar');
        }
        foreach (['phones','additional_phone','additional_phone_additional','additional_phone_comment','additional_social','additional_social_value'] as $name)
        {
            $data->$name = $this->intoArray($request,$name);
        }

        if($request->has('email') and $request->email != Auth::user()->email)
        {
            $data->email = $request->email;
            // сделать отправку письма
        }
        $data->save();
    }
}
