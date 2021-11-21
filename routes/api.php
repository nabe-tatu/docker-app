<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\TweetController;
use \App\Http\Controllers\Api\V1\UserController;
use \App\Http\Controllers\Api\V1\GetRecommendUserController;

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
Route::post('register', [\App\Http\Controllers\Api\V1\UserController::class,'store']);
Route::post('sendResetPasswordUrl', [\App\Http\Controllers\Api\V1\UserController::class,'sendResetPasswordUrl']);
Route::post('resetPassword', [\App\Http\Controllers\Api\V1\UserController::class,'resetPassword']);
Route::post('testUrl', [\App\Http\Controllers\Api\V1\UserController::class,'testUrl'])->name('api.testUrl');

Route::prefix('v1')->middleware(['auth:api'])->group(function () {
    Route::apiResource('tweets', TweetController::class)->only(['index']);
    Route::apiResource('users', UserController::class)->only(['show','store', 'update']);
    Route::get('loginUser', [UserController::class, 'loginUser']);
//    Route::get('/getRecommendUser', GetRecommendUserController::class);
});

Route::get('v1/getRecommendUser', GetRecommendUserController::class);
