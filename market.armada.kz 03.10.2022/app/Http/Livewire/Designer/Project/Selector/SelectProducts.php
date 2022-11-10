<?php

namespace App\Http\Livewire\Designer\Project\Selector;

use App\Models\Product;
use App\Models\DesignerProject;
use Livewire\Component;

class SelectProducts extends Component
{
    public $selected_id;
    public $products_id = [];

    protected $listeners = [
        'selectProducts'=>'select_id',
    ];

    public function mount($designer_project = null){
        if (isset($designer_project)){
            $this->designer_project = $designer_project;
        }
    }

    public function select_id($selected_id){
        //для формы
        if (count($this->products_id)>0){
            //если выбранный продукт уже есть то удаляем его
            if (in_array($selected_id,$this->products_id)){
                $this->products_id = array_diff($this->products_id,array($selected_id));

            } else{
                array_push($this->products_id,$selected_id);
            }
        } else{
            array_push($this->products_id,$selected_id);
        }

        //сохранение продуктов для редактирование
        if (isset($this->designer_project) && isset($selected_id)){
            //если выбранный продукт уже есть то удаляем его
            if(DesignerProject::find($this->designer_project->id)->products()->find($selected_id)){
                DesignerProject::find($this->designer_project->id)->products()->detach(Product::find($selected_id));
           } else{
                DesignerProject::find($this->designer_project->id)->products()->save(Product::find($selected_id));
            };

        }
        if (!isset($this->designer_project)){
            $this->emit('selectProductsViewArray',$selected_id);
        }
        $this->emit('selectProductsViewRefresh');
        $this->emit('getProductsViewRefresh');

    }

    public function render()
    {
        return view('livewire.designer.project.selector.select-products');
    }
}
