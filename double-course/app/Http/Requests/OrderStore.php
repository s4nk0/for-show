<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStore extends FormRequest
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
            'loading_country_id'=>'required|numeric',
            'loading_settlement_id'=>'required|numeric',
            'loading_place'=>'required',
            'loading_date'=>'required|date_format:Y-m-d H:i:s',
            'unloading_country_id'=>'required|numeric',
            'unloading_settlement_id'=>'required|numeric',
            'unloading_place'=>'required',
            'unloading_date'=>'required|date_format:Y-m-d H:i:s',
            'cargos_type_id'=>'required|numeric',
            'packaging_type_id'=>'required|numeric',
            'length'=>'required|numeric',
            'width'=>'required|numeric',
            'height'=>'required|numeric',
            'cargo_loading_type_id'=>'required|numeric',
            'loading_conditions'=>'required|array|min:1',
            'transport_type_id'=>'required|numeric',
            'demanded_document_types'=>'required|array|min:1',
            'loading_types'=>'required|array|min:1',
        ];
    }
}
