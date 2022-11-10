<?php

namespace App\Http\Livewire\Admin\Content\Video\Content\Edit;

use App\Models\CourseContent;
use App\Rules\VimeoVideoExist;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Vimeo\Laravel\Facades\Vimeo;

class Modal extends ModalComponent
{
    use WithFileUploads;

    public $content;
    public $title;
    public $description;
    public $video_id;
    public $file;
    public $video_id_select;
    public $vimeo;

    protected function rules()
    {
        return [
            'title' => 'required|min:4',
            'description' => 'nullable|min:4',
            'video_id' => ['required'],
            'file' => 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        if ($this->video_id_select != "null"){
            $this->video_id = $this->video_id_select;
        }

        $this->validateOnly($propertyName);
    }

    public function mount($content_id){
        $this->content = CourseContent::find($content_id);
        $this->description = $this->content->description;
        $this->title = $this->content->title;
        $this->video_id = $this->content->path;
        $this->video_id_select = $this->content->path;
        $this->vimeo = Vimeo::request('/me/videos/');
    }

    public function render()
    {
        return view('livewire.admin.content.video.content.edit.modal');
    }

    public function editContent(){
        $this->validate();

        $material_path = $this->content->material_path;
        if ($this->file){
            if ($this->content->material_path){
                File::delete($this->content->material_path);
            }

            $file_name = Str::uuid()->toString().'-'.$this->file->getClientOriginalName();
            $path = 'course/materials/';
            $this->file->storeAs('public/'.$path,$file_name);
            $material_path = 'storage/'.$path.'/'.$file_name;
        }

        $this->content->description = $this->description;
        $this->content->path = $this->video_id;
        $this->content->title = $this->title;
        $this->content->material_path = $material_path;

        $this->content->save();
        $this->emit('curses_content_table_refresh');
        $this->closeModal();
    }
}
