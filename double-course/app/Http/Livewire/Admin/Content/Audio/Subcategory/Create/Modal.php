<?php

namespace App\Http\Livewire\Admin\Content\Audio\Subcategory\Create;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $category;

    protected $rules = [
        'title' => 'required|min:4',
    ];

    public function mount($category_id){
        $this->category = Category::find($category_id);
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.content.audio.subcategory.create.modal');
    }

    public function saveSubcategory(){
        $this->validate();
        $this->category->subcategories()->save(new Subcategory(['title'=>$this->title]));
        $this->emit('subcategory_table_refresh');
        $this->closeModal();
    }
}
