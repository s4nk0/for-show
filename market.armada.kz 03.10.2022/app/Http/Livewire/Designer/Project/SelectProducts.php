<?php

namespace App\Http\Livewire\Designer\Project;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class SelectProducts extends Component
{
    use WithPagination;

    public $search;
    public $designer_project;
    public $selected_ids = [];

    protected $listeners = [
        'selectProductsViewRefresh'=>'$refresh',
        'selectProductsViewArray'=>'selected_id', //для create
    ];

    public function mount($designer_project = null,$selected_ids = []){
        $this->selected_ids = $selected_ids;
        $this->designer_project = $designer_project;
    }

    public function updatingSearch()
    {
        $this->resetPage('page');
    }

    public function selected_id($get_id){
        //для дизайна в создании create
        if (count($this->selected_ids)>0){
            //если выбранный продукт уже есть то удаляем его
            if (in_array($get_id,$this->selected_ids)){
                $this->selected_ids = array_diff($this->selected_ids,array($get_id));

            } else{
                array_push($this->selected_ids,$get_id);
            }
        } else{
            array_push($this->selected_ids,$get_id);
        }

    }

    public function render()
    {
        $designer_project = $this->designer_project;
        $products = Product::where('title','like','%'.$this->search.'%')->paginate(6);
        //для create
        $selected_ids = $this->selected_ids;

        return view('livewire.designer.project.select-products',compact('products','designer_project','selected_ids'));
    }
}
