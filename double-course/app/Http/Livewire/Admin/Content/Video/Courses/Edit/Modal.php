<?php

namespace App\Http\Livewire\Admin\Content\Video\Courses\Edit;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $title;
    public $course;

    protected $rules = [
        'title' => 'required|min:4',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($course_id) {
        $this->course = Course::find($course_id);
        $this->title = $this->course->title;
    }

    public function render()
    {
        return view('livewire.admin.content.video.courses.edit.modal');
    }

    public function editCourse(){
        $this->validate();
        $this->course->title = $this->title;
        $this->course->save();
        $this->emit('curses_table_refresh');
        $this->closeModal();
    }
}
