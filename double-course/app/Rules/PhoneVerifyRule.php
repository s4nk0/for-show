<?php

namespace App\Rules;

use App\Models\PhoneVerify;
use Illuminate\Contracts\Validation\Rule;

class PhoneVerifyRule implements Rule
{

    public $phone;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return PhoneVerify::where('phone',$this->phone)->where('code',$value)->get()->count() == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Неверный код!';
    }
}
