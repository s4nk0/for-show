<?php
Route::get('/designer/login','IndexController@designerLogin')
    ->name('designerLogin');
Route::get('/designer/register','IndexController@designerRegister')
    ->name('designerRegister');

Route::group(['middleware' => ['auth','isDesigner'],'prefix' => 'designer', 'as' => 'designer.', 'namespace' => 'Designer',], function () {

//

//    Route::post('/info','UserInfoControllerSeller@update')
//        ->name('infoEdit');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/',[\App\Http\Controllers\Designer\DesignerIndexController::class,'home'])
            ->name('home');

        Route::get('/info',[\App\Http\Controllers\Designer\DesignerIndexController::class,'info'])
            ->name('info');

        Route::post('/info-edit',[\App\Http\Controllers\Designer\DesignerIndexController::class,'infoEdit'])
            ->name('infoEdit');

        Route::get('/designer-info-show',[\App\Http\Controllers\Designer\DesignerIndexController::class,'designerInfoShow'])
            ->name('designer_info_show');

        Route::post('/designer-info-update',[\App\Http\Controllers\Designer\DesignerIndexController::class,'designerInfoUpdate'])
            ->name('designer_info_update');

        Route::resource('/projects',DesignerProjectIndexController::class)
            ->parameters(['projects' => 'id'])->except([
                'show'
            ]);
//        Route::post('/stores-update/{id}',[StoreControllerSeller::class,'storeUpdate'])
//            ->name('storeUpdate');




    });

});
