<?php

namespace App\Providers;

use App\Http\Services\BannerService;
use App\Models\Banner;
use App\Models\BannerType;
use App\Models\CustomerType;
use App\Models\Item;
use App\Models\Product;
use App\Models\ProductLike;
use App\Models\Subcatalog;
use App\Models\Catalog;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Articles\ArticlesRepository::class, function () {
            // Это полезно, если мы хотим выключить наш кластер
            // или при развертывании поиска на продакшене
            if (! config('services.search.enabled')) {
                return new Articles\EloquentRepository();
            }
            return new Articles\ElasticsearchRepository(
                $app->make(Client::class)
            );
        });
        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {

        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }

    public function getItemsByProductCount()
    {
        $item_id = Product::active()->select('id','item_id','title')->where('item_id','!=',Item::DISCOUNT_ZONE_ID)
            ->withCount('items')->orderBy('items_count', 'desc')->paginate(7)->pluck('item_id');
        return Item::whereIn('id', $item_id)->get();
    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        Response::macro('xmlProduct', function ($content) {

            $headers = [
                'Content-type'        => 'text/xml',
                'Content-Disposition' => 'attachment; filename="products.xml"',
            ];

            return Response::make($content, 200, $headers);

        });

        $menuCatalogs = Catalog::where('isActive',true)
            //->whereIn('id',$menuCatalogIds)
            ->select('id','is_menu','title','menu_title','slug','svg')
            ->orderBy('index')
            ->get();

        $menuItems = $this->getItemsByProductCount();

//        $menuItems = Item::where('isActive',true)
//            ->whereHas('subcatalog', function ($q) {
//                $q->where('isActive', true);
//                $q->whereHas('catalog', function ($q) {
//                    $q->where('isActive', true);
//                });
//            })
//            ->where('slug','!=',null)
//            //->whereHas('products')
//            ->select('id','is_menu','subcatalog_id','title','menu_title','slug')
//            ->orderBy('index')
//            ->get();

        $menuSubcatalogIds = $menuItems->pluck('subcatalog_id')->unique();
        $menuSubcatalogs = Subcatalog::where('isActive',true)
            ->whereHas('catalog', function ($q) {
                $q->where('isActive', true);
            })
            ->where('slug','!=',null)
            //->whereIn('id',$menuSubcatalogIds)
            ->select('id','catalog_id','title','slug')
            ->orderBy('index')
            ->get();
        $menuCatalogIds = $menuSubcatalogs->pluck('catalog_id')->unique();

        $menuDiscountZone = Item::where('id',Item::DISCOUNT_ZONE_ID)->select('id','slug','title')->first();



        $banner_top_discount_zone_id = Banner::DISCOUNT_ZONE_BANNER_ID;
        $banner_top_discount_zone_title = Banner::DISCOUNT_ZONE_BANNER_TITLE;

        $wideTopBanners = BannerService::views(BannerType::WIDE_TOP, 1);
        $customerTypes = CustomerType::where('status',1)->select('id','title_kz','title_ru')->get();
        View::share(['menuCatalogs'=>$menuCatalogs,
            'menuSubcatalogs'=>$menuSubcatalogs,
            'menuItems'=>$menuItems,
            'menuDiscountZone'=>$menuDiscountZone,
            'wideTopBanners' => $wideTopBanners,
            'banner_top_discount_zone_id'=>$banner_top_discount_zone_id,
            'banner_top_discount_zone_title'=>$banner_top_discount_zone_title,
            'customerTypes'=>$customerTypes
        ]);
    }
}
