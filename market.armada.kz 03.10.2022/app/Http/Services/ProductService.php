<?php

namespace App\Http\Services;

use App\Exports\ProductExport;
use App\Models\Catalog;
use App\Models\Color;
use App\Models\Country;
use App\Models\Discount;
use App\Models\Item;
use App\Models\PopularItem;
use App\Models\Presence;
use App\Models\Product;
use App\Models\ProductView;
use App\Models\Store;
use App\Models\Subcatalog;
use App\Models\Tarif;
use App\Models\TypeDelivery;
use App\Models\TypePay;
use App\Models\UserRole;
use Google\Cloud\Translate\V3\TranslationServiceClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Mtownsend\XmlToArray\XmlToArray;

class ProductService
{
    public function ifNotStore($stores)
    {
        if (Auth::user()->role_id != UserRole::ADMIN and ($stores == null or $stores->count() == 0)) {
            return redirect()->route('seller.stores.index')->with('error', 'У Вас ещё не создано ни одно магазина')->send();
        }
    }

    public function ifNotTarif($store_id)
    {

//        $store = Store::find($store_id);
//        $productCount = Product::where('store_id',$store->id)->count();
//        $tarif = Tarif::find($store->tarif_id);
//        $tarifCount = $tarif ? $tarif->limit_store_products : null;
//        if($tarifCount == null)
//        {
//            return redirect()
//                ->route('seller.products.index')
//                ->with('error','У Вашего магазина не установлен тарифный план. Пожалуйста, обратитесь к администратору')
//                ->send();
//            exit('123456');
//        }
//        if($productCount >= $tarifCount)
//        {
//            return redirect()
//                ->route('seller.products.index')
//                ->with('error','Ваш тариф не позволяет создавать больше товаров')
//                ->send();
//            exit('123456');
//        }
        $store = Store::find($store_id);
        $productCount = Product::where('store_id', $store->id)->where('item_id','!=',Item::DISCOUNT_ZONE_ID)->count();
        $tarif = Tarif::find($store->tarif_id);
        $tarifCount = $tarif ? $tarif->limit_store_products : null;


        $message = $tarifCount == null
            ? 'У Вашего магазина не установлен тарифный план. Пожалуйста, обратитесь к администратору'
            : ($productCount >= $tarifCount ? 'Ваш тариф не позволяет создавать больше товаров' : null);
        return $message;
    }

    public function filter($productsQuery)
    {

        if (isset($_GET['store'])) {
            if (is_array($_GET['store'])) {
                $store_ids = $_GET['store'];
            } else {
                $store_ids[] = $_GET['store'];
            }

            $productsQuery = $productsQuery->whereIn('store_id', $store_ids);

//            $productsQuery = $productsQuery->whereIn('store_id', $store_ids)
//                ->where(function ($query) {
//                    $query->where('item_id', '<=>', Item::DISCOUNT_ZONE_ID);
//                }, null, null, 'and not');
//
//
//            if (in_array(Store::DISCOUNT_ZONE_ID, $store_ids)) {
//                $productsQuery = $productsQuery->orWhere('item_id', '=', Item::DISCOUNT_ZONE_ID);
//            }

        }
        if (isset($_GET['country']) and $_GET['country'] != 'all') {

            $productsQuery = is_array($_GET['country'])
                ? $productsQuery->whereIn('country_id', $_GET['country'])
                : $productsQuery->where('country_id', $_GET['country']);
        }
        if (isset($_GET['item']) and $_GET['item'] != 'all') {
            if (is_array($_GET['item'])) {
                $item_ids = $_GET['item'];
            } else {
                $item_ids[] = $_GET['item'];
            }
            $productsQuery = $productsQuery->whereIn('item_id', $item_ids);
        }
        if (isset($_GET['price_min']) and is_numeric($_GET['price_min'])) {
            $productsQuery = $productsQuery->where('price', '>=', $_GET['price_min']);

        }
        if (isset($_GET['price_max']) and is_numeric($_GET['price_max'])) {
            $productsQuery = $productsQuery->where('price', '<=', $_GET['price_max']);
        }

        if (isset($_GET['color'])) {
            // if(is_array($_GET['color']))
            // {
            //     $colors = $_GET['color'];
            // }
            // else
            // {
            //     $colors[] = $_GET['color'];
            // }
            // $productsQuery = $productsQuery->when($colors, function($q) use($colors) {
            //     $q->whereJsonContains('colors',$colors);
            // });
            $productsQuery = is_array($_GET['color'])
                ? $productsQuery->whereJsonContains('colors', $_GET['color'])
                : $productsQuery->where('colors', $_GET['color']);
        }

        if (isset($_GET['material'])) {
            $productsQuery = is_array($_GET['material'])
                ? $productsQuery->whereIn('material', $_GET['material'])
                : $productsQuery->where('material', $_GET['material']);
        }

        return $productsQuery;
    }

    public function searchGetFilter($productsQuery)
    {
        return Product::select('id','title','images','slug','price','price_2','country_id','store_id','item_id','is_price_from','is_discount', 'discount')->where(function ($main_query) {
            $this->filter($main_query->orderBy('row', 'DESC'));
        })->from($productsQuery);
    }

