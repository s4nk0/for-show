<?php

namespace App\Rules;

use App\Models\Api;
use Illuminate\Contracts\Validation\Rule;

class BalanceBTC implements Rule
{
    public $user;
    public $currency;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($user,$currency)
    {
        $this->user = $user;
        $this->currency = $currency;
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
        //с учетом комиссии
        $network_fee = 0;
        if ($this->currency == "btc"){
            $network_fee = Api::SERVICE_FEE_BTC;
        } else if ($this->currency == "ltc"){
            $network_fee = Api::SERVICE_FEE_LTC;
        }
        //0.50000
        //0.00450
        //0.01000
        //0.01450
        //
        if ($value < $this->user->getCrypto($this->currency)){
            return $value < $this->user->getCrypto($this->currency);
        }else if ($value > $network_fee){
            return $value < $this->user->getCrypto($this->currency) + $network_fee;
        }

        return $value < $this->user->getCrypto($this->currency);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You dont have enough cryptocurrency (with network fee)';
    }
}
