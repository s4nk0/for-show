<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileCustomController extends Controller
{
    public function wallet(){
        $user = Auth::user();
        $transactions = DB::table('transactions')->where('user_id', '=', $user->id)->get();

        return view('profile.wallet',compact('transactions'));
    }

    public function transfer(){
        return view('profile.transfer');
    }

    public function invest(){
        return view('profile.invest');
    }

    public function affiliate(){
        return view('profile.affiliate');
    }

    public function api(){
        return view('profile.api');
    }

    public function deposit(){
        return view('profile.deposit');
    }

    public function withdraw(){
        return view('profile.withdraw');
    }
}
