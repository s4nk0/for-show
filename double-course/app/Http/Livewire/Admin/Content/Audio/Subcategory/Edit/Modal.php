<?php

namespace App\Http\Livewire\Admin\Content\Audio\Subcategory\Edit;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $subcategory;

    protected $rules = [
        'title' => 'required|min:4',
    ];

    public function mount($subcategory_id){
        $this->subcategory = Subcategory::find($subcategory_id);
        $this->title = $this->subcategory->title;
    }


    public function render()
    {
        return view('livewire.admin.content.audio.subcategory.edit.modal');
    }

    public function editSubcategory(){
        $this->validate();
        $this->subcategory->title = $this->title;
        $this->subcategory->save();
        $this->emit('subcategory_table_refresh');
        $this->closeModal();
    }
}
