<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WithdrawButton extends Component
{
    public $user;

    protected $listeners = [
    'refresh-withdraw-button' => '$refresh',
    ];

    public function mount(){
        $this->user = Auth::user();
    }

    public function render()
    {
        $user = $this->user;
        return view('livewire.withdraw-button',compact('user'));
    }
}
