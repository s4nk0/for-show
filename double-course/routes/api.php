<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\UserController;
use App\Models\AffirmationCategory;
use App\Models\AudioContent;
use App\Models\City;
use App\Models\Country;
use App\Models\Course;
use App\Models\CourseContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use NotificationChannels\SmscRu\SmscRuApi;
use NotificationChannels\SmscRu\SmscRuChannel;
use NotificationChannels\SmscRu\SmscRuMessage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/otpAuth', 'OTPSendCode');
    Route::post('/otpVerify', 'OTPVerifyCode');
});


Route::middleware('auth:sanctum')->group( function () {
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/',function (Request $request){ return $request->user();});
        Route::post('/update', 'update');
        Route::post('/audio_activity/{category_id}', 'audio_activity');
        Route::post('/video_activity/{course_id}', 'video_activity');
        Route::post('/affirmation_activity', 'affirmation_activity');
        Route::post('/note/create', 'user_note_create');
        Route::get('/note', 'user_note');
        Route::get('/note/{id}', 'user_note_show');
        Route::get('/like_audio/{id}','like_audio');
        Route::get('/delete','destrtoy');
    });

    Route::get('/courses/all',function (Request $request){
        if ($request->paginate){
            return CourseContent::paginate($request->paginate);
        }
        return CourseContent::all();
    });

    Route::get('/invited_users',function (Request $request){
        if ($request->paginate){
            return $request->user()->invited_users()->paginate($request->paginate);
        }
        return $request->user()->invited_users()->get();
    });

    Route::get('/liked/meditation',function (Request $request){
        return $request->user()->getAllInfoAboutLikeAudio(1);
    });

    Route::get('/liked/affirmation',function (Request $request){
        return array_values($request->user()->getAllInfoAboutLikeAudio(2)->toArray());
    });

    Route::get('/user_activities',function (Request $request){
        return $request->user()->user_activities();
    });

    Route::get('/countries',function (Request $request){
        if ($request->paginate){
            return Country::paginate($request->paginate);
        }
        return Country::all();
    });

    Route::get('/cities',function (Request $request){
        if ($request->paginate){
            return City::paginate($request->paginate);
        }
        return City::all();
    });

    Route::get('/meditations',function (Request $request){
        if ($request->paginate){
            return AudioContent::join('subcategories', 'audio_contents.subcategory_id', '=', 'subcategories.id')->where('subcategories.category_id',1)->paginate($request->paginate)->withQueryString();
        }
        return AudioContent::join('subcategories', 'audio_contents.subcategory_id', '=', 'subcategories.id')->where('subcategories.category_id',1)->get();
    });

    Route::get('/meditations/{id}',function (Request $request,$id){
        return AudioContent::join('subcategories', 'audio_contents.subcategory_id', '=', 'subcategories.id')->where('subcategories.category_id',1)->find($id);
    });

    Route::get('/affirmations',function (Request $request){
        if ($request->paginate){
            return AudioContent::join('subcategories', 'audio_contents.subcategory_id', '=', 'subcategories.id')->where('subcategories.category_id',2)->paginate($request->paginate)->withQueryString();
        }
        return AudioContent::join('subcategories', 'audio_contents.subcategory_id', '=', 'subcategories.id')->where('subcategories.category_id',2)->get();
    });

    Route::get('/affirmations/{id}',function (Request $request,$id){
        return AudioContent::join('subcategories', 'audio_contents.subcategory_id', '=', 'subcategories.id')->where('subcategories.category_id',2)->find($id);
    });

    Route::get('/courses',function (Request $request){
        if ($request->paginate){
            return  Course::with('course_contents')->paginate($request->paginate);
        }
        return Course::with('course_contents')->get();
    });

    Route::get('/courses/{id}',function (Request $request,$id){
        return Course::with('course_contents')->find($id);
    });

    Route::get('/progress',function (Request $request){
        return round($request->user()->audio_content()->with('subcategory')->get()->where('subcategory.category_id',2)->groupBy('id')->count()/31,2)*100;
    });
});
