<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Services\BannerService;
use App\Http\Services\ProductService;
use App\Http\Services\Service;
use App\Models\Banner;
use App\Models\BannerType;
use App\Models\Catalog;
use App\Models\Color;
use App\Models\Country;
use App\Models\Item;
use App\Models\Product;
use App\Models\ProductLike;
use App\Models\Store;
use App\Models\Subcatalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class CatalogController extends Controller
{
    protected $service;
    protected $bannerService;
    protected $productService;

    public function __construct(Service $service,BannerService $bannerService,ProductService $productService)
    {
        $this->service = $service;
        $this->bannerService = $bannerService;
        $this->productService = $productService;
    }

    public function index($slug)
    {
        $catalog = Catalog::with('subcatalogs','subcatalogs.items')
            ->where('status', true)
            ->where('slug',$slug)
            ->select('id','slug','images','title','meta_desc','meta_title')
            ->firstOrFail();
        $subcatalogs = Subcatalog::with('items')
            ->where('isActive', true)
            ->where('catalog_id',$catalog->id)
            ->select('id','slug','images','title')
            ->orderBy('title')
            ->get();
        $subcatalogsId = $subcatalogs->pluck('id');
        $items = Item::where('isActive', true)
            ->whereIn('subcatalog_id',$subcatalogsId)
            ->select('id','slug','subcatalog_id','images','title')
            ->orderBy('title')
            ->get();
        $productsQuery = Product::active()
            ->where('store_id','!=',null)
            ->whereIn('subcatalog_id',$subcatalogsId);
        $products = $productsQuery->latest()
            ->paginate(16);

        $banners = $this->bannerService->views(BannerType::CATEGORY)->where('catalog', $catalog->id);

        $views = $this->productService->views();
        $likeIds = $this->service->likeIds();

        return view('pages.catalogs.index',compact('catalog','subcatalogs','items','views','products','banners','likeIds'));//,'stores','countries'
    }

    public function show($slug)
    {
        $subcatalog = Subcatalog::with('catalog')
            ->where('slug', $slug)
            ->firstOrFail();//, 'items'
        $items = Item::where('isActive', true)
            ->where('subcatalog_id',$subcatalog->id)
            ->select('id','slug','images','title')
            ->orderBy('title')
            ->get();

        $productsQuery = Product::active()
            ->select('id','is_hot','title','slug','is_discount','discount','store_id','price','price_2','images', 'colors')
            ->where('subcatalog_id', $subcatalog->id);

        $banners = $this->bannerService->views(BannerType::SUBCATEGORY)->where('subcatalog', $subcatalog->id);

        $products = $productsQuery->paginate(16);

        //return now()->format('Y-m-d');

        $views = $this->productService->views();
        $likeIds = $this->service->likeIds();

        return view('pages.catalogs.show', compact( 'subcatalog','items', 'views', 'products','likeIds', 'banners'));
    }

    public function subcatalogShow($slug)
    {
        $subcatalog = Subcatalog::where('isActive', true)
            ->whereHas('catalog', function ($q) {
                $q->where('isActive', true);
            })
            ->where('slug',$slug)
            ->select('id','slug','catalog_id','images','title','meta_title','meta_desc')
            ->orderBy('title')
            ->firstOrFail();

        $items = Item::where('isActive', true)
            ->where('subcatalog_id',$subcatalog->id)
            ->select('id','slug','subcatalog_id','images','title')
            ->orderBy('title')
            ->get();

        $storesId = Product::active()
            ->whereIn('item_id', $items->pluck('id'))
            ->where('store_id', '!=', null)->pluck('store_id')->unique();
        $stores = Store::whereIn('id', $storesId)->select('id','title')->get();
        $countriesId = Product::active()
            ->whereIn('item_id', $items->pluck('id'))
            ->where('country_id', '!=', null)->pluck('country_id')->unique();
        $countries = Country::whereIn('id',$countriesId)->select('id','title_ru','title_kz')->orderBy('title_ru')->get();

        $minPrice = Product::active()
            ->whereIn('item_id', $items->pluck('id'))
            ->min('price');
        $maxPrice = Product::active()
            ->whereIn('item_id', $items->pluck('id'))
            ->max('price');

        $productsQuery = Product::active()
            ->select('id','catalog_id', 'subcatalog_id', 'item_id','is_hot','title','slug','is_discount','discount','store_id','price','price_2','images', 'colors')
            ->whereIn('item_id', $items->pluck('id'));
        $this->productService->filter($productsQuery);
        $this->productService->search($productsQuery);
        $this->productService->sort($productsQuery);
        $products = $productsQuery->latest()
            ->orderBy('is_hot')
            ->with('store')
            ->paginate(16);

        $views = $this->productService->views();
        $likeIds = $this->service->likeIds();

        $banners = $this->bannerService->views(BannerType::SUBCATALOG)->where('subcatalog', $subcatalog->id);
        $banner_subcategories = $this->bannerService->views(BannerType::SUBCATEGORY)->where('subcatalog', $subcatalog->id);

        return view('pages.catalogs.subcatalog_show', compact( 'subcatalog','items','products','stores','countries','maxPrice','minPrice','views','likeIds', 'banners','banner_subcategories'));
    }

    public function itemShow($slug)
    {
        $item = Item::where('isActive', true)
            ->whereHas('subcatalog', function ($q) {
                $q->where('isActive', true);
                $q->whereHas('catalog', function ($q) {
                    $q->where('isActive', true);
                });
            })
            ->where('slug',$slug)
            ->select('id','slug','subcatalog_id','images','title','meta_desc','meta_title')
            ->orderBy('title')
            ->firstOrFail();

        $storesId = Product::active()
            ->where(function ($query){})
            ->where('item_id', $item->id)
            ->orWhere(function ($query) use ($item) {
                if($item->id == Item::DISCOUNT_ZONE_ID){
                    $query->where('is_discount',true)->where('discount','>=',25);
                }
            })
            ->where('isActive', '!=', 0)
            ->where('store_id', '!=', null)->pluck('store_id')->unique();
        $stores = Store::whereIn('id', $storesId)->select('id','title')->get();
        $countriesId = Product::active()
            ->where('item_id', $item->id)
            ->orWhere(function ($query) use ($item) {
                if($item->id == Item::DISCOUNT_ZONE_ID){
                    $query->where('is_discount',true)->where('discount','>=',25);
                }
            })
            ->where('country_id', '!=', null)->pluck('country_id')->unique();
        $countries = Country::whereIn('id',$countriesId)->select('id','title_ru','title_kz')->orderBy('title_ru')->get();
        //$count1 = $productsQuery->count();
        $productColors = Product::active()->where('item_id', $item->id)->where('colors', '!=', null)->pluck('colors')->unique();
        //dd($productColors->toArray());
        $colors = Color::whereIn('colors.slug', $productColors)->select('id','slug','title_ru','title_kz')->orderBy('title_ru')->get();

        $manufactures = Product::active()->where('item_id', $item->id)
            ->orWhere(function ($query) use ($item) {
            if($item->id == Item::DISCOUNT_ZONE_ID){
                $query->where('is_discount',true)->where('discount','>=',25);
            }
        })->where('manufacture', '!=', null)->pluck('manufacture')->unique();

        $materials = Product::active()->where('item_id', $item->id)->orWhere(function ($query) use ($item) {
            if($item->id == Item::DISCOUNT_ZONE_ID){
                $query->where('is_discount',true)->where('discount','>=',25);
            }
        })->where('material', '!=', null)->pluck('material')->unique();
        //return $manufactures;

        $minPrice = 0;
        if($item->id == Item::DISCOUNT_ZONE_ID){
            $minPrice = Product::active()
                ->where('item_id', $item->id)
                ->orWhere(function ($query) use ($item) {
                    if($item->id == Item::DISCOUNT_ZONE_ID){
                        $query->where('is_discount',true)->where('discount','>=',25);
                    }
                })
                ->selectRaw('min(price * ( 1 - discount/100)) as min_price')->first()->min_price;
        }else{
            $minPrice = Product::active()
                ->where('item_id', $item->id)
                ->orWhere(function ($query) use ($item) {
                    if($item->id == Item::DISCOUNT_ZONE_ID){
                        $query->where('is_discount',true)->where('discount','>=',25);
                    }
                })
                ->min('price');
        }


        $maxPrice = Product::active()
            ->where('item_id', $item->id)
            ->orWhere(function ($query) use ($item) {
                if($item->id == Item::DISCOUNT_ZONE_ID){
                    $query->where('is_discount',true)->where('discount','>=',25);
                }
            })
            ->max('price');


        $productsQuery = Product::active()
            ->select('id','is_hot','title','slug','is_discount','discount','store_id','price','price_2','images','catalog_id', 'subcatalog_id', 'item_id', 'colors')
            ->where(function ($query) use ($item) {
                $query->where('item_id', $item->id);
                if($item->id == Item::DISCOUNT_ZONE_ID){
                    $query->orwhere('is_discount',true)->where('discount','>=',25);
                }
            });

        $this->productService->filter($productsQuery);
        $this->productService->search($productsQuery);
        $this->productService->sort($productsQuery);
        $products = $productsQuery->latest()
            ->orderBy('is_hot')
            ->with('store')
            ->paginate(15);

        $views = $this->productService->views();
        $likeIds = $this->service->likeIds();

        $banners = $this->bannerService->views(BannerType::ITEM)->where('item', $item->id);

        // $colours = Product::active()->where('item_id', $item->id)->whereJsonContains('colors', ['beige', 'brown'])->select('title')->get();
        //dd($countries,$count1,$productsQuery->count());
        return view('pages.catalogs.item_show', compact( 'item','products','stores','countries','maxPrice','minPrice','views','likeIds', 'colors', 'materials', 'banners'));
    }
}
