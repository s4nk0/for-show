<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeDelivery;
use Illuminate\Http\Request;

class TypeDeliveryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $deliveries = TypeDelivery::all();
        return view('admin.typeDelivery.index',compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.typeDelivery.credit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $data = TypeDelivery::add($request->all());
        $data->save();
        return redirect()->route('admin.type-deliveries.index')->with('success','Доставка добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeDelivery  $typeDelivery
     * @return \Illuminate\Http\Response
     */
    public function show(TypeDelivery $typeDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $data = TypeDelivery::findOrFail($id);
        return view('admin.typeDelivery.credit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = TypeDelivery::find($id);
        $data->edit($request->all());
        $data->save();
        return redirect()->route('admin.type-deliveries.index')->with('success','Доставка изменён');
    }

    /**
     * Remove the specified resource from storage.
     *
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
            $data = TypeDelivery::find($item);
            $data->delete();
        }

        /*if(count($id) > 1) {
            return back()->with('success','Доставка удалён');
        } else {
            return back()->with('success','Доставка удалён');
        }*/
        return back()->with('success','Доставка удалён');
    }
}
