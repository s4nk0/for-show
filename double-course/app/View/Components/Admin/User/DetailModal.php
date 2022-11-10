<?php

namespace App\View\Components\Admin\User;

use App\Models\Role;
use Illuminate\View\Component;

class DetailModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $roles = Role::all();

        return view('components.admin.user.detail-modal',compact('roles'));
    }
}
