<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserNoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>['required','string'],
            'description'=>['required','string'],
            'emoji'=>['required','string'],
            'photo' => [
                'nullable',
                'mimes:jpg,jpeg,png',
                'max:1024'
            ],
        ];
    }
}
