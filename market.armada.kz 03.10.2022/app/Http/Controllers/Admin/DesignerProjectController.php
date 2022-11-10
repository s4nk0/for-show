<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\DesignerService;
use App\Models\DesignerProject;
use App\Models\DesignerStyle;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DesignerProjectController extends Controller
{
    protected DesignerService $designerService;

    public function __construct(DesignerService $designerService)
    {
        $this->designerService = $designerService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $designerProjects = DesignerProject::all();
        return view('admin.designProject.index',compact('designerProjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $designers = User::where('role_id','=',UserRole::DESIGNER)->get();
        $styles = DesignerStyle::all();

        return view('admin.designProject.credit',compact('designers','styles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = DesignerProject::add($request->all());
        $data->uploadDataImages($request->images,'images');
        $data->save();
        return redirect()->route('admin.designer-projects.index')->with('success', 'Информация сохранена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DesignerProject  $designerProject
     * @return \Illuminate\Http\Response
     */
    public function show(DesignerProject $designerProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $data = DesignerProject::findOrFail($id);
        $designers = User::where('role_id','=',UserRole::DESIGNER)->get();
        $styles = DesignerStyle::all();
        return view('admin.designProject.credit',compact('data','designers','styles'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $data = DesignerProject::find($id);
        $data->edit($request->all());
        $data->save();
        return redirect()->route('admin.designer-projects.index')->with('success','изменён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $formatted_id = $this->designerService->deleteDesignerProject($id);
        if(count($formatted_id) > 1) {
            return back()->with('success','удалены');
        } else {
            return back()->with('success','удалён');
        }
    }
}
