<?php

use App\Http\Controllers\Admin\AudioContentController;
use App\Http\Controllers\Admin\VideoContentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return redirect('/login');
})->name('dashboard');

Route::get('/admin', function (){
    return redirect('/admin/users');
});

Route::prefix('admin')->middleware([
    'role:Admin',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::controller(UsersController::class)->group(function(){
        Route::get('/users', 'index')->name('admin.users.index');
        Route::get('/user/{user}/delete/', 'destroy')->name('admin.users.delete');
        Route::post('/user/create', 'store')->name('admin.users.create');
    });

    Route::prefix('contents')->group(function(){
        Route::controller(AudioContentController::class)->prefix('audio')->group(function(){
            Route::get('/category', 'categories')->name('admin.contents.audio.category');
            Route::get('/category/{category}/delete', 'destroy')->name('admin.contents.audio.delete');
            Route::get('/category/{category}', 'show')->name('admin.contents.audio.show');

            Route::get('/category/subcategory/{subcategory}/delete', 'destroySubcategory')->name('admin.contents.audio.subcategory.delete');

            Route::get('/content/{content}/delete', 'destroyContent')->name('admin.contents.audio.content.delete');
        });

        Route::controller(VideoContentController::class)->prefix('video')->group(function(){
            Route::get('/courses', 'courses')->name('admin.video.courses');
            Route::get('/courses/{course}', 'showCourses')->name('admin.contents.video.course.show');
            Route::get('/courses/{course}/delete', 'destroyCourses')->name('admin.video.courses.delete');
            Route::get('/courses/content/{content}/delete', 'destroyCourseContent')->name('admin.video.courses.content.delete');
        });
    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('/settings', 'settings')->name('admin.settings.index');
        Route::get('/country/{country}/delete', 'destroyCountry')->name('admin.settings.country.delete');
        Route::get('/city/{city}/delete', 'destroyCity')->name('admin.settings.city.delete');
    });
});
