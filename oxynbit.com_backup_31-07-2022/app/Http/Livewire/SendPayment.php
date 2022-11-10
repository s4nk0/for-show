<?php

namespace App\Http\Livewire;


use App\Model\Transaction;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendPayment extends ModalComponent
{
    public string $address_from;
    public string $out_currency;
    
    public function mount(string $currency)
    {
        if ($currency == "btc") {
            $this->out_currency = "btc";
            $this->address_from = Auth::user()->btc_wallet_id;
        } else if ($currency == "ltc") {
            $this->out_currency = "ltc";
            $this->address_from = Auth::user()->ltc_wallet_id;
        } else if ($currency == "eth") {
            $this->out_currency = "eth";
            $this->address_from = Auth::user()->eth_wallet_id;
        }
    }

    public function render()
    {
        return view('livewire.send-payment');
    }
}
