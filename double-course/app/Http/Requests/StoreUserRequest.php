<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'last_name'     => [
                'string',
                'required',
            ],
            'phone'    => [
                'required',
                'numeric',
            ],
            'email'    => [
                'unique:users',
            ],
            'password' => [

            ],
            'description'     => [
                'string',
            ],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
                'array',
            ],
        ];
    }
}
