<?php

namespace App\Http\Livewire\Admin\Content\Video\Content\Create;

use App\Models\AudioContent;
use App\Models\Course;
use App\Models\CourseContent;
use App\Rules\VimeoVideoExist;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use Vimeo\Laravel\Facades\Vimeo;

class Modal extends ModalComponent
{
    use WithFileUploads;

    public $description;
    public $title;
    public $video_id;
    public $file;
    public $course;
    public $video_id_select;
    public $vimeo;
    public $vimeo_test;

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

    public function mount($course_id){
        $this->video_id_select = "null";
        $this->course = Course::find($course_id);
        $this->vimeo = Vimeo::request('/me/videos/');

    }

    public function render()
    {
        return view('livewire.admin.content.video.content.create.modal');
    }

    public function saveContent(){

        $this->validate();

        $material_path = null;
        if ($this->file){
            $file_name = Str::uuid()->toString().'-'.$this->file->getClientOriginalName();
            $path = 'course/materials/';
            $this->file->storeAs('public/'.$path,$file_name);
            $material_path = 'storage/'.$path.'/'.$file_name;
        }

        CourseContent::create([
                'course_id'=>$this->course->id,
                'title'=>$this->title,
                'description'=>$this->description,
                'path'=>$this->video_id,
                'material_path'=>$material_path,

            ]
        );
        $this->emit('curses_content_table_refresh');
        $this->closeModal();
    }
}
