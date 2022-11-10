<?php

namespace App\Http\Livewire\Admin\Content\Audio\Content\Create;

use App\Models\AffirmationText;
use App\Models\AudioContent;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    use WithFileUploads;

    public $subcategory;
    public $title;
    public $description;
    public $file;
    public $category;
    public $affirmation_texts = null;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'nullable',
        'file' => 'required|mimes:mpga,wav,mp3',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($subcategory_id){


        $this->subcategory = Subcategory::find($subcategory_id);
        $this->category = Category::find($this->subcategory->category_id);

        if ($this->subcategory->category_id == 2){

            $affirmation_texts = array(['text'=>'','delay'=>0]);
        } else{
            $affirmation_texts= null;
        }

        $this->affirmation_texts = $affirmation_texts;

    }

    public function render()
    {
        return view('livewire.admin.content.audio.content.create.modal');
    }

    public function saveContent(){
        $this->validate();

        $file_name = Str::uuid()->toString().'-'.$this->file->getClientOriginalName();
        $path = 'audio/'.$this->category->audio_path;

        $this->file->storeAs('public/'.$path,$file_name);
        $audio = new AudioContent(['title'=>$this->title,'path'=>'storage/'.$path.'/'.$file_name,'description'=>$this->description]);
        $this->subcategory->contents()->save($audio);

        if ($this->subcategory->category_id == 2){
            AudioContent::find($audio->id)->affirmation_texts()->createMany($this->affirmation_texts);
        }

        $this->emit('subcategory_table_refresh');
        $this->closeModal();
    }

    public function add_text(){
        array_push($this->affirmation_texts,['text'=>'','delay'=>0]);
    }

    public function decrease_text(){
        array_pop($this->affirmation_texts);
    }
}
