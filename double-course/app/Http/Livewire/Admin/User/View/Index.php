<?php

namespace App\Http\Livewire\Admin\User\View;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];

    protected $listeners = ['users_table' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage('page');
    }

    public function render()
    {
        $users = User::search($this->search)->paginate(15);
        return view('livewire.admin.user.view.index',compact('users'));
    }
}