    public function search($productsQuery)
    {
        if (isset($_GET['q']) and $_GET['q'] != null) {
            $productsQuery = $productsQuery->where('title', 'LIKE', '%' . $_GET['q'] . '%');
        }

        return $productsQuery;
    }

//    public function isGet($productsQuery)
//    {
//        if(isset($_GET['store']))
//        {
//            $storeId = Store::where('slug',$_GET['store'])
//                ->first();
//            $productsQuery = $storeId != null ? $productsQuery->where('store_id',$storeId) : $productsQuery;
//        }
//        if(isset($_GET['country']) and is_numeric($_GET['country']))
//        {
//            $productsQuery = $productsQuery->where('country_id',$_GET['country']);
//        }
//        if(isset($_GET['price_min']) and is_numeric($_GET['price_min']))
//        {
//            $productsQuery = $productsQuery->where('price','>=',$_GET['price_min']);
//        }
//        if(isset($_GET['price_min']) and is_numeric($_GET['price_min']))
//        {
//            $productsQuery = $productsQuery->where('price','<=',$_GET['price_max']);
//        }
//        return $productsQuery;
//    }

    public function sort($productsQuery)
    {
        if (isset($_GET['price'])) {
            if ($_GET['price'] == 'up') {
                $productsQuery = $productsQuery->orderBy('price', 'asc');
            }
            if ($_GET['price'] == 'down') {
                $productsQuery = $productsQuery->orderBy('price', 'desc');
            }
            if($_GET['price'] == 'discount'){
                $productsQuery = $productsQuery->orderByRaw("case when is_discount = '1' then 1 else 2 end");
            }
        }

        return $productsQuery;
    }

    public function views($productId = null)
    {
        if (Auth::check()) {
            $viewsQuery = ProductView::where('user_id', Auth::id())
                ->with('product.store');

            if ($productId != null) {
                $view = ProductView::firstOrNew(['user_id' => Auth::id(), 'product_id' => $productId]);
                $view->created_at = now();
                $view->save();
                $viewsQuery = $viewsQuery->where('product_id', '!=', $view->product_id);
            }




            $viewsQuery = $viewsQuery->whereRaw('DATE_ADD(created_at, INTERVAL 7 DAY) > now()')
                ->whereHas('product', function ($q) {
                $q->active();
            })->latest();

            ProductView::whereRaw('DATE_ADD(created_at, INTERVAL 7 DAY) < now()')
                ->select('id','user_id','product_id','created_at')->delete();

            $views = Route::is('user.*')
                ? $viewsQuery->paginate(12)
                : $viewsQuery->take(12)->get();
        } else {
            $views = collect();
//            if(Cache::has('productsViews'))
//            {
//                $productsId =  Cache::get('productsViews');
//            }
//
//            $productsId[] = $productId;
//
//            Cache::put('productsViews', $productsId, 3600);
//
//            if(count($productsId) > 1)
//            {
//                $productsId = array_diff($productsId, array('', NULL, false));
//                $views = Product::whereIn('id',$productsId)
//                    ->where('id','!=',$productId)
//                    ->latest()
//                    ->with('store')
//                    ->get();
//            }
//            else
//            {
//                $views = null;
//            }
        }

        return $views;
    }

    // GET_FOR
    public function getForIndex_products()
    {
        $productsQuery = Product::where('store_id', '!=', null)
            ->orderBy('created_at', 'desc')
            ->with('item', 'item.subcatalog', 'item.subcatalog.catalog', 'store')
            ->withCount('additional');

        if((isset($_GET['store']) or isset($_GET['item']))){
            if(isset($_GET['store']) and $_GET['store'] == Store::DISCOUNT_ZONE_ID){
                return  $this->filter($productsQuery)
                    ->orWhere('item_id', '=', Item::DISCOUNT_ZONE_ID)
                    ->orWhere('is_discount', true)->get();
            }
            return  $this->filter($productsQuery)->get();
        }

        return $productsQuery
            ->where('created_at', null)
            ->get();
    }

    public function getForIndex_allStores()
    {
        $storeIds = Product::orderBy('store_id')
            ->pluck('store_id')
            ->unique();
        $stores = Store::whereIn('id', $storeIds)
            ->select('id', 'title')
            ->orderBy('title')
            ->withCount('products')
            ->get();
        return $stores;
    }

//    public function getForIndex_allCatalogs()
//    {
//        $catalogs = Catalog::select('id','title')
//            ->orderBy('title')
//            ->get();
//        return $catalogs;
//    }
//
//    public function getForIndex_allSubcatalogs()
//    {
//        $subcatalogs = Subcatalog::select('id','catalog_id','title')
//            ->orderBy('title')
//            ->get();
//        return $subcatalogs;
//    }

    public function getForIndex_allItems()
    {
        $items = Item::select('id', 'subcatalog_id', 'title')
            ->orderBy('title')
            ->with('subcatalog:id,catalog_id,title', 'subcatalog.catalog:id,title',)
            ->get();
        return $items;
    }

    public function getForIndex_allCountries()
    {
        $countriesId = Product::where('country_id', '!=', null)
            ->pluck('country_id')
            ->unique();
        $countries = Country::whereIn('id', $countriesId)
            ->select('id', 'title_ru')
            ->orderBy('title_ru')
            ->get();
        return $countries;
    }

