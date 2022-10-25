<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TechnicianPageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/login', [AuthController::class,'login']);
Route::get('/technician_page', [TechnicianPageController::class,'getCurrenOrder'])->middleware('auth:api');

// Route::middleware('auth:api')->post('/auth/login', function (Request $request) {
//     return $request->user();
// });
