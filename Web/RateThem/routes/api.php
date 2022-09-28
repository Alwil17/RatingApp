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
Route::post('register', [\App\Http\Controllers\API\UserController::class, 'store']);
Route::post('logout', [\App\Http\Controllers\API\PassportAuthController::class, 'logout']);
Route::post('login', [\App\Http\Controllers\API\PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [\App\Http\Controllers\API\PassportAuthController::class, 'userInfo']);
    Route::apiResource('users', \App\Http\Controllers\API\UserController::class)->except("store");
    Route::apiResource('structures', \App\Http\Controllers\API\StructureController::class);
    Route::apiResource('products', \App\Http\Controllers\API\ProductController::class);
    Route::apiResource('ratings', \App\Http\Controllers\API\RatingController::class);
});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


