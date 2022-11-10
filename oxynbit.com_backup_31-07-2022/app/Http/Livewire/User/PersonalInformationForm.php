<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PersonalInformationForm extends Component
{
    public $user;

    protected $rules = [
        'user.name' => 'required|string|max:255',
        'user.email' => 'required|email',
        'user.date_of_birth' => 'nullable|date',
        'user.present_address'=>'nullable|string|max:255',
        'user.permanent_address'=>'nullable|string|max:255',
        'user.city'=>'nullable|string|max:255',
        'user.country'=>'nullable|string|max:255',
        'user.postal_code'=>'nullable|numeric|max:999999999999999999',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(){
        $this->user = auth()->user();
    }

    public function personalInformationForm(){
        $this->validate([
            'user.email'=>'required|email|unique:users,email,'.$this->user->id,
        ]);

        if ($this->user->postal_code == ''){
            $this->user->postal_code = null;
        }

        $this->user->save();

        $this->emit('saved');
        $this->emit('refresh-navigation');
        $this->emit('refresh-user.name');
    }

    public function render()
    {
        return view('livewire.user.personal-information-form');
    }
}
