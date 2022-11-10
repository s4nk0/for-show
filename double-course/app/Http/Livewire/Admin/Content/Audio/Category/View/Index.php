<?php

namespace App\Http\Livewire\Admin\Content\Audio\Category\View;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['category_table_refresh' => '$refresh'];

    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.content.audio.category.view.index',['categories'=>$categories]);
    }
}
