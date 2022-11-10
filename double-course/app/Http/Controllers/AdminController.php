<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function settings(){
        return view('admin.settings.index');
    }

    public function destroyCountry(Country $country){
        $country->delete();
        return redirect()->route('admin.settings.index');
    }

    public function destroyCity(City $city){
        $city->delete();
        return redirect()->route('admin.settings.index');
    }

}
