<?php

namespace App\Http\Livewire\Admin\Content\Audio\Category\Edit;

use App\Models\Category;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $description;
    public $category;
    public $audio_path;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'nullable',
        'audio_path' => 'required|min:4',
    ];

    public function mount($category_id) {
        $this->category = Category::find($category_id);
        $this->title = $this->category->title;
        $this->description = $this->category->description;
        $this->audio_path = $this->category->audio_path;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.content.audio.category.edit.modal');
    }

    public function editCategory(){
        $this->validate();

        $this->category->title = $this->title;
        $this->category->description = $this->description;
        $this->category->audio_path = $this->audio_path;
        $this->category->save();

        $this->emit('category_table_refresh');
        $this->closeModal();
    }
}