    public function getForCredit_stores()
    {
        $storesQuery = Store::orderBy('title')
            ->select('id', 'title', 'isPaid');
        $storesQuery = (Auth::user()->role_id == UserRole::ADMIN and Route::is('admin.*'))
            ? $storesQuery
            : $storesQuery->where('user_id', Auth::id());
        $stores = $storesQuery->get();
        return $stores;
    }

    public function getForCredit_items()
    {
        $items = Item::select('id', 'title', 'subcatalog_id')
            ->orderBy('title')->where('isActive', 1)
            ->get();
        return $items;
    }

    public function getForCredit_item_by_id($id)
    {
        $item = Item::select('id', 'title', 'subcatalog_id')
            ->orderBy('title')->where('isActive', 1)->where('id', $id)
            ->get();
        return $item;
    }

    public function getForCredit_subcatalogs($items)
    {
        $subcatalogs = Subcatalog::whereIn('id', $items->pluck('subcatalog_id')->unique())
            ->orderBy('title')
            ->select('id', 'catalog_id', 'title')
            ->with('catalog:title')
            ->where('isActive', 1)
            ->get();
        return $subcatalogs;
    }

    public function getForCredit_catalogs($subcatalogs)
    {
        $catalogs = Catalog::whereIn('id', $subcatalogs->pluck('catalog_id')->unique())
            ->where('isActive', 1)
            ->orderBy('title')
            ->select('id', 'title', 'onlyAdmins')
            ->get();
        return $catalogs;
    }

    public function getForCredit_countries()
    {
        $countries = Country::where('isActive', 1)
            ->orderBy('title_ru')
            ->select('id', 'title_ru')
            ->get();
        return $countries;
    }

    public function getForCredit_colors()
    {
        $colors = Color::all();
        return $colors;
    }

    public function getForCredit_presences()
    {
        $presences = Presence::where('is_active', true)
            ->get();
        return $presences;
    }

    public function getForCredit_discounts()
    {
        $discounts = Discount::get();
        return $discounts;
    }

    public function getForCredit_deliveries()
    {
        $deliveries = TypeDelivery::isActive()
            ->select('id', 'title')
            ->get();
        return $deliveries;
    }

    public function getForCredit_pays()
    {
        $pays = TypePay::isActive()
            ->select('id', 'title')
            ->get();
        return $pays;
    }

    public function recommends()
    {
        $hotStoreIds = Store::where('status', true)
            ->where('hot', true)
            ->where('hot_end_date', '>', now())
            ->pluck('id');
        $recommends = Product::active()
            ->where(function ($q) use ($hotStoreIds) {
                $q->whereIn('store_id', $hotStoreIds)
                    ->orwhere('is_hot', true);
            })
            ->inRandomOrder()
            ->select('id', 'store_id', 'item_id', 'slug', 'title', 'price', 'price_2', 'articul', 'images','discount','is_discount')
            ->take(10)
            ->with('store:id,title,slug,is_Armada,address,location,block,intersection,butik')
            ->get();
        return $recommends;
    }

    public function specials()
    {
        $specials = Product::active()
            ->inRandomOrder()
            ->where('discount', '!=', null)
            ->where('is_discount', '!=', 0)
            ->select('id', 'store_id', 'item_id', 'slug', 'title', 'price', 'price_2', 'articul', 'images', 'discount','is_discount')
            ->take(10)
            ->with('store:id,title,slug,is_Armada,address,location,block,intersection,butik')
            ->get();
        return $specials;
    }

    public function recents()
    {
        $recents = Product::active()
            ->select('id', 'store_id', 'item_id', 'slug', 'title', 'price', 'price_2', 'articul', 'images','discount','is_discount')
            ->latest()
            ->take(10)
            ->with('store:id,title,slug,is_Armada,address,location,block,intersection,butik')
            ->get();
        return $recents;
    }

    public function populars()
    {
//        $populars = PopularItem::where('model', '!=', null)
//            ->where('title', '!=', null)
//            ->where('slug', '!=', null)
//            ->where('images', '!=', null)
//            ->select('model', 'title', 'slug', 'images')
//            ->inRandomOrder()
//            ->take(18)
//            ->get();
        $subCatalog_popular = Subcatalog::where('is_popular','=',true)->select('id','title', 'slug', 'images')->get();
        $catalog_popular = Catalog::where('is_popular','=',true)->select('id','title', 'slug', 'images')->get();
        $item_popular = Item::where('is_popular','=',true)->select('id','title', 'slug', 'images')->get();
        return array('catalogs'=>$catalog_popular,'sub_catalogs'=>$subCatalog_popular,'items'=>$item_popular);
    }

    public function replaceQuotation($data)
    {
        $data->title = str_replace('"', '&quot', $data->title);
        return $data;
    }

    public function removeQuotation($title)
    {
        if (str_contains($title, '"')) {
            return str_replace('"', '', $title);
        }
        if (str_contains($title, '&quot')) {
            return str_replace('&quot', '', $title);
        }
        return $title;


    }

