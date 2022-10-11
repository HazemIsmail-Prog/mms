<?php

use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use React\EventLoop\Timer\Timer;

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



Route::get('/websockets', function () {
    Artisan::call('websockets:serve');
})->name('websockets');


Route::get('/migrate', function () {
    Artisan::call('migrate:fresh --seed');
    return redirect()->route('home');
})->name('migrate');

Route::get('test', function () {
    event(new OrderCreatedEvent());
});

Route::group(['prefix' => LaravelLocalization::setLocale(),    'middleware' => [
    'localeSessionRedirect',
    'localizationRedirect',
    'localeViewPath',
],], function () {
    Auth::routes();
});


Route::group([
    'middleware'=> [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath' ,
        'auth',
    ], 
    'prefix' => LaravelLocalization::setLocale()
], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/departments', \App\Http\Controllers\DepartmentController::class);
    Route::resource('/roles', \App\Http\Controllers\RoleController::class);
    Route::resource('/titles', \App\Http\Controllers\TitleController::class);
    Route::resource('/statuses', \App\Http\Controllers\StatusesController::class);
    Route::resource('/users', \App\Http\Controllers\UserController::class);
    Route::resource('/customers', \App\Http\Controllers\CustomerController::class);
    Route::resource('/orders', \App\Http\Controllers\OrderController::class);

    Route::get('/dis_panel', [\App\Http\Controllers\DistPanelController::class, 'index'])->name('dist_panel.index');
    Route::get('/technician_page', [\App\Http\Controllers\DistPanelController::class, 'technician_page'])->name('technician_page');
});


