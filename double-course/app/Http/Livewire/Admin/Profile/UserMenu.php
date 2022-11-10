<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;

class UserMenu extends Component
{
    protected $listeners = ['user-menu' => '$refresh'];

    public function render()
    {
        return view('livewire.admin.profile.user-menu');
    }
}
