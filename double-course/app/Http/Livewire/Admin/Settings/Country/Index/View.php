<?php

namespace App\Http\Livewire\Admin\Settings\Country\Index;

use App\Models\Country;
use Livewire\Component;

class View extends Component
{
    public $countries;

    protected $listeners = ['countries_table_refresh' => '$refresh'];

    public function mount(){
        $this->countries = Country::orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.settings.country.index.view');
    }
}