    public function replaceWithOldData($data)
    {
        $old_product_data = DB::table('products')->where('id', $data->id)->first();
        $formatted_data = $this->removeQuotation($data->title);

        if (isset($old_product_data)) {
            $formatted_old_data = $this->removeQuotation($old_product_data->title);

            if (str_contains($formatted_old_data, $formatted_data)) {
                if ($data->pay_ids == null) {
                    $data->pay_ids = json_decode($old_product_data->pay_ids);
                }
                if ($data->delivery_ids == null) {
                    $data->delivery_ids = json_decode($old_product_data->delivery_ids);
                }
                if ($data->articul == null) {
                    $data->articul = $old_product_data->articul;
                }
                if ($data->country_id == null) {
                    $data->country_id = $old_product_data->country_id;
                }
                if ($data->material == null) {
                    $data->material = $old_product_data->material;
                }
                if ($data->width == null) {
                    $data->width = $old_product_data->width;
                }
                if ($data->height == null) {
                    $data->height = $old_product_data->height;
                }
                if ($data->depth == null) {
                    $data->depth = $old_product_data->depth;
                }
            }
        }


        return $data;
    }

    public function isProductInDiscountZone($id): bool
    {
        $data = Product::findOrFail($id);
        if ($data->item_id == Item::DISCOUNT_ZONE_ID) {
            return true;
        }
        return false;
    }

    public function importDeliveryNameToId($delivery): array
    {
        $delivery_ids = array();
        $delivery_active_ids = TypeDelivery::select('id')->whereIn('title',$delivery)->where('isActive','=',true)->get();;
        foreach ($delivery_active_ids as $active_id){
            array_push($delivery_ids,strval($active_id->id));
        }

        return $delivery_ids;
    }

    public function importPaymentNameToId($payment): array
    {
        $payment_ids = array();
        $payment_active_ids = TypePay::select('id')->whereIn('title',$payment)->where('isActive','=',true)->get();;
        foreach ($payment_active_ids as $active_id){
            array_push($payment_ids,strval($active_id->id));
        }

        return $payment_ids;
    }

    public function importCountryToId($country): string
    {
        $country_active_ids = Country::select('id')->where('title_ru','=',$country)->where('isActive','=',true)->first();
        return $country_active_ids->id ?? '';
    }
    public function importPresenceToId($presence): string
    {
        $presence_active_id = Presence::select('id')->where('title','=',$presence)->where('is_active','=',true)->first();
        return $presence_active_id->id ?? '';
    }

    public function importItemAndCatalog($item)
    {
        $item_subCatalog_catalog = array();
        $item_id = Item::select('id', 'subcatalog_id')->where('isActive', 1)->where('title', '=',$item)
            ->get();
        $subcatolog = $this->getForCredit_subcatalogs($item_id);
        $catalog = $this->getForCredit_catalogs($subcatolog);

        $item_subCatalog_catalog['item_id'] = $item_id[0]->id ?? '';
        $item_subCatalog_catalog['sub_catalog_id'] = $subcatolog[0]->id ?? '';
        $item_subCatalog_catalog['catalog_id'] = $catalog[0]->id ?? '';


        return $item_subCatalog_catalog;
    }
    public function jsonListToId($json){
        $json_convert =  json_decode($json);

    }

    public function export_delivery($delivery_ids): string
    {
        $data_arr = array();
        if(isset($delivery_ids)){
            $delivery_ids_query = TypeDelivery::select('title')->whereIn('id',$delivery_ids)->get();

            foreach ($delivery_ids_query as $delivery){
                array_push($data_arr, $delivery->title);
            }

        }

        return implode(',', $data_arr);


    }

    public function export_payment($payment_ids): string
    {
        $data_arr = array();
        if(isset($payment_ids)) {
            $payment_ids_query = TypePay::select('title')->whereIn('id', $payment_ids)->get();

            foreach ($payment_ids_query as $payment) {
                array_push($data_arr, $payment->title);
            }
        }
        return implode(',', $data_arr);
    }

    public function convertToBoolean($value): bool
    {
        if($value == 'Да'){
            return true;
        }elseif ($value == 'Нет'){
            return false;
        }else{
            return false;
        }
    }



    public function checkItemIdValid($product,$store_id)
    {

        if (isset($product->item_id) && isset($product->subcatalog_id)) {
//            $item = Item::select('id', 'title', 'subcatalog_id')->where('id', '=', $product->item_id)->first();
            $sub_catalog = Subcatalog::select('id', 'title', 'catalog_id')->where('id', '=', $product->subcatalog_id)->first();
            $catalog = Catalog::select('id', 'title')->where('id', '=', $product->catalog_id)->first();

            if(!$catalog->subcatalogs->contains('id',$product->subcatalog_id) && !$sub_catalog->items->contains('id',$product->item_id)){
                if($catalog->id == 9 && $product->subcatalog_id == 35){
                    Product::where('store_id','=',$store_id)->where('subcatalog_id','=',$product->subcatalog_id)
                        ->where('catalog_id','=',$catalog->id)
                        ->update(['catalog_id'=>$product->subcatalog->catalog->id,'item_id'=>213]);
                }
            }
            if($catalog->subcatalogs->contains('id',$product->subcatalog_id) && !$sub_catalog->items->contains('id',$product->item_id)){
                $rand_index = rand(0,count((array)$sub_catalog->items));
                Product::where('store_id','=',$store_id)->where('subcatalog_id','=',$product->subcatalog_id)
                    ->where('catalog_id','=',$catalog->id)->update(['item_id'=>$sub_catalog->items[$rand_index]->id]);
            }
        }
        if (isset($product->subcatalog_id) && isset($product->catalog_id) && !isset($product->item_id)) {
            $sub_catalog = Subcatalog::select('id', 'title', 'catalog_id')->where('id', '=', $product->subcatalog_id)->first();
            $catalog = Catalog::select('id', 'title')->where('id', '=', $product->catalog_id)->first();

            if ($catalog->subcatalogs->contains('id', $product->subcatalog_id)) {
                $rand_index = rand(0,count((array)$sub_catalog->items));
                Product::where('store_id', '=', $store_id)->where('subcatalog_id', '=', $sub_catalog->id)
                    ->where('catalog_id', '=', $catalog->id)->update(['item_id' => $sub_catalog->items[$rand_index]->id]);
            }

        }

    }

