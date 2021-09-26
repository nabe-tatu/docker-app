<?php

use Illuminate\Support\Facades\Route;

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


Route::view('login', 'app')->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class,'login']);
Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::get('/{any}', [\App\Http\Controllers\SpaController::class, 'index'])
    ->where('any', '.*');
