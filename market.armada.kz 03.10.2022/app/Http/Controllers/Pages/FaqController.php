<?php

namespace App\Http\Controllers\Pages;

use App\Models\Faq;
use App\Models\ProductLike;
use Illuminate\Http\Request;
use App\Http\Services\Service;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class FaqController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $faqs = Faq::isActive()->get();

    //    if(isset($_GET['faq-update-products']))
    //    {
    //        $updateProducts = DB::table('products')->where('isActive', 1)->update(['isActive' => 0]);

    //        if($updateProducts)
    //        {
    //            return 'Success';
    //        }
    //    }

    //    if(isset($_GET['faq-update-stores']))
    //    {
    //        $updateStores = DB::table('stores')->where('isActive', 1)->update(['isActive' => 0, 'tarif_end_date' => \Carbon\Carbon::parse('2021-12-16')]);

    //        if($updateStores)
    //        {
    //            return 'Success';
    //        }
    //    }

        return view('pages.faqs.index',compact('faqs'));
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
        //
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
