<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ResultController;


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

Route::controller(LoginController::class)->group(function(){
    Route::get('admin/login', 'index')->name('login');
    Route::post('admin/login/process', 'process');
    Route::post('admin/logout', 'logout');
});


Route::controller(DashboardController::class)->group(function(){
    Route::get('admin/dashboard', 'index')->middleware('auth');
    Route::get('admin/dashboard/show/{id}', 'show')->name('admin.dashboard.show');
});
Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function(){
    Route::controller(PlatformController::class)->group(function(){
        Route::get('/admin/airdrop/platform', 'index')->middleware('auth');
        Route::post('admin/airdrop/platform/store', 'store')->middleware('auth');
        Route::get('admin/airdrop/platform/{id}/update', 'update')->middleware('auth');
    });
});

Route::controller(PromoController::class)->group(function(){
    Route::get('admin/airdrop/promo', 'index')->middleware('auth');
    Route::get('admin/airdrop/promo/create', 'create')->middleware('auth');
    Route::get('admin/airdrop/promo/edit/{id}', 'edit')->middleware('auth');
    Route::put('admin/airdrop/promo/update/{id}', 'update')->middleware('auth');
    Route::post('admin/airdrop/promo/store', 'store')->middleware('auth');
    Route::get('admin/airdrop/promo/view/{id}', 'view')->middleware('auth');
    Route::put('admin/airdrop/promo/view/{url_id}/generate_url', 'generate_url')->middleware('auth');
});

Route::controller(CodeController::class)->group(function(){
    Route::post('admin/airdrop/promo/promocode/store', 'store')->middleware('auth');
    Route::post('admin/airdrop/promo/promocode/update', 'update')->middleware('auth');
});

Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('admin/users/', 'index')->middleware('auth');
        Route::post('admin/users/store', 'store')->middleware('auth');
        Route::get('admin/users/edit/{id}', 'edit')->middleware('auth');
        Route::put('admin/users/update/{id}', 'update')->middleware('auth');
        Route::post('admin/users/store_new_platform', 'store_new_platform')->middleware('auth');
        Route::post('admin/users/remove_platform', 'remove_platform')->middleware('auth');
    });
});


Route::controller(ParticipantController::class)->group(function (){
    Route::post('admin/airdrop/promo/participant/store', 'store')->middleware('auth');
    Route::post('admin/airdrop/promo/participant/update', 'update')->middleware('auth');
    Route::post('admin/airdrop/promo/participant/winner', 'winner')->middleware('auth');
});


Route::controller(ArchiveController::class)->group(function (){
    Route::get('admin/airdrop/promo/archive' , 'index')->middleware('auth');
});

//HOME CONTROLLER
Route::controller(HomeController::class)->group(function (){
    Route::get('/', 'index');
    Route::post('promo/{slug}/{url_id}/store_register', 'store_register');
    Route::get('promo/{slug}/{url_id}', 'register_redeem');
    Route::get('participant_registered', 'participant_registered');
});


//RESULTS CONTROLLER
Route::controller(ResultController::class)->group(function () {
    Route::get('/promo/results', 'index');
    Route::get('/promo/result/{slug}/{url_id}', 'result_single');
});