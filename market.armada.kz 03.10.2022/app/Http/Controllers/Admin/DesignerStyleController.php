<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\DesignerStyle;
use Illuminate\Http\Request;

class DesignerStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $data = DesignerStyle::all();
        $colors = DesignerStyle::all();
        return view('admin.designStyle.index',compact('colors'));
        //return view('admin.designCategory.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.designStyle.credit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = DesignerStyle::add($request->all());
        $data->save();
        return redirect()->route('admin.designer-styles.index')->with('success','Добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DesignerStyle  $designerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DesignerStyle $designerCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $data = DesignerStyle::findOrFail($id);
        return view('admin.designStyle.credit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $data = DesignerStyle::find($id);
        $data->edit($request->all());
        $data->save();
        return redirect()->route('admin.designer-styles.index')->with('success','изменён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $id = explode(',', $id);

        if(!is_array($id))
        {
            $id[] = $id;
        }

        foreach ($id as $item)
        {
            $data = DesignerStyle::find($item);
            $data->delete();
        }

        if(count($id) > 1) {
            return back()->with('success','Стили удалены');
        } else {
            return back()->with('success','Стил удалён');
        }
    }
}
