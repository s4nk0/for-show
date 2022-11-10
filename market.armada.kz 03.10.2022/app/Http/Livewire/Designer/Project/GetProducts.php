<?php

namespace App\Http\Livewire\Designer\Project;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class GetProducts extends Component
{

    use WithPagination;
    public $designer_project;
    public $search ='';

    protected $listeners = [
        'getProductsViewRefresh'=>'$refresh',
    ];

    public function mount($designer_project){
        $this->designer_project = $designer_project;
    }

    public function updatingSearch()
    {
        $this->resetPage('selected_page');
    }

    public function render()
    {
        $designer_project_products = $this->designer_project->products()->where('title','like','%'.$this->search.'%')->paginate(6, ['*'], 'selected_page');

        return view('livewire.designer.project.get-products',compact('designer_project_products'));
    }
}
