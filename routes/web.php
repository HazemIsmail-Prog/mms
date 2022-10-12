<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DistPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


// LaravelLocalization Middleware & Prefix
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
    ],
], function () {

    // Auth Routes
    Auth::routes();

    // Group for All Auth Users Including Technicians & Formen
    Route::group(['middleware' => ['auth']], function () {

        Route::get('/technician_page', [DistPanelController::class, 'technician_page'])->name('technician_page');

        // Group for All Auth Users Excluding Technicians & Formen
        Route::group(['middleware' => 'no_technicians'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::resource('/departments', DepartmentController::class);
            Route::resource('/roles', RoleController::class);
            Route::resource('/titles', TitleController::class);
            Route::resource('/statuses', StatusesController::class);
            Route::resource('/users', UserController::class);
            Route::resource('/customers', CustomerController::class);
            Route::resource('/orders', OrderController::class);
            Route::get('/dis_panel', [DistPanelController::class, 'index'])->name('dist_panel.index');
        });


        // Super Admin Routes
        Route::group(['middleware' => 'super_admin'], function () {
            Route::get('/websockets', function () {Artisan::call('websockets:serve');})->name('websockets');
            Route::get('/migrate', function () {Artisan::call('migrate:fresh --seed');return redirect()->route('home');})->name('migrate');
        });


    });
});





