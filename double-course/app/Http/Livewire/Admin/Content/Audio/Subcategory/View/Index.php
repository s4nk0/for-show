<?php

namespace App\Http\Livewire\Admin\Content\Audio\Subcategory\View;

use Livewire\Component;

class Index extends Component
{
    public $category;

    protected $listeners = ['subcategory_table_refresh' => '$refresh'];

    public function mount($category){
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.admin.content.audio.subcategory.view.index');
    }
}
