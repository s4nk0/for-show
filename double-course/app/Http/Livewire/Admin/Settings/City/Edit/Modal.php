<?php

namespace App\Http\Livewire\Admin\Settings\City\Edit;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $country_id;
    public $countries;
    public $city;

    protected $rules = [
        'title' => 'required',
        'country_id' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(City $city){
        $this->city = $city;
        $this->countries = Country::orderBy('created_at','desc')->get();
        $this->title = $city->title;
        $this->country_id = $city->country()->first()->id;
    }

    public function render()
    {
        return view('livewire.admin.settings.city.edit.modal');
    }

    public function editCity(){
        $this->validate();

        $this->city->title = $this->title;
        $this->city->country_id = $this->country_id;
        $this->city->save();

        $this->emit('cities_table_refresh');
        $this->closeModal();
    }
}
