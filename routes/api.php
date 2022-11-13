<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VehicleTypeController;
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
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'vehicle_types',
], function ($router){
    Route::get('/', [VehicleTypeController::class, 'index']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'services'
], function ($router){
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/add', [ServiceController::class, 'save']);
    Route::patch( '/update/{service_id}', [ServiceController::class, 'update']);
    Route::patch('/bulk_update/', [ServiceController::class, 'bulkUpdate']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'customers'
], function ($router){
    Route::get('/', [CustomerController::class, 'index']);
    Route::post('/add', [CustomerController::class, 'save']);
    Route::patch('/update/{customer_id}', [CustomerController::class, 'update']);
});


