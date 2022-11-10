<?php

namespace App\View\Components\Manager;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class InvitedUsersTable extends Component
{

    public $user;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user = null)
    {
        if ($user == null){
            $this->user = Auth::user();
        } else{
            $this->user = $user;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.manager.invited-users-table');
    }
}
