<?php

namespace App\Http\Requests;

use App\Models\PhoneVerify;
use App\Rules\InviteCodeExist;
use App\Rules\PhoneVerifyRule;
use Illuminate\Foundation\Http\FormRequest;

class OTPverifyCodeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone'=>'required|numeric|max:99999999999',
            'name'=>'string|max:255',
            'code'=>['required','numeric','max:999999',new PhoneVerifyRule($this->phone)],
            'invite_code'=>['numeric','max:999999',new InviteCodeExist()],
        ];
    }
}
