<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypePay;
use Illuminate\Http\Request;

class TypePayAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $payments = TypePay::all();
        return view('admin.typePay.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.typePay.credit');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $data = TypePay::add($request->all());
        $data->save();
        return redirect()->route('admin.type-pays.index')->with('success','Способ оплаты добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypePay  $typePay
     * @return \Illuminate\Http\Response
     */
    public function show(TypePay $typePay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $data = TypePay::findOrFail($id);
        return view('admin.typePay.credit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        $data = TypePay::find($id);
        $data->edit($request->all());
        $data->save();
        return redirect()->route('admin.type-pays.index')->with('success','Способ оплаты изменён');
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
            $data = TypePay::find($item);
            $data->delete();
        }

        /*if(count($id) > 1) {
            return back()->with('success','Доставка удалён');
        } else {
            return back()->with('success','Доставка удалён');
        }*/
        return back()->with('success','Способ оплаты удалён');
    }
}
