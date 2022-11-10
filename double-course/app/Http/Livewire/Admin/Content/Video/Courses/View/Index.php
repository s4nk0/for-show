<?php

namespace App\Http\Livewire\Admin\Content\Video\Courses\View;

use App\Models\Course;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['curses_table_refresh' => '$refresh'];

    public function render()
    {
        $courses = Course::all();

        return view('livewire.admin.content.video.courses.view.index',compact('courses'));
    }
}
