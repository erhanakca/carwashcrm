<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleTypeController;
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
    Route::delete('/delete/{service_id}', [ServiceController::class, 'delete']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'customers'
], function ($router){
    Route::get('/', [CustomerController::class, 'index']);
    Route::post('/add', [CustomerController::class, 'save']);
    Route::patch('/update/{customer_id}', [CustomerController::class, 'update']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'jobs'
], function ($router){
    Route::get('/', [JobController::class, 'index']);
    Route::post('/add', [JobController::class, 'save']);
    Route::patch('/update_status/{job_id}', [JobController::class, 'updateStatus']);
    Route::patch('/update/{job_id}', [JobController::class, 'updateJob']);
    Route::delete('/delete/{job_id}', [JobController::class, 'delete']);
    Route::post('/filter/by/date', [JobController::class, 'filterByDate']);
    Route::post('/filter/jobs/status', [JobController::class, 'filterJobsStatus']);
    Route::post('/filter/today/jobs', [JobController::class, 'filterTodayJobs']);

});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'users'
], function ($router){
    Route::patch('/update_name', [UserController::class, 'updateName']);
    Route::patch('/update_company', [UserController::class, 'updateCompany']);
    Route::patch('/update_email', [UserController::class, 'updateEmail']);
    Route::patch('/update_password', [UserController::class, 'updatePassword']);
});




