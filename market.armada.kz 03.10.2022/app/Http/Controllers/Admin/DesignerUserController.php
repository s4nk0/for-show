<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\DesignerService;
use App\Models\DesignerInfo;
use App\Models\DesignerStyle;
use App\Models\Store;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DesignerUserController extends Controller
{
    protected DesignerService $designerService;
    public function __construct(DesignerService $designerService)
    {
        $this->designerService = $designerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role_id','=', UserRole::DESIGNER)->get();
        return view('admin.designers.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.designer.create');
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
     */
    public function edit($id)
    {
        $user = $this->designerService->getDesignerUser($id);
        $styles = DesignerStyle::all();
        $roles = UserRole::all();

        return view('admin.designers.credit', compact('user', 'roles','styles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->edit($request->only('role_id', 'email', 'sname', 'name', 'mname', 'hcb_link'));
        $user->uploadDataImages($request->avatar, $name = 'avatar');
        $user->isBoolean($request, 'isActive');
        $user->status_id = $user->isActive == true
            ? UserStatus::ACTIVE
            : UserStatus::LOCKED;
        $user->password = $request->password != null
            ? Hash::make($request->password)
            : $user->getOriginal('password');

//        if (isset($request->store_id) && $request->store_id != '' && $user->role_id == User::SELLER) {
//            Store::where('id', '=', $request->store_id)->update(['user_id' => $id]);
//        }
        $user->save();
        $designerInfo = DesignerInfo::firstOrNew(['user_id'=>$id]);
        $designerInfo->description= $request->description;
        $designerInfo->years= $request->years;
        $designerInfo->save();
        $designerInfo->designerStyles()->sync($request->styles);
        $user->designerInfo()->save($designerInfo);

        return redirect()->route('admin.designer.index')->with('success', 'Информация изменена');
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
