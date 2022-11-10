<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Http\Services\DesignerService;
use App\Http\Services\user\UserService;
use App\Models\DesignerInfo;
use App\Models\DesignerProject;
use App\Models\DesignerStyle;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignerIndexController extends Controller
{

   protected DesignerService $designerService;
   protected UserService  $userService;

    public function __construct(DesignerService $designerService,UserService  $userService)
    {
        $this->designerService = $designerService;
        $this->userService = $userService;
    }

    public function home()
    {
        $projectsCount= DesignerProject::where('user_id',auth()->id())->count();
        return view('designer.home.index',compact('projectsCount'));
    }

    public function info(){
        $id = auth()->id();
        $user = $this->designerService->getDesignerUser($id);
        $styles = DesignerStyle::all();
        $roles = UserRole::all();
        return view('designer.personal_data.index',compact('user','roles','styles'));
    }

    public function infoEdit(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->userService->infoUpdate($request);
        return back()->with('success','Информация изменена');
    }

    public function designerInfoShow(){
        $userInfo = DesignerInfo::where('user_id','=',auth()->id())->first();
        $styles = DesignerStyle::all();

        return view('designer.designer_info.index',compact('userInfo','styles'));
    }

    public function designerInfoUpdate(Request $request): \Illuminate\Http\RedirectResponse
    {
        $designerInfo = DesignerInfo::firstOrNew(['user_id'=>auth()->id()]);
        $designerInfo->description= $request->description;
        $designerInfo->years= $request->years;
        $designerInfo->save();
        $designerInfo->designerStyles()->sync($request->styles);
        return back()->with('success','Информация изменена');
    }



}
