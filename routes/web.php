<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DistPanelController;
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
        Route::get('/technician_page', TechnicianPage::class)->name('technician_page');

        // Group for All Auth Users Excluding Technicians & Formen
        Route::group(['middleware' => 'no_technicians'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::resource('/departments', DepartmentController::class);
            Route::resource('/roles', RoleController::class);
            Route::resource('/titles', TitleController::class);
            Route::resource('/statuses', StatusesController::class);
            Route::resource('/users', UserController::class);
            Route::get('/customers/form/{customer_id?}', CustomerForm::class)->name('customers.form');
            Route::resource('/customers', CustomerController::class)->only('index', 'destroy');;
            Route::get('/orders/{customer_id}/form/{order_id?}', OrderForm::class)->name('orders.form');
            Route::get('/orders/excel',[OrderController::class,'export'])->name('orders.excel');
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





