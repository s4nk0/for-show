<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class Name extends Component
{
    protected $listeners = [
        'refresh-user.name' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.user.name');
    }
}
