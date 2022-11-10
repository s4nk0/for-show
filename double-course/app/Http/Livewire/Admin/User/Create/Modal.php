<?php

namespace App\Http\Livewire\Admin\User\Create;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $isActive;
    public $name;
    public $last_name;
    public $selected_roles;
    public $phone;
    public $password;
    public $email;
    public $city;
    public $description;

    protected $rules = [
        'name' => 'required|min:4',
        'selected_roles' => 'required',
        'phone' => 'required|string',
        'email' => 'nullable|email|unique:users,email',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $roles = Role::all();
        $cities = City::all();
        return view('livewire.admin.user.create.modal',compact('roles','cities'));
    }

    public function saveUser()
    {
        $this->validate();

        if (!$this->email){
            $this->email = 'email-'.$this->getLastUserId()+1;
        }

        $user = User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'isActive' => $this->isActive,
            'phone' => $this->phone,
            'email' => $this->email,
            'city_id' => $this->city,
            'password' => Hash::make($this->password),
            'description' => $this->description,
        ]);
        $user->roles()->sync($this->selected_roles);
        $this->emit('users_table');
        $this->closeModal();
    }

    private function getLastUserId(){
        $user = User::latest()->first();
        if (!$user){
            return 0;
        }
        return $user->id;
    }
}
