<?php

namespace App\Http\Livewire\Admin\Content\Video\Courses\View;

use Livewire\Component;

class Show extends Component
{
    public $course;
    protected $listeners = ['curses_content_table_refresh' => '$refresh'];

    public function mount($course){
        $this->course = $course;
    }

    public function render()
    {
        return view('livewire.admin.content.video.courses.view.show');
    }
}
