<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Services\Service;
use App\Models\Catalog;
use App\Models\DesignerInfo;
use App\Models\DesignerProject;
use App\Models\DesignerStyle;
use App\Models\ProductLike;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserRole;
use Box\Spout\Common\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use mysql_xdevapi\Exception;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $styles = DesignerStyle::all();
        $filterStyles = request()->filter_styles ?? DesignerStyle::pluck('id')->toArray();
        $sortName = request()->sort ?? null;
        $designers_query = User::where('role_id','=',UserRole::DESIGNER);
        if(isset($filterStyles) && count($filterStyles) > 0){
            $designers_query = $designers_query->whereHas('designerInfo', function ( $queryInfo) use ($filterStyles) {
                $queryInfo->whereHas('designerStyles', function ( $queryStyles) use ($filterStyles) {
                    $queryStyles->whereIn('id',$filterStyles);
                });
            });
        }

        if(isset($sortName) and $sortName != ''){

            try {
                $designers_query = $designers_query->orderBy('sname', $sortName);
            }catch (\Exception $e){
                return redirect()->route('services.index')->with('error','ошибка');
            }

        }
        $designers = $designers_query->get();

        return view('pages.services.index',compact('designers','styles','filterStyles','sortName'));

    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $designer = User::where('role_id','=',UserRole::DESIGNER)->where('id','=',$id)->first();
        $designer_projects = DesignerProject::where('user_id','=',$id)->get();
        return view('pages.services.show',compact('designer_projects','designer'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
