<?php

namespace App\Http\Livewire\Admin\Settings\City\Create;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $country_id;
    public $countries;

    protected $rules = [
        'title' => 'required',
        'country_id' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(){
        $this->countries = Country::orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.settings.city.create.modal');
    }

    public function saveCity(){
        $validatedData = $this->validate();

        City::create($validatedData);

        $this->emit('cities_table_refresh');
        $this->closeModal();
    }
}
