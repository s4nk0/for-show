<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'organization' => 'required|min:4|max:190',
            'name' => 'required|min:2|max:190',
            'position' => 'required|min:4|max:190',
            'phone' => 'required',
            'site' => 'required',
            'size_from' => 'required',
            'size_to' => 'required',
            'product_type' => 'required',
            'lifetime' => 'required',
            'factory' => 'required',
            'customer_type_id' => 'required',
            'present_type' => 'required',
            'product_class' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'organization.required' => 'Поле "Название организации" обязательно к заполнению',
            'organization.min' => 'Минимальная длина поля "Название организации" 4 символа',
            'organization.max' => 'Максимальная длина поля "Название организации" 190 символов',
            'name.required' => 'Поле "Контактное лицо" обязательно к заполнению',
            'name.min' => 'Минимальная длина поля "Контактное лицо" 2 символа',
            'name.max' => 'Максимальная длина поля "Контактное лицо" 190 символов',
            'position.required' => 'Поле "Должность" обязательно к заполнению',
            'position.min' => 'Минимальная длина поля "Должность" 4 символа',
            'position.max' => 'Максимальная длина поля "Должность" 190 символов',

            'phone.required' => 'Поле "Телефон" обязательно к заполнению',
            'site.required' => 'Поле "Сайт или Инстаграм" обязательно к заполнению',
            'size_from.required' => 'Поле "Размер необходимой площади (от)" обязательно к заполнению',
            'size_to.required' => 'Поле "Размер необходимой площади (до)" обязательно к заполнению',
            'product_type.required' => 'Поле "Наименование товара (вид товара)" обязательно к заполнению',
            'lifetime.required' => 'Поле "Срок существования на рынке" обязательно к заполнению',
            'factory.required' => 'Поле "Завод производитель товара" обязательно к заполнению',
            'customer_type_id.required' => 'Поле "Вы являетесь" обязательно к заполнению',
            'present_type.required' => 'Поле "Представлен ли данный товар в ТК «ARMADA»?" обязательно к заполнению',
            'product_class.required' => 'Поле "Классификация товара" обязательно к заполнению',
        ];
    }
}
