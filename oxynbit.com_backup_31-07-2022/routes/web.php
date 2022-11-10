<?php

use App\Http\Controllers\ProfileCustomController;
use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\GeneratedWalletsController;
use App\Models\CoingeckoApi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//for permission access use middlware('can:permisson')
//for role access use middlware('role:role1,role2')


//Route::controller(DashboardController::class)->group(function(){
//    Route::get('/', 'index')->middleware(['auth']);
//    Route::get('/dashboard', 'index')->middleware(['auth'])->name('dashboard');
//});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::get('/admin', function () {
//     return view('admin');
// })->middleware(['auth'])->name('admin');

Route::get('/', function () {

    $api = new CoingeckoApi;
    //to optimize code
    $crypto = ['bitcoin', 'litecoin', 'ethereum', 'ripple', 'uniswap', 'chainlink', 'matic-network', 'stellar', 'ftx-token', 'bitcoin-cash'];
    $currency = ['usd',];
    $crypto_get = $api->getCryptoInfo($currency, $crypto);

    $crypto_second = ['bitcoin','ethereum','dogecoin','ripple','litecoin'];
    $crypto_get_second = $api->getCryptoInfo($currency, $crypto_second);

    return view('main.index',compact('crypto_get','crypto_get_second'));
 })->name('main.index');

Route::get('/trading', function () {
    return view('main.trading');
})->name('main.trading');

Route::get('/aml-kyc-policy', function () {
    return view('main.aml-kyc-policy');
})->name('main.aml-kyc-policy');

Route::get('/cookies-policy', function () {
    return view('main.cookies-policy');
})->name('main.cookies-policy');

Route::get('/cross-rates', function () {
    return view('main.cross-rates');
})->name('main.cross-rates');

Route::get('/fees', function () {
    return view('main.fees');
})->name('main.fees');

Route::get('/market-crypto', function () {
    return view('main.market-crypto');
})->name('main.market-crypto');

Route::get('/heat-map', function () {
    return view('main.heat-map');
})->name('main.heat-map');

Route::get('/market-screener', function () {
    return view('main.market-screener');
})->name('main.market-screener');

Route::get('/news', function () {
    return view('main.news');
})->name('main.news');

Route::get('/privacy-notice', function () {
    return view('main.privacy-notice');
})->name('main.privacy-notice');

Route::get('/technical-analysis', function () {
    return view('main.technical-analysis');
})->name('main.technical-analysis');

Route::get('/terms', function () {
    return view('main.terms');
})->name('main.terms');

Route::get('/cross-rates', function () {
    return view('main.cross-rates');
})->name('main.cross-rates');


//Route::view('/terms', 'terms');

Route::controller(TransactionController::class)->group(function() {
    Route::post('transaction', 'store')->middleware(['auth'])->name('transaction.store');
});

Route::prefix('admin')->middleware('role:Admin')->middleware('auth')->group(function () {
    Route::controller(AdminController::class)->group(function(){
//        Route::get('/', 'index');
        Route::post('/', 'show')->name('admin.show');
        Route::get('/', 'dashboard')->name('admin.show');;
    });

    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::resource('roles', \App\Http\Controllers\RolesController::class);
//    Route::resource('managers', \App\Http\Controllers\ManagerController::class);
});

Route::prefix('user')->middleware('auth')->group(function () {
    Route::controller(ProfileCustomController::class)->prefix('profile')->group(function(){
        Route::get('/wallet', 'wallet')->name('user.wallet');
        Route::get('/deposit', 'deposit')->name('user.deposit');
        Route::get('/withdraw', 'withdraw')->name('user.withdraw');
        Route::get('/transfer', 'transfer')->name('user.transfer');
        Route::get('/invest', 'invest')->name('user.invest');
        Route::get('/affiliate', 'affiliate')->name('user.affiliate');
        Route::get('/api', 'api')->name('user.api');
    });
});

Route::prefix('manager')->middleware('role:Admin,Manager')->middleware('auth')->group(function () {
    Route::controller(ManagerController::class)->group(function(){
        Route::get('/', 'index')->name('manager.index');
    });
});

Route::get('/invite/{user_id}',function (\Illuminate\Http\Request $request, $user_id){
    session_start();
    $_SESSION["invited_by"] = $user_id;

    return redirect('/register');
})->middleware('signed')->name('invite');

Route::post('/newtransaction', [GeneratedWalletsController::class, 'store']);



require __DIR__.'/auth.php';
