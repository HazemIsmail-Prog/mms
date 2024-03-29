<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\CustomerForm;
use App\Http\Livewire\CustomerIndex;
use App\Http\Livewire\Dashboard\DepartmentTechnicianCounter;
use App\Http\Livewire\Dashboard\OrdersStatusCounter;
use App\Http\Livewire\DashboardIndex;
use App\Http\Livewire\DistPanel;
use App\Http\Livewire\OrderForm;
use App\Http\Livewire\OrderShow;
use App\Http\Livewire\TechnicianPage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
            Route::get('/', DashboardIndex::class)->name('home'); //livewire

            //Settings
            Route::resource('/roles', RoleController::class);
            Route::resource('/departments', DepartmentController::class);
            Route::resource('/titles', TitleController::class);
            Route::resource('/users', UserController::class);
            Route::resource('/statuses', StatusesController::class);
            Route::resource('/areas', AreaController::class);

            //Operations
            Route::get('/customers/form/{customer_id?}', CustomerForm::class)->name('customers.form');
            Route::get('/customers', CustomerIndex::class)->name('customers.index'); //livewire
            Route::get('/orders/{customer_id}/form/{order_id?}', OrderForm::class)->name('orders.form');
            Route::get('/orders/{order}',OrderShow::class)->name('orders.show'); //livewire
            Route::get('/orders', [OrderController::class,'index'])->name('orders.index');

            //Dispaching
            Route::get('/dis_panel/{id}', DistPanel::class)->name('dist_panel.index');

            //Reports
            Route::get('/reports/monthly_orders_statistics', OrdersStatusCounter::class)->name('reports.monthly_orders_statistics'); //livewire
            Route::get('/reports/department_technician_statistics', DepartmentTechnicianCounter::class)->name('reports.department_technician_statistics'); //livewire

        });

        // Super Admin Routes
        Route::group(['middleware' => 'super_admin'], function () {
            Route::get('/artisan', [SuperAdminController::class, 'index'])->name('artisan.index');
            Route::post('/run', [SuperAdminController::class, 'artisan_run'])->name('artisan.run');
        });
    });
});





