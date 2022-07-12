<?php

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

Route::namespace('api')->group(function () {
    // Route::prefix('auth')->group(function () {
    //     Route::get('/code', 'AuthController@userGetCode');
    //     Route::post('/verify', 'AuthController@userCodeVerify');
    // });

    // Route::middleware(['auth:sanctum'])->group(function () {
        Route::resource('equipment', EquipmentController::class);
        Route::get('/equipment-type', 'EquipmentTypeController@logout');
    // });
});
