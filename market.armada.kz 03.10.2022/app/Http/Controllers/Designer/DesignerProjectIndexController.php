<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Http\Services\DesignerService;
use App\Models\DesignerProject;
use App\Models\DesignerStyle;
use App\Models\Product;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class DesignerProjectIndexController extends Controller
{
    protected DesignerService $designerService;

    public function __construct(DesignerService $designerService)
    {
        $this->designerService = $designerService;
    }

    public function index(){
        $projects = DesignerProject::where('user_id',\auth()->id())->get();
        return view('designer.projects.index',compact('projects'));
    }

    public function create(Request $request){
        $styles = DesignerStyle::all();
        return view('designer.projects.credit',compact('styles'));
    }

    public function store(Request $request){
        //сохранение данных
        $data = DesignerProject::add($request->all());
        $data->uploadDataImageInJSON($request->images,'images');

        $data->save();

        //сохроняем продукты
        if (isset($request->products_id)){
            DesignerProject::find($data->id)->products()->saveMany(Product::whereIn('id',$request->products_id)->get());

        }

        return redirect()->route('designer.projects.index')->with('success', 'Информация сохранена');
    }


    public function edit($id){
        $data = DesignerProject::findOrFail($id);
        $styles = DesignerStyle::all();
        return view('designer.projects.credit',compact('data','styles'));
    }

    public function update(Request $request, $id){
        $data = DesignerProject::find($id);
        $data->edit($request->all());

        if (json_decode($data->images) != $request->images){
            $data->uploadDataImages($request->images,'images');
        }
        
        $data->save();
        return redirect()->route('designer.projects.index')->with('success', 'Информация сохранена');
    }

    public function destroy($id){

        $formatted_id = $this->designerService->deleteDesignerProject($id);
        if(count($formatted_id) > 1) {
            return back()->with('success','удалены');
        } else {
            return back()->with('success','удалён');
        }

    }
}
