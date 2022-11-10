<?php

namespace App\Http\Livewire\Admin\Settings\Country\Create;

use App\Models\Country;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;

    protected $rules = [
        'title' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.settings.country.create.modal');
    }

    public function saveCountry(){
        $validatedData = $this->validate();

        Country::create($validatedData);

        $this->emit('countries_table_refresh');
        $this->closeModal();
    }
}
