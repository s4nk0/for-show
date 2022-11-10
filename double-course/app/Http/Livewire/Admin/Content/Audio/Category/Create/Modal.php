<?php

namespace App\Http\Livewire\Admin\Content\Audio\Category\Create;

use App\Models\Category;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $description;
    public $audio_path;

    protected $rules = [
        'title' => 'required|min:4',
        'audio_path' => 'required|min:4',
        'description' => 'nullable',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.content.audio.category.create.modal');
    }

    public function saveCategory(){
        $validatedData = $this->validate();
        Category::create([
            'title'=>$this->title,
            'description'=>$this->description,
            'audio_path'=>$this->audio_path,
        ]);
        $this->emit('category_table_refresh');
        $this->closeModal();
    }
}
