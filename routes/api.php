<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(AuthController::class)->group(function (){
        Route::post('register', 'register');
    });
    Route::controller(PackageController::class)->group(function (){
        Route::get('packages', 'getPackages');
        Route::post('packages/create', 'createPackage');
    });

    Route::controller(RegistrationController::class)->group(function (){
        Route::post('package/assign', 'assignCustomerPackage');
    });
});


//Route::middleware('auth:sanctum')->controller(PackageController::class)->group(function () {
//    Route::get('packages', 'getPackages');
//});
//
//Route::middleware('auth:sanctum')->controller(RegistrationController::class)->group(function () {
//    Route::post('package/register', 'register');
//});