    public function fixItemOfSubCatlog($product_id){
        $swim_subCatalog_id = 37;
        $swim_items = Item::select('id','title')->where('subcatalog_id','=',$swim_subCatalog_id)->get();
        $rand_index = rand(0,count($swim_items)-1);
        Product::where('id','=',$product_id)->update(['item_id'=>$swim_items[$rand_index]->id]);

    }

    private function googleTranslate($text){
        $content = array($text);
        putenv('GOOGLE_APPLICATION_CREDENTIALS='.base_path().'\armada-auth-338108-6e7f443ce229.json');
        $translationServiceClient = new TranslationServiceClient(['keyFile'=>json_decode(file_get_contents(base_path()."\armada-auth-338108-6e7f443ce229.json"))]);

        try {

            $targetLanguageCode = 'kk';
            $formattedParent = $translationServiceClient->locationName('armada-auth-338108', 'us-central1');
            $result = $translationServiceClient->translateText($content,$targetLanguageCode,$formattedParent,['sourceLanguageCode'=>'ru']);

            return(json_decode($result->serializeToJsonString())->translations[0]->translatedText);

        }
        finally {
            $translationServiceClient->close();
        }

    }

    public function translateToKazakh($product){

        $title_translate = '';
        $description_translate = '';
        $manufacture_translate = '';
        $seo_title_translate = '';
        $meta_description_translate = '';
        $meta_tags_translate = '';
        if(isset($product->title) && $product->title != null){
            $title_translate = $this->googleTranslate($product->title) ?? '';
        }
        if(isset($product->description) && $product->description != null){
            $description_translate = $this->googleTranslate($product->description) ?? '';
        }
        if(isset($product->manufacture) && $product->manufacture != null){

            $manufacture_translate = $this->googleTranslate($product->manufacture) ?? '';
        }
        if(isset($product->seo_title) && $product->seo_title != null){
            $seo_title_translate = $this->googleTranslate($product->seo_title) ?? '';
        }
        if(isset($product->meta_description) && $product->meta_description != null){
            $meta_description_translate = $this->googleTranslate($product->meta_description) ?? '';
        }
        if(isset($product->meta_tags) && $product->meta_tags != null){
            $meta_tags_translate = $this->googleTranslate($product->meta_tags) ?? '';
        }


        return [
            'product_id' => $product->id, 'locale' => 'kz',
            'title' => $title_translate, 'description' => $description_translate,
            'manufacture'=>$manufacture_translate,'seo_title'=>$seo_title_translate,
            'meta_description'=>$meta_description_translate,'meta_tags'=>$meta_tags_translate,
        ];

    }

    /*public function translateToKazakh($product){

        $title_translate = '';
        $description_translate = '';
        $manufacture_translate = '';
        $seo_title_translate = '';
        $meta_description_translate = '';
        $meta_tags_translate = '';
        if(isset($product->title) && $product->title != null){
            $title_translate_http = Http::get('https://translate.yandex.net/api/v1.5/tr.json/translate', [
                'key' => env('YANDEX_API_KEY'),
                'text' => $product->title,
                'lang' => 'ru-kk',
                'format' => 'plain'
            ]);
            $title_translate = $title_translate_http->json()['text'][0] ?? '';

        }
        if(isset($product->description) && $product->description != null){

            $description_translate_http = Http::get('https://translate.yandex.net/api/v1.5/tr.json/translate', [
                'key' => env('YANDEX_API_KEY'),
                'text' => $product->description,
                'lang' => 'ru-kk',
                'format' => 'plain'
            ]);
            $description_translate = $description_translate_http->json()['text'][0] ?? '';
        }
        if(isset($product->manufacture) && $product->manufacture != null){
            $manufacture_translate_http = Http::get('https://translate.yandex.net/api/v1.5/tr.json/translate', [
                'key' => env('YANDEX_API_KEY'),
                'text' => $product->manufacture,
                'lang' => 'ru-kk',
                'format' => 'plain'
            ]);
            $manufacture_translate = $manufacture_translate_http->json()['text'][0] ?? '';
        }
        if(isset($product->seo_title) && $product->seo_title != null){
            $seo_title_translate_http = Http::get('https://translate.yandex.net/api/v1.5/tr.json/translate', [
                'key' => env('YANDEX_API_KEY'),
                'text' => $product->seo_title,
                'lang' => 'ru-kk',
                'format' => 'plain'
            ]);
            $seo_title_translate = $seo_title_translate_http->json()['text'][0];
        }
        if(isset($product->meta_description) && $product->meta_description != null){
            $meta_description_translate_http = Http::get('https://translate.yandex.net/api/v1.5/tr.json/translate', [
                'key' => env('YANDEX_API_KEY'),
                'text' => $product->meta_description,
                'lang' => 'ru-kk',
                'format' => 'plain'
            ]);
            $meta_description_translate = $meta_description_translate_http->json()['text'][0] ?? '';

        }
        if(isset($product->meta_tags) && $product->meta_tags != null){
            $meta_tags_translate_http = Http::get('https://translate.yandex.net/api/v1.5/tr.json/translate', [
                'key' => env('YANDEX_API_KEY'),
                'text' => $product->meta_tags,
                'lang' => 'ru-kk',
                'format' => 'plain'
            ]);
            $meta_tags_translate = $meta_tags_translate_http->json()['text'][0] ?? '';

        }



        return [
            'product_id' => $product->id, 'locale' => 'kz',
            'title' => $title_translate, 'description' => $description_translate,
            'manufacture'=>$manufacture_translate,'seo_title'=>$seo_title_translate,
            'meta_description'=>$meta_description_translate,'meta_tags'=>$meta_tags_translate,
        ];

    }*/

