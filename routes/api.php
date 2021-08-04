<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\V1\TweetController;
use \App\Http\Controllers\Api\V1\UserController;

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
Route::prefix('v1')->middleware(['auth:api'])->group(function () {
    Route::apiResource('tweets', TweetController::class)->only(['index']);
    Route::apiResource('users', UserController::class)->only(['update']);
    Route::get('/recommendUsers', [UserController::class, 'recommendUsers']);
});
