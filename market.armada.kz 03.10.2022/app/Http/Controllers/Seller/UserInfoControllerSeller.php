<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Services\user\UserService;
use App\Models\Sex;
use App\Models\UserInfoSeller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInfoControllerSeller extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = Auth::user();
        $sexes = Sex::all();
        return view('sellers.personal_data.index',compact('user','sexes'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(UserInfoSeller $userInfo)
    {
        //
    }

    public function edit(UserInfoSeller $userInfo)
    {
        //
    }


    public function update(Request $request)
    {
        $this->userService->infoUpdate($request);
        return back()->with('success','Информация изменена');
    }

    public function destroy(UserInfoSeller $userInfo)
    {
        //
    }
}