    public function updateIfPriceTypeChanges($data){
        if($data->is_price_none == true){
            $data->price = 0;
        }
    }

    public function handleImportedImage($images){
        return json_encode($images);
    }

    private function XmlGetData($store_id)
    {
        $storeIds = array();
        if(isset($store_id)){
            array_push($storeIds,$store_id);
        }else{
            $storeIds = Store::where('user_id',Auth::id())
                ->pluck('id');
        }


        $productsQuery = Product::whereIn('store_id',$storeIds);

        $products = $productsQuery->select('id','manufacture','country_id','width','height','depth','colors','pay_ids',
            'is_delivery','delivery_ids','seo_title','meta_description','meta_tags','isActive','title','status',
            'user_id','item_id','articul','store_id','images','price','price_2','stock','created_at','updated_at',
            'description')
            ->with('store')
            ->get();

        return $products;
    }

    public function exportDataXmlDom($export_store_id){
        $data=$this->XmlGetData($export_store_id);
        $dom = new \DOMDocument();
        $dom->encoding = 'utf-8';
        $dom->xmlVersion = '1.0';
        $dom->formatOutput = true;
        $root = $dom->createElement('products');
        foreach ($data as $item)
        {
            $product_node = $dom->createElement('product');

//                $child_node_id = $dom->createElement('id', $item->id);
//                $product_node->appendChild($child_node_id);

            //     $product_node->appendChild($attr_product_id);
            $child_node_title = $dom->createElement('Title', $item->title);
            $product_node->appendChild($child_node_title);
            $child_node_isActive = $dom->createElement('IsActive', $item->isActive);
            $product_node->appendChild($child_node_isActive);
            //status
            $child_node_status = $dom->createElement('productstatus', $item->status);
            $product_node->appendChild($child_node_status);

            //end
            //user_id
            $child_node_userId = $dom->createElement('userId', $item->user_id);
            $product_node->appendChild($child_node_userId);

            //end
            //item id
            $child_node_itemId = $dom->createElement('itemId', $item->item_id);
            $product_node->appendChild($child_node_itemId);

            //end
            //articul
            $child_node_sku = $dom->createElement('sku', $item->articul);
            $product_node->appendChild($child_node_sku);

            //end
            //store_id
            $child_node_storeId = $dom->createElement('storeId', $item->store_id);
            $product_node->appendChild($child_node_storeId);

            //end
            //images
            $images=array();
            $images=$item->images;
            //dd($images);
            if (is_array($images))
            {
                //dd('images');
                foreach ($images as $image) {
                    if (!is_array($image)) {

                        // dd($image);
                        $child_node_image = $dom->createElement('image', $image);
                        $product_node->appendChild($child_node_image);
                    }
                    else
                    {
                        //  dd($image);
                        foreach ($image as $img)
                        {
                            $child_node_image = $dom->createElement('image', $img);
                            $product_node->appendChild($child_node_image);
                        }
                    }

                }
            }

            //end
            //price
            $child_node_price = $dom->createElement('price', $item->price);
            $product_node->appendChild($child_node_price);

            //end

            //price2
            $child_node_price2 = $dom->createElement('price2', $item->price_2);
            $product_node->appendChild($child_node_price2);

            //end
            //stock
            $child_node_stock = $dom->createElement('stock', $item->stock);
            $product_node->appendChild($child_node_stock);

            //end
            //createdAt
            $child_node_createdAt = $dom->createElement('createdAt', $item->created_at);
            $product_node->appendChild($child_node_createdAt);

            //end

            //updatedAt
            $child_node_updateddAt = $dom->createElement('updateddAt', $item->updated_at);
            $product_node->appendChild($child_node_updateddAt);

            //end
            //description
            $child_node_description = $dom->createElement('description', htmlentities($item->description, ENT_XML1));
            $product_node->appendChild($child_node_description);

            //end
            //country_id
            $child_node_countryId = $dom->createElement('countryId', $item->country_id);
            $product_node->appendChild($child_node_countryId);

            //end
            //manufacture
            $child_node_manufacture = $dom->createElement('manufacturer', $item->manufacture);
            $product_node->appendChild($child_node_manufacture);

            //end
            //width
            $child_node_width = $dom->createElement('width', $item->width);
            $product_node->appendChild($child_node_width);

            //end
            //height
            $child_node_height = $dom->createElement('height', $item->height);
            $product_node->appendChild($child_node_height);

            //end
            //depth
            $child_node_depth = $dom->createElement('depth', $item->depth);
            $product_node->appendChild($child_node_depth);

            //end
            //colors
            if (is_array($item->colors))
            {
                foreach ($item->colors as $color)
                {
                    //echo $image;
                    if (!is_array($color)) {

                        // dd($image);
                        $child_node_color = $dom->createElement('color', $color);
                        $product_node->appendChild($child_node_color);
                    }
                    else
                    {
                        // dd($color);
                        foreach ($color as $col)
                        {
                            $child_node_color = $dom->createElement('color', $col);
                            $product_node->appendChild($child_node_color);
                        }
                    }

                }
            }
            //end
            //is delivery
            $child_node_isDelivery = $dom->createElement('isDelivery', $item->is_delivery);
            $product_node->appendChild($child_node_isDelivery);

            //end
            //delivery_type
            if (is_array($item->delivery_ids))
            {
                foreach ($item->delivery_ids as $delivery)
                {
                    //echo $image;
                    if (!is_array($delivery)) {

                        // dd($image);
                        $child_node_deliveryType = $dom->createElement('deliveryType', $delivery);
                        $product_node->appendChild($child_node_deliveryType);
                    }
                    else
                    {
                        //dd($delivery);
                        foreach ($delivery as $del)
                        {
                            $child_node_deliveryType = $dom->createElement('deliveryType', $del);
                            $product_node->appendChild($child_node_deliveryType);
                        }
                    }

                }
            }
            //end
            //seo_title
            $child_node_seoTitle = $dom->createElement('seoTitle', $item->seo_title);
            $product_node->appendChild($child_node_seoTitle);

            //end
            //meta_description
            $child_node_metaDescription = $dom->createElement('metaDescription', $item->meta_description);
            $product_node->appendChild($child_node_metaDescription);

            //end
            //meta_tags
            $child_node_metaTags = $dom->createElement('metaTags', $item->meta_tags);
            $product_node->appendChild($child_node_metaTags);

            //end
            // print_r($item->title);
            $root->appendChild($product_node);
        }
        $dom->appendChild($root);
        return $dom;
    }

