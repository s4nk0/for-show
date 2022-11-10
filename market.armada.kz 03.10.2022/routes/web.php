<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pages\OrderController;
use App\Http\Services\ProductService;
use App\Models\CustomerType;
use App\Models\Map;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\User;
use App\Models\UserRole;
use Elasticsearch\ClientBuilder;
use App\Repositories\ElasticsearchProductRepository;
use App\Repositories\ElasticsearchStoreRepository;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Pages\FaqController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Pages\NewsController;
use App\Http\Controllers\Pages\ShopController;
use App\Http\Controllers\Pages\TourController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Pages\AboutController;
use App\Http\Controllers\Pages\SchemeController;
use App\Http\Controllers\Pages\TenantController;
use App\Http\Controllers\Pages\CatalogController;
use App\Http\Controllers\Pages\ContactController;
use App\Http\Controllers\Pages\PaymentController;
use App\Http\Controllers\Pages\ProductController;
use App\Http\Controllers\Pages\ProjectController;
use App\Http\Controllers\Pages\ServiceController;
use App\Http\Controllers\Pages\DeliveryController;
use App\Http\Controllers\Pages\HowToBuyController;
use App\Http\Controllers\Pages\IdeaCareController;
use App\Http\Controllers\Pages\ForSellerController;
use App\Http\Controllers\Pages\AdvertiserController;
use App\Http\Controllers\TestSMSController;
use App\Http\Controllers\Pages\FurnitureCareController;
use App\Http\Controllers\TestEmailController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

use App\Mail\TestMails;


