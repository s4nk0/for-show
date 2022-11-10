<?php

use App\Http\Controllers\Admin\AnalyticControllerAdmin;
use App\Http\Controllers\Admin\HomeControllerAdmin;
use App\Http\Controllers\Admin\MapControllerAdmin;
use App\Http\Controllers\Admin\NewsControllerAdmin;
use App\Http\Controllers\Admin\ProductControllerAdmin;
use App\Http\Controllers\Admin\StoreControllerAdmin;
use App\Http\Controllers\Admin\SubscriptionControllerAdmin;
use App\Http\Controllers\Admin\VideoControllerAdmin;
use App\Http\Controllers\Admin\PermissionControllerAdmin;
use App\Models\Permission;

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'adminex', 'as' => 'admin.', 'namespace' => 'Admin'], function () {

    //export to xml
    Route::get('/exportdata/{file_type}','ProductControllerAdmin@exportdata')
        ->name('export_data');
    //import from xml
    Route::get('importxmldata','ProductControllerAdmin@importxmldata')
        ->name('importxmldata');
    Route::post('importdata','ProductControllerAdmin@importdatapost')
        ->name('importdatapost');

    Route::resource('/type-deliveries', 'TypeDeliveryAdminController');
    Route::resource('/type-pays', 'TypePayAdminController');
    Route::resource('/designer', 'DesignerUserController');
    Route::resource('/designer-projects', 'DesignerProjectController');
    Route::resource('/designer-styles', 'DesignerStyleController');

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_PANEL]], function () {
        Route::get('/', [HomeControllerAdmin::class, 'home'])
            ->name('home');
    });

    Route::resource('/profile', 'ProfileControllerAdmin')
        ->parameters(['profile' => 'id']);

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_PRODUCTS]], function () {
        Route::resource('/products', 'ProductControllerAdmin');
        Route::post('/create-products-with-image',[ProductControllerAdmin::class, 'createWithImages'])->name('createWithImages');
        Route::resource('/product/{product_id}/additional', 'ProductAdditionalControllerAdmin')
            ->names('additional');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_STORES]], function () {
        Route::resource('/stores', 'StoreControllerAdmin');
    });

    Route::post('/stores-update/{id}', [StoreControllerAdmin::class, 'storeUpdate'])
        ->name('storeUpdate');
    Route::get('/stores-check-slug', [StoreControllerAdmin::class, 'checkSlug'])
        ->name('checkSlug');

    // check store has user_id
    Route::get('/stores-check-user_id', [StoreControllerAdmin::class, 'checkSellerExistsInStore'])->name('check-store-seller');


    Route::group(['middleware' => ['permission:' . Permission::BROWSE_USERS]], function () {
        Route::resource('/users', 'UserControllerAdmin');
    });

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_SELLERS]], function () {
        Route::resource('/sellers', 'SellerControllerAdmin');
    });

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_ORDERS]], function () {
        Route::resource('/orders', 'OrderControllerAdmin');
    });

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_CATALOGS]], function () {
        Route::resource('/catalogs', 'CatalogControllerAdmin');
        Route::resource('/subcatalogs', 'SubcatalogControllerAdmin');
        Route::resource('/items', 'ItemControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_MAPS]], function () {
        Route::resource('/maps', 'MapControllerAdmin');
        Route::get('/maps-view', [MapControllerAdmin::class, 'mapviewIndex'])->name('map-view');
        Route::post('/update-or-create-map', [MapControllerAdmin::class, 'updateOrCreateMap'])->name('update-or-create-map');
        Route::get('/get-occupied-polygon', [MapControllerAdmin::class, 'get_occupied_map'])->name('get_occupied_map');
    });

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_ADMINS]], function () {
        Route::resource('/admins', 'AdminControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_BANNERS]], function () {
        Route::resource('/banners', 'BannerControllerAdmin');
    });

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_BLOGS]], function () {
        Route::resource('/blogs', 'BlogControllerAdmin'); // ????????????
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_COLORS]], function () {
    Route::resource('/colors', 'ColorControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_COUNTRIES]], function () {
    Route::resource('/countries', 'CountryControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_CITIES]], function () {
    Route::resource('/cities', 'CityControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_REVIEWS]], function () {
    Route::resource('/reviews', 'ReviewControllerAdmin');
    Route::resource('/news-reviews', 'NewsReviewControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_APPLICATIONS]], function () {
        Route::resource('/applications', 'ApplicationControllerAdmin');
    });

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_SUBSCRIPTIONS]], function () {
        Route::resource('/subscriptions', 'SubscriptionControllerAdmin');
        Route::post('/send-mail', [SubscriptionControllerAdmin::class, 'sendMail'])
            ->name('subscriptions.sendMail');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_PAGES]], function () {
        Route::resource('/pages', 'PagesControllerAdmin');
    });
    Route::resource('/projects', 'ProjectControllerAdmin');

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_NEWS]], function () {
        Route::resource('/news', 'NewsControllerAdmin');
        Route::post('/news-update/{id}', [NewsControllerAdmin::class, 'newsUpdate'])
            ->name('newsUpdate');
    });


    Route::group(['middleware' => ['permission:' . Permission::BROWSE_VIDEO]], function () {
        Route::resource('/videos', 'VideoControllerAdmin');
    });

    Route::post('/videos-update/{id}', [VideoControllerAdmin::class, 'videosUpdate'])
        ->name('videosUpdate');

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_TARIFS]], function () {
    Route::resource('/tarifs', 'TarifControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_ROLES]], function () {
    Route::resource('/roles', 'RoleControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_PERMISSIONS]], function () {
    Route::resource('/permissions', 'PermissionControllerAdmin');
    });
    Route::group(['middleware' => ['permission:' . Permission::BROWSE_FAQS]], function () {
        Route::resource('/faqs', 'FaqControllerAdmin');
    });

    Route::group(['middleware' => ['permission:' . Permission::BROWSE_PUBLICATIONS]], function () {
        Route::resource('/publications', 'PublicationControllerAdmin');
    });

    Route::resource('/callback', 'CallbackControllerAdmin');
    Route::resource('/messages', 'MessageControllerAdmin');


    Route::group(['middleware' => ['permission:' . Permission::BROWSE_ANALYTICS]], function () {
    Route::get('/analytics', [AnalyticControllerAdmin::class, 'index'])->name('analytics');
    });

    Route::get('/all-store-tariff-add-one-year',function (){
        \App\Models\Store::query()->update(['tarif_end_date'=>now()->addYear()]);
        return 'added one year';
    });


});
