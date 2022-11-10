<?php

namespace App\Http\Livewire\Admin\Settings\City\Index;

use App\Models\City;
use Livewire\Component;

class View extends Component
{
    public $cities;

    protected $listeners = ['cities_table_refresh' => '$refresh'];

    public function mount(){
        $this->cities = City::orderBy('created_at','desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.settings.city.index.view');
    }
}
