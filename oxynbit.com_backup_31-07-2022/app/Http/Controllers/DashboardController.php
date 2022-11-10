<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $btc_wallet_id = $user->btc_wallet_id;
        $btc_wallet_id_hash = $user->btc_wallet_id_hash;
        $ltc_wallet_id = $user->ltc_wallet_id;
        $ltc_wallet_id_hash = $user->ltc_wallet_id_hash;
        $eth_wallet_id = $user->eth_wallet_id;
        $transactions = DB::table('transactions')->where('user_id', '=', $user->id)->get();
        return view('dashboard', ['btc_wallet_id' => $btc_wallet_id, 'btc_wallet_id_hash' => $btc_wallet_id_hash, 'ltc_wallet_id' => $ltc_wallet_id, 'ltc_wallet_id_hash' => $ltc_wallet_id_hash, 'eth_wallet_id' => $eth_wallet_id, 'transactions' => $transactions]);
//        return redirect('/user/profile/wallet');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
