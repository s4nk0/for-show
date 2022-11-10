<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();;
    }

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
            'description'     => [
                'string',
            ],
            'city_id'     => [
                'numeric',
                'required',
            ],
            'photo' => [
                'nullable',
                'mimes:jpg,jpeg,png',
                'max:1024'
            ],
        ];
    }
}
