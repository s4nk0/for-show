<?php

namespace App\Http\Livewire\Admin\User\Edit;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $user;
    public $isActive;
    public $name;
    public $last_name;
    public $selected_roles;
    public $phone;
    public $password;
    public $email;
    public $city;
    public $description;

    public function mount($user_id) {
        $this->user = User::find($user_id);
        $this->isActive = $this->user->isActive;
        $this->name = $this->user->name;
        $this->last_name = $this->user->last_name;
        $this->selected_roles = $this->user->roles()->get()->pluck('id')->toArray();
        $this->phone = $this->user->phone;
        $this->email = $this->user->email;
        $this->city = $this->user->city_id;
        $this->description = $this->user->description;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,  [
            'name' => 'required|min:4',
            'selected_roles' => 'required',
            'phone' => 'required|string',
            'email' => 'nullable|email|unique:users,email,'.$this->user->id,
        ]);
    }

    public function render()
    {
        $roles = Role::all();
        $cities = City::all();
        return view('livewire.admin.user.edit.modal',compact('roles','cities'));
    }

    public function editUser(){
        $this->validate([
            'name' => 'required|min:4',
            'selected_roles' => 'required',
            'phone' => 'required|string',
            'email' => 'nullable|email|unique:users,email,'.$this->user->id,
        ]);
        $this->user->isActive = $this->isActive;
        $this->user->name = $this->name;
        $this->user->last_name = $this->last_name;
        $this->user->roles()->sync($this->selected_roles);
        $this->user->phone = $this->phone;
        $this->user->email = $this->email;
        $this->user->city_id = $this->city;
        $this->user->description = $this->description;
        $this->user->save();
        $this->emit('users_table');
        $this->closeModal();
    }
}