    public function Importxml($path,$import_store_id)
    {
        $storeIds = Store::where('user_id',Auth::id())
            ->get('id')->toArray();
        $ids=array();

        foreach ($storeIds as $id)
        {
            $ids[]=$id['id'];
        }
        // dd($ids);
        $xml=file_get_contents($path);
        $data = XmlToArray::convert($xml);
        $images=array();
        $product=new Product();
//        dd($data);
        if(count($data['product'])>1){
            for ($i=0; $i<count($data['product']); $i++) {
                // $product = Product::updateOrInsert(array('id' => $data['product'][$i]['id'],'title'=>$data['product'][$i]['Title']));

                $product->title = $data['product'][$i]['Title'];
                if($data['product'][$i]['IsActive']!='0' && $data['product'][$i]['IsActive']!='1')
                {
                    // dd($data['product'][$i]['IsActive']);
                    die('Не верно указано значение IsActive у продукта с идентификатором'.$data['product'][$i]['id']);
                }

                $product->isActive = $data['product'][$i]['IsActive'];
                if($data['product'][$i]['status']='0' && $data['product'][$i]['status']!='1')
                {
                    // dd($data['product'][$i]['IsActive']);
                    die('Не верно указано значение status у продукта с идентификатором'.$data['product'][$i]['id']);

                }

                $product->status = $data['product'][$i]['status'];
                //  dd($data['product'][$i]['productstatus']);
//                if ($data['product'][$i]['userId'] == '0') {
//                    $userId = Auth::id();
//                } else {
//                    $userId = $data['product'][$i]['userId'];
//
//                }

                if ($data['product'][$i]['itemId'] != null) {
                    $itemId = $data['product'][$i]['itemId'];
                } else {
                    die("Не верно указан ItemID у продукта с идентификатором".$data['product'][$i]['id']);
                }

                if($data['product'][$i]['sku']==null)
                {
                    die('Не верно указано значение sku у продукта с идентификатором'.$data['product'][$i]['id']);

                }
                $sku = $data['product'][$i]['sku'];
                //dd($sku);


                // dd($ids);

                if(count($ids) > 0){
                    if (!in_array($data['product'][$i]['storeId'],$ids)){

                        // dd($storeIds);
                        //   dd($stores);
                        die('Не верно указано значение StoreId у продукта с идентификатором' .  $data['product'][$i]['id'] ?? '');
                    }
                }



                //  dd($data['product'][$i]['storeId']);

                $store_id =  $import_store_id;
                //  $product->images  = $data['product'][$i]['image'];
                // $img=json_encode($data['product'][$i]['image']);
                //dd($img);
                //$product->images = $img;


                if (isset($data['product'][$i]['image'])) {
//		$counter=count($data['product'][$i]['image']);
                    //dd($counter);
                    if(is_array($data['product'][$i]['image']))
                    {
                        $images= $data['product'][$i]['image'];
                    }
                    else
                    {
                        $images[]= $data['product'][$i]['image'];

                    }


                }

                $price = $data['product'][$i]['price'];
                if ($data['product'][$i]['price2'] != null) {
                    $price2 = $data['product'][$i]['price2'];
                }
                else
                {
                    $price2=0;
                }
                if ($data['product'][$i]['stock'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['stock'])) {
                        //dd($stock);
                        $stock = $data['product'][$i]['stock'];

                    }
                    else
                    {
                        die('Не верно указано значение stock у продукта с идентификатором'.$data['product'][$i]['id']);
                    }

                }
                else
                {
                    $stock=0;
                }
                //dd($data['product'][$i]['description']);
                if ($data['product'][$i]['description']!=null) {
                    $description = $data['product'][$i]['description'];
                    // dd($description);

                }
                else
                {
                    $description='';
                }
                if ($data['product'][$i]['countryId'] != null) {

                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['countryId'])) {

                        $country = $data['product'][$i]['countryId'];
                        //dd($country);
                    }
                    else
                    {
                        die('Не верно указано значение country_id у продукта с идентификатором'.$data['product'][$i]['id']);

                    }
                }

