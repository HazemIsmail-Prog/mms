<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\CustomerForm;
use App\Http\Livewire\DistPanel;
use App\Http\Livewire\OrderForm;
use App\Http\Livewire\TechnicianPage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::get('mfs',function(){
    Artisan::call('migrate:fresh --seed');
});
Route::get('websockets',function(){
    Artisan::call('websockets:serve');
})->name('websockets');

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
        Route::get('/technician_page', TechnicianPage::class)->name('technician_page');

        // Group for All Auth Users Excluding Technicians & Formen
        Route::group(['middleware' => 'no_technicians'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::resource('/departments', DepartmentController::class);
            Route::resource('/areas', AreaController::class);
            Route::resource('/roles', RoleController::class);
            Route::resource('/titles', TitleController::class);
            Route::resource('/statuses', StatusesController::class);
            Route::resource('/users', UserController::class);
            Route::get('/customers/form/{customer_id?}', CustomerForm::class)->name('customers.form');
            Route::resource('/customers', CustomerController::class)->only('index', 'destroy');;
            Route::get('/orders/{customer_id}/form/{order_id?}', OrderForm::class)->name('orders.form');
            Route::resource('/orders', OrderController::class)->only('index', 'show', 'destroy');
            Route::get('/dis_panel/{id}', DistPanel::class)->name('dist_panel.index');
        });

        // Super Admin Routes
        Route::group(['middleware' => 'super_admin'], function () {
            Route::get('/artisan', [SuperAdminController::class, 'index'])->name('artisan.index');
            Route::post('/run', [SuperAdminController::class, 'artisan_run'])->name('artisan.run');
        });
    });
});





