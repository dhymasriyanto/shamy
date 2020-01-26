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

/**
 * URL: v1/auth/...
 * Middleware: guest
 */
Route::prefix('v1')->name('v1.auth.')->group(function (){
    Route::get('/auth/login', 'Api\v1\ApiAuth@login')->name('login');
    Route::post('/auth/login', 'Api\v1\ApiAuth@login')->name('login');
});


/**
 * URL: v1/user/...
 * Middleware: auth:api
 */
Route::prefix('v1')->middleware('auth:api')->name('v1.user.')->group(function (){
    Route::get('/user/get', 'Api\v1\ApiUser@get')->name('get');
});