// ,'middleware' => 'throttle:10|60,1'
require('_seller.php');
require ('_designer.php');
require('_admin.php');
Route::view('/business', 'pages.landing_page.index');
Route::group(['prefix' => App\Http\Middleware\Locale::getLocale(),
    'middleware'=>'locale'],// максимум 10 запросов в минуту для гостей и 60 для пользователей
    function () {

        Auth::routes();

        require('_auth.php');
        require('_user.php');

//        require('_general.php');

        Route::get('setlocale/{lang}', function ($lang) {

            $referer = Redirect::back()->getTargetUrl();

            $parse_url = parse_url($referer, PHP_URL_PATH);
            $segments = explode('/', $parse_url);

            if (count($segments) > 1 and in_array($segments[1], App\Http\Middleware\Locale::$languages)) {
                unset($segments[1]);
            }
            if ($lang != App\Http\Middleware\Locale::$mainLanguage){
                array_splice($segments, 1, 0, $lang);
            }
            $app_url = env('APP_URL');
            if(substr($app_url, -1) == '/'){
                $app_url = substr($app_url, 0, -1);
            }

            $url = $app_url.implode("/", $segments);

            return redirect($url);

        })->name('setlocale');

        Route::get('/localization-translate',[ProductController::class,'translateProduct']);

        Route::get('/get-map-store', [SchemeController::class, 'getStoreByPolygonId'])->name('get-store-by-polygonId');

        Route::get('/auth/google/redirect', function () {
            return Socialite::driver('google')->redirect();
        })->name('googleLogin');

        Route::get('/login/google/callback', [LoginController::class,'handleProviderGoogleCallback']);


        Route::get('/login/facebook/redirect', function () {
            return Socialite::driver('facebook')->redirect();
        })->name('facebookLogin');

        Route::get('/login/facebook/callback', [LoginController::class,'handleProviderFacebookCallback']);
        Route::post('/login/phone',[LoginController::class,'loginOTP'])->name('loginOTP');
//        Route::post('/payment',[NewsCommentController::class,'store'])
//            ->name('newsComments.store'); // ?????

        Route::get('test', function () {
            return 'Test';
        });

        Route::view('/clear','clear');
        Route::get('/pay',[IndexController::class,'pay'])
            ->name('pay');
        Route::post('/pay-ok',[IndexController::class,'payOk'])
            ->name('payOk');
        Route::post('/pay-error',[IndexController::class,'payError'])
            ->name('payError');

        Route::post('/subscription',[IndexController::class,'subscription'])
            ->name('subscription');

        Route::get('/catalogs/{slug}',[CatalogController::class,'index'])
            ->name('catalogs');
//        Route::get('/catalog/{slug}',[CatalogController::class,'show'])
//            ->name('catalog');
        Route::get('/catalog/{slug}',[CatalogController::class,'subcatalogShow'])
            ->name('subcatalog');
        Route::get('/item/{slug}',[CatalogController::class,'itemShow'])
            ->name('item');

        Route::get('/product/{id}-{slug}',[ProductController::class,'product'])
            ->name('product');
        Route::post('/product-like',[ProductController::class,'productLike'])
            ->name('productLike');
        Route::post('/product-review',[ProductController::class,'productReview'])
            ->name('productReview');

        Route::get('/',[HomeController::class,'home'])
            ->name('home');
        Route::get('/banner',[IndexController::class,'banner'])
            ->name('banner');
        Route::post('/callback',[IndexController::class,'callback'])
            ->name('callback');
        Route::get('/search',[IndexController::class,'searchGet'])
            ->name('searchGet');
        Route::post('/search',[IndexController::class,'search'])
            ->name('search');
        Route::post('/search-store',[IndexController::class,'searchStore'])
            ->name('searchStore');
        // Статические страницы
        Route::get('/payment',[PaymentController::class,'index']) //
            ->name('payment');
        Route::get('/tenants',[TenantController::class,'index']) //
            ->name('tenants');
        Route::get('/about',[AboutController::class,'index']) //
            ->name('about');
        Route::get('/about-video-link',function (){
            return asset('video/armada_about_video.mp4');
        })->name('about-video-link');
        Route::get('/faqs',[FaqController::class,'index']) //
            ->name('faqs');

        Route::get('/delivery',[DeliveryController::class,'index'])
            ->name('delivery');

        Route::get('/projects',[ProjectController::class,'index']) //+-
            ->name('projects');
        Route::get('/promoters',[AdvertiserController::class,'index'])
            ->name('advertisers');
        Route::post('/application-post',[ApplicationController::class,'store'])
            ->name('applicationPost');

        Route::get('/contacts',[ContactController::class,'index'])
            ->name('contacts');
        Route::post('/contacts-post',[ContactController::class,'store'])
            ->name('contactsPost');

//        Route::get('/furniture-care',[FurnitureCareController::class,'index'])
//            ->name('furnitureCare');
        Route::get('/how-to-buy',[HowToBuyController::class,'index'])
            ->name('howToBuy');
        Route::get('/for-seller',[ForSellerController::class,'index'])
            ->name('forSeller');
//        Route::get('/ideas',[IdeaCareController::class,'index'])
//            ->name('ideas');
        Route::get('/scheme',[SchemeController::class,'index'])
            ->name('scheme');
        Route::get('/scheme-search',[SchemeController::class,'search'])
            ->name('scheme-search');
//        Route::get('/services',[ServiceController::class,'index'])
//            ->name('services');


        Route::get('/tour',[TourController::class,'index'])
            ->name('tour');

        Route::get('/qr',[\App\Http\Controllers\SiteFeedbackController::class,'index'])
            ->name('qr');
        Route::post('/send-feedback',[\App\Http\Controllers\SiteFeedbackController::class,'sentFeedback'])
            ->name('site.feedback');

        Route::group(['namespace' => 'Pages'], function () {
            Route::get('/sitemap', 'SitemapController@index')
                ->name('sitemap');
            Route::resource('/services', 'ServiceController', ['only' => ['index', 'show']]);
        });

        Route::get('/news',[NewsController::class,'index'])
            ->name('news.index');
        Route::get('/news/{slug}',[NewsController::class,'show'])
            ->name('news.show');
        Route::post('/news-comments',[NewsController::class,'newsComments'])
            ->name('newsComments.store');

        Route::get('/prodavcy',[ShopController::class,'index'])
            ->name('shops');
        Route::get('/prodavcy/{slug}',[ShopController::class,'show'])
            ->name('shop');
        Route::post('/prodavcy-comments',[ShopController::class,'shopComments'])
            ->name('shopComments');

        Route::get('/pay/success', function(Request $request) {
            file_put_contents('file.txt', $request->all());
            return redirect()->route('seller.stores.index');
        });

        Route::get('/cart',[IndexController::class,'cart'])
            ->name('cart');

        Route::post('/order-post',[OrderController::class,'orderPost'])
            ->name('orderPost');
    });

//Переключение языков
//require('_setlocale.php');

Route::get('/update-order-statuses',function (){
    OrderStatus::where('id',\App\Models\OrderStatus::PROCESSING)
        ->update([
            'title_ru'=>'Заказ в обработке',
            'slug'=> 'processing',
            'color'=>'hot'
        ]);

    OrderStatus::where('id',\App\Models\OrderStatus::CONFIRMED)
        ->update([
            'title_ru'=>'Заказ подтвержден',
            'slug'=> 'confirmed',
            'color'=>'active'
        ]);

    OrderStatus::where('id',\App\Models\OrderStatus::EXPECT)
        ->update([
            'title_ru'=>'Ожидаем оплаты',
            'slug'=> 'awaiting_payment',
            'color'=>'five'
        ]);
    OrderStatus::where('id',\App\Models\OrderStatus::SHIPPED)
        ->update([
            'title_ru'=>'На доставке',
            'slug'=> 'shipped',
            'color'=>'five'
        ]);
    OrderStatus::where('id',\App\Models\OrderStatus::DELIVERED)
        ->update([
            'title_ru'=>'Доставлен',
            'slug'=> 'delivered',
            'color'=>'active'
        ]);
    OrderStatus::where('id',\App\Models\OrderStatus::PAID)
        ->update([
            'title_ru'=>'Оплачен',
            'slug'=> 'paid',
            'color'=>'hot'
        ]);
    return 'Updated';
});



