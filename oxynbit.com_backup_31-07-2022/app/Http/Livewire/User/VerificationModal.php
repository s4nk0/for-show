<?php

namespace App\Http\Livewire\User;

use LivewireUI\Modal\ModalComponent;

class VerificationModal extends ModalComponent
{
    protected $listeners = ['accept_verification' => 'accept'];

    public function accept(){

        setcookie("verification", 'accepted');
        $this->emit('refresh-withdrawFromBtcForm');
        $this->emit('refresh-withdraw-button');


        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.user.verification-modal');
    }
}
