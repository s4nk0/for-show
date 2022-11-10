<?php

namespace App\Http\Livewire\User;

use App\Models\Api;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use App\Rules\BalanceBTC;
use Symfony\Component\HttpFoundation\Response;

class WithdrawFromLitecoinForm extends Component
{
    public $user;
    public $address;
    public $amount;
    public $disabled_btn;

    protected function rules()
    {
        return [
            'address' => 'required',
            'amount' => ['required','max:999999999999999999',new BalanceBTC($this->user,"ltc")],
//            'amount' => ['required','max:999999999999999999',new BalanceBTC($this->user,"btc")],
//            'verification' => [new Verification],
        ];
    }


    public function mount($user = null){
        $this->disabled_btn = 0;


        if ($user == null){
            $this->user = auth()->user();
        }else{
            $this->user = $user;
        }

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->disabled_btn++;
    }

    public function withdrawFromLitecoinForm()
    {
        $this->validate();
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        (new Api)->post_send_payment_ltc($this->user,$this->amount,$this->address);

        $this->emit('sent');
        $this->emit('refresh-navigation');
    }

    public function render()
    {
        $disabled_btn = $this ->disabled_btn;
        return view('livewire.user.withdraw-from-litecoin-form',compact('disabled_btn'));
    }
}