                else
                {
                    $country=0;
                }
                if ($data['product'][$i]['manufacturer'] != null) {


                    $manufacturer = $data['product'][$i]['manufacturer'] ?? '';

                }

                if ($data['product'][$i]['width'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['width'])) {
                        $width = $data['product'][$i]['width'];
                    }
                    else
                    {
                        die('Не верно указано значение productWidth у продукта с идентификатором'.$data['product'][$i]['id']);
                    }
                }
                if ($data['product'][$i]['height'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['height'])) {
                        $height=$data['product'][$i]['height'];
                    }
                    else
                    {
                        die('Не верно указано значение productHeight у продукта с идентификатором'.$data['product'][$i]['id']);
                    }
                }

                if ($data['product'][$i]['depth'] != null) {
                    if (preg_match('/^[0-9]+$/', $data['product'][$i]['depth'])) {

                        $depth=$data['product'][$i]['depth'];
                    }
                    else
                    {
                        die('Не верно указано значение productDepth у продукта с идентификатором'.$data['product'][$i]['id']);
                    }
                }

                if (isset($data['product'][$i]['color'])) {

                    $colors[] = $data['product'][$i]['color'];
                }
                else
                {
                    $colors=null;
                }
                if ($data['product'][$i]['isDelivery']!=null) {
                    if($data['product'][$i]['isDelivery']!='0' && $data['product'][$i]['isDelivery']!='1')
                    {
                        // dd($data['product'][$i]['isDelivery']);
                        die('Не верно указано значение isDelivery у продукта с идентификатором'.$data['product'][$i]['id']);
                    }

                    $isDelivery = $data['product'][$i]['isDelivery'];
                }
                if (isset($data['product'][$i]['deliveryType'])) {

                    $deliveryType[] = $data['product'][$i]['deliveryType'];
                }else{
                    $deliveryType[] = null;
                }

                if ($data['product'][$i]['seoTitle']!=null) {

                    $seoTitle = $data['product'][$i]['seoTitle'];
                }
                if ($data['product'][$i]['metaDescription']!=null) {

                    $metaDescription = $data['product'][$i]['metaDescription'];

                }
                if ($data['product'][$i]['metaTags']!=null) {

                    $metaTags = $data['product'][$i]['metaTags'];

                }

                // $product = Product::updateOrInsert(array('id' => $data['product'][$i]['id']));
                //dd($data['product'][$i]);
                //dd($data['product'][$i]['Title']);
                $product = new Product();
                //dd($images);

                $product->title=$data['product'][$i]['Title'];
                $product->isActive=$data['product'][$i]['IsActive'];
                $product->status=$data['product'][$i]['productstatus'];
                $product->item_id=$itemId;
                $product->store_id=$store_id;

//                $product->images=$images;
                $product->price=$price;
                $product->price_2=$price2;
                $product->stock=$stock;
                $product->description=$description;
                $product->country_id=$country;
                $product->manufacture=$manufacturer ?? '';
                $product->width=$width ?? '';
                $product->height=$height ?? '';
                $product->depth=$depth ?? '';
                $product->is_delivery=$isDelivery;
                $product->delivery_ids=$deliveryType[0];
                $product->seo_title=$seoTitle ?? '';
                $product->meta_description=$metaDescription ?? '';
                $product->meta_tags=$metaTags ?? '';
                $product->articul=$sku;
                $product->colors=$colors;


                $product->save();

                //добавить
                unset($images);
                unset($colors);
                unset($deliveryType);
            }
        }


    }

//    public function createWithImage()



}
