<?php

namespace App\Http\Controllers;

use App\Events\NewCallBackSubmitted;
use App\Http\Services\ProductService;
use App\Http\Services\Service;
use App\Http\Services\StoreService;
use App\Mail\NewCallback;
use App\Mail\NewCallBackAdmin;
use App\Models\Banner;
use App\Models\Callback;
use App\Models\Catalog;
use App\Models\Country;
use App\Models\Item;
use App\Models\Product;
use App\Models\ProductLike;
use App\Models\Store;
use App\Models\Subcatalog;
use App\Models\Subscription;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class IndexController extends Controller
{
    protected $service;
    protected $productService;
    protected $storeService;

    public function __construct(Service $service, ProductService $productService, StoreService $storeService)
    {
        $this->service = $service;
        $this->productService = $productService;
        $this->storeService = $storeService;
    }

    public function searchGet()
    {
        $querySearch = isset($_GET['q']) ? trim($_GET['q']) : null;

        $productsQuery = $this->service->searchGet($querySearch);

       /* if(count($itemProductsIds) > 0){
            $productsQuery = Product::active()
                ->select('id','title','images','slug','price','price_2','country_id','store_id','item_id')
                ->where(function ($query) use ($querySearch,$itemProductsIds){
                    $query->where ('title','LIKE','%'.$querySearch.'%')
                        ->orWhereIn('item_id',$itemProductsIds);
                });
        }elseif ($shopsQuery->count() > 0)
        {
            $shops_ids = $shopsQuery->pluck('id');
            $productsQuery = Product::active()->whereIn('store_id',$shops_ids)
                ->orWhere('title','LIKE','%'.$querySearch.'%')
                ->orWhere(function ($query) use ($querySearch,$itemProductsIds){
                    $query->where ('title','LIKE','%'.$querySearch.'%')
                        ->orWhereIn('item_id',$itemProductsIds);
                })
                ->select('id','title','images','slug','price','price_2','country_id','store_id','item_id','is_price_from');
        }else{

        }*/

        $storeIds = $productsQuery
            ->pluck('store_id')->unique();
        $stores = Store::whereIn('id',$storeIds)->select('id','title')->orderBy('title')->get();
        $itemIds = $productsQuery
            ->pluck('item_id')->unique();
        $items = Item::whereIn('id',$itemIds)->select('id','slug','title')->get();
        $countryIds = $productsQuery
            ->pluck('country_id')->unique();
        $countries = Country::whereIn('id',$countryIds)->select('id','title_ru','title_kz')->get();

        $minPrice = $productsQuery
            ->min('price');

        $maxPrice = $productsQuery
            ->max('price');
        $productsQuery = $this->productService->searchGetFilter($productsQuery);
//        $this->productService->search($productsQuery);
        $productsQuery = $this->productService->sort($productsQuery);
        $products = $productsQuery->with('store')->with('item')->paginate(16);


        return view('pages.search.index',compact('products','stores','items','countries','minPrice','maxPrice'));
    }

    public function banner()
    {
        if(!isset($_GET['link']))
        {
            return back();
        }
        $banner = Banner::where('link',$_GET['link'])->first();
        $banner->clicks = $banner->getOriginal('clicks') + 1;
        $banner->save();

        return redirect()->to($banner->link);
    }

    public function callback(Request $request)
    {
        $emails = array('ainura.armada@gmail.com','boriss.armada@gmail.com','abdullaeva@armada.kz','info@armada.kz','rustamkozin121099@gmail.com');
        if ($request->type == Callback::MAIN) {

            $callback = Callback::add($request->only('name', 'phone', 'product_id'));
            $callback->user_id = Auth::check() ? Auth::id() : null;
            $callback->save();

            if ($callback->product_id != null) {
                $product = Product::find($callback->product_id);
                $store = $product != null
                    ? $product->store
                    : null;
                $user = $store != null
                    ? $store->user
                    : null;
                if ($user != null and $user->email != null) {
                    Mail::to($user->email)->send(new NewCallback($user));
                }

                if ($store->whatsapp != null) {
                    event(new NewCallBackSubmitted($callback, $store->whatsapp));
                }
            } else {
                //77003279027
                //77477334496

                Mail::to($emails)->send(new NewCallBackAdmin($callback));
                if(env('APP_ENV') != 'local'){
                    event(new NewCallBackSubmitted($callback, '77003279027'));
                }

            }
        }elseif ($request->type == Callback::RENTER){
            Mail::to('ainura.armada@gmail.com')->send(new NewCallBackAdmin($request->only('name', 'phone','type')));
            Mail::to('meirerbol@gmail.com')->send(new NewCallBackAdmin($request->only('name', 'phone','type')));
        }
        return back()->with('success','Спасибо! Мы перезвоним вам в ближайшее время.');
    }

    public function search(Request $request)
    {
        $query = !empty(trim($request->querys)) ? trim($request->querys) : null;
        $page = isset($request->page) ? $request->page : 1;
        $products = array();
        $store = array();
        $items = array();
        $pageCount = 0;

        $productsQuery = Product::active()
            ->where('title','LIKE','%'.$query.'%')
            ->select('id','title','images','slug','price','price_2','store_id','item_id','subcatalog_id','catalog_id',
                'is_price_none','is_price_from');

        $storeSearch = Store::where('title','LIKE','%'.$query.'%')
            ->orWhere('search_map_tags','LIKE','%'.$query.'%')
            ->select('id','slug','title','logo','mini_desc','is_Armada','address','location', 'block','intersection','butik');
        $pageCount = ceil($productsQuery->count()/10);
        if(!$productsQuery->get()->isEmpty()){


            $itemIds = $productsQuery->pluck('item_id')->unique();
            $items = Item::where('isActive',true)->whereIn('id',$itemIds)->select('id','slug','title','images','subcatalog_id')->get();

            /*foreach ($items as $item){
                $item_subCatalog =  Subcatalog::select('id','title','catalog_id')->where('id','=',$item->subcatalog_id)->first();
                $item->subCatalog = $item_subCatalog;
                $item_catalog = Catalog::select('id','title')->where('id','=',$item_subCatalog->catalog_id)->first();
                $item->catalog = $item_catalog;
            }*/

            $products = $productsQuery
                ->forPage($page, 10)
                ->get();
            $storeIds = $products->pluck('store_id')->unique();
            $store = Store::whereIn('id',$storeIds)->select('id','title','slug','logo','mini_desc','is_Armada','address','location', 'block','intersection','butik')->get();
        }
        if(!$storeSearch->get()->isEmpty()){
            //$store = $storeSearch->get();
            $storeIds = $storeSearch->pluck('id')->unique();
            $store_search_title = Store::whereIn('id',$storeIds)->select('id','title','slug','logo','mini_desc')->get();
            $store =  $store_search_title->merge($store);
            if($productsQuery->get()->isEmpty()){
                $productsStore = Product::active()
                    ->where('store_id',$storeIds[0])
                    ->select('id','title','images','slug','price','price_2','store_id','item_id');

                $itemIds = $productsStore->pluck('item_id')->unique();
                $items = Item::where('isActive',true)->whereIn('id',$itemIds)->select('id','slug','title','images','subcatalog_id')->get();

                $products = $productsStore->latest()->forPage($page, 10)->get();
            }


        }


        $data = [$products,$store,$items,$pageCount];

        return response($data);
    }

    public function searchStore(Request $request)
    {
        $query = !empty(trim($request->querys)) ? trim($request->querys) : null;

        $storePage = isset($request->page) ? $request->page : 1;

        $storeSearch = Store::where('title','LIKE','%'.$query.'%')
                ->orWhere('title','LIKE','%'.$query.'%')
                ->orWhere('seo_title','LIKE','%'.$query.'%')
                ->orWhere('original_title','LIKE','%'.$query.'%')
                ->orWhere('description','LIKE','%'.$query.'%')
                ->orWhere('mini_description','LIKE','%'.$query.'%')
                ->orWhere('meta_description','LIKE','%'.$query.'%')
                ->orWhere('mini_desc','LIKE','%'.$query.'%')
                ->orWhere('search_tags','LIKE','%'.$query.'%')
                ->orWhere('search_map_tags','LIKE','%'.$query.'%')
                ->select('id','slug','title');

        $pageCount = $storeSearch != null
            ? ceil($storeSearch->count()/10)
            : null;

        $store = (Auth::check() and Auth::user()->role_id == UserRole::ADMIN)
            ? $storeSearch->forPage($storePage, 10)
                ->get()
            : null;

        $data = [$pageCount,$store];

        return response($data);
    }

    public function sellerLogin()
    {
        return view('auth.seller_login');
    }

    public function sellerRegister()
    {
        return view('auth.seller_register');
    }

    public function designerLogin()
    {
        return view('auth.designer_login');
    }

    public function designerRegister()
    {
        return view('auth.designer_register');
    }

    public function pay()
    {
        return view('pay');
    }

    public function payOk(Request $request)
    {
        $file = 'filex.txt';
//        $data = file_get_contents($file);
        $data = $_POST ;//. $_POST . '//////////////////'
        $filex = file_put_contents($file, $data );
//        file_put_contents('file.txt', $data );
        if($filex)
        {
            dd($filex);
        }
        else
        {
            dd(124);
        }
    }

    public function payError(Request $request)
    {
        dd(124);
    }

    public function subscription(Request $request)
    {
        Subscription::firstOrCreate(['email'=>$request->email]);

        return back()->with('success','Вы оформили подписку');
    }

    public function cart(Request $request){
        return view('pages.cart.index');
    }
}
