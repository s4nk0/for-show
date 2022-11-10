<?php

namespace App\Http\Livewire\Admin\Content\Audio\Content\Edit;

use App\Models\AudioContent;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    use WithFileUploads;

    public $content;
    public $title;
    public $description;
    public $file;

    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'nullable',
        'file' => 'nullable|mimes:mpga,wav,mp3',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($content_id){
        $this->content = AudioContent::find($content_id);
        $this->title = $this->content->title;
        $this->description = $this->content->description;

        if ($this->content->subcategory()->first()->category_id == 2){

            $affirmation_texts = $this->content->affirmation_texts()->get()->toArray();
        }else{
            $affirmation_texts= null;
        }

        $this->affirmation_texts = $affirmation_texts;
    }

    public function render()
    {
        return view('livewire.admin.content.audio.content.edit.modal');
    }

    public function editContent(){
        $this->validate();
        if ($this->file){
            File::delete($this->content->path);
            $file_name = Str::uuid()->toString().'-'.$this->file->getClientOriginalName();
            $path = 'audio/'.$this->content->subcategory()->first()->category()->first()->audio_path;
            $this->file->storeAs('public/'.$path,$file_name);

            $this->content->path = 'storage/'.$path.'/'.$file_name;
        }
        $this->content->title = $this->title;
        $this->content->description = $this->description;

        if ($this->content->subcategory()->first()->category_id  == 2){
            $this->content->affirmation_texts()->delete();
            $this->content->affirmation_texts()->createMany($this->affirmation_texts);
        }

        $this->content->save();
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
