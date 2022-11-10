<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{

    protected $listeners = [
        'refresh-navigation' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.navigation');
    }
}
