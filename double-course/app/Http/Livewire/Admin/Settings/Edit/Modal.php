<?php

namespace App\Http\Livewire\Admin\Settings\Edit;

use App\Models\Country;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $country;

    protected $rules = [
        'title' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Country $country){
        $this->country = $country;
        $this->title = $country->title;
    }

    public function render()
    {
        return view('livewire.admin.settings.edit.modal');
    }

    public function editCountry(){
        $this->validate();
        $this->country->title = $this->title;
        $this->country->save();

        $this->emit('countries_table_refresh');
        $this->closeModal();
    }
}