Route::get('/update-discount-zone-index',function (){
    \App\Models\Item::where('id',\App\Models\Item::DISCOUNT_ZONE_ID)->update([
        'index'=>0
    ]);
    return "Updated";
});

Route::get('/add-publication-permission',function (){
    \App\Models\Permission::firstOrCreate([
        'group_name' => 'Публикация',
        'display_name' => 'Добавление',
        'key' => 'add_publications',
    ]);
    \App\Models\Permission::firstOrCreate([
        'group_name' => 'Публикация',
        'display_name' => 'Изменение',
        'key' => 'edit_publications',
    ]);
    return 'added';
});



Route::view('/test-product','pages.products.testShow');


Route::get('/test-elasticsearch',function (){

// Connect via basic authentication
//    $client = ClientBuilder::create()
//        ->setElasticCloudId('armada:dXMtY2VudHJhbDEuZ2NwLmNsb3VkLmVzLmlvJDk4ZjZjZDMyNWNmZTQxYmE5ODhhZDIxMjBjMGY2YWI3JGM1ZGM3M2Q3Zjg5ZjQ5MDQ5NGQ4ZDIzOTMwMTAzYTYy')
//        ->setBasicAuthentication('sanko', '<password>')
//        ->build();

// Connect with an API key
    $client = ClientBuilder::create()
        ->setElasticCloudId('armada:dXMtY2VudHJhbDEuZ2NwLmNsb3VkLmVzLmlvJDk4ZjZjZDMyNWNmZTQxYmE5ODhhZDIxMjBjMGY2YWI3JGM1ZGM3M2Q3Zjg5ZjQ5MDQ5NGQ4ZDIzOTMwMTAzYTYy')
        ->setApiKey('3124764274','UE10OU1ZTUJBRXB0Mms2UE1GVWk6cmIyOV95QlJSeFc1TllBRHVwQmJPQQ==')
        ->build();
    dd($client->info());

    return view('test-elasticsearch');
});

Route::get('/feed-test',function (){
    //generates a Google Merchant XML feed of products
//    $products = DB::table('products')->get();
    $products = Product::skip(0)->take(1000)->get();
    $content = View::make('googlefeed', ['products' => $products]);
    return Response::make($content, '200')->header('Content-Type', 'text/xml');
});

Route::get('/search-test',function (){

    return view('search-test');
});

Route::get("/mail-test",function (){
    $card = Product::where("isActive","1")->offset(100)->limit(10)->get();

    Mail::to("sanko.eko@gmail.com")->send(new TestMails($card));
});

Route::get("/mail-send-test",[TestEmailController::class,'sendEmailsCart']);
Route::post("/user-cart-refresh",[TestEmailController::class,'refreshCart'])->name('refreshCart');
Route::get('/elastic',function (){
    return view('test-elasticsearch');
});

Route::get('/search-eeelastic', function() {

    $client = ClientBuilder::create()
        ->setHosts([env('ELASTICSEARCH_HOSTS')])
        ->build();
    $test = new ElasticsearchProductRepository($client);
    $test2 = new ElasticsearchStoreRepository($client);

//    $suggest = $client->search(['body' => [
//
//            "suggest" => [
//                "text" => $_GET['q'],
//                "my-suggestion" => [
//                    "phrase"=> [
//                        "analyzer"=>"rus_en_key",
//                        "field" => "title.trigram",
//                        "size"=> 2,
//                    "gram_size"=> 1,
//                    "direct_generator"=> [ [
//                    "field"=> "title.trigram",
//                      "suggest_mode"=> "always"
//                    ] ],
//                        "highlight"=> [
//                        "pre_tag"=> "<strong>",
//                          "post_tag"=> "</strong>"
//                        ],
//                        "collate"=> [
//                            "query"=> [
//                                "inline"=> [
//                                    "match"=> [
//                                        "title"=> [
//                                            "query"=> "{{ suggestion }}",
//                                            "operator"=> "and"
//                                        ]
//                                    ]
//                                ]
//                            ]
//                        ]
//                    ]
//                ]
//            ]
//        ],
//])['suggest']['my-suggestion'][0]['options'];
//    dd($suggest);

    $products = $test->search($_GET['q']);
    $stores = $test2->search($_GET['q']);
    $subcatalog_id = $products->first()->subcatalog()->get()->pluck('id')->implode('');
    $items = \App\Models\Item::where('subcatalog_id',$subcatalog_id)->where('isActive','1')->get();
    return view('test-elasticsearch',compact('products','stores','items'));
});
