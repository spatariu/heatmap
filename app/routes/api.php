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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\Api\AuthController@logout');

Route::post('/links', 'App\Http\Controllers\Api\LinkController@createLink')->middleware('auth:api');
Route::get('/links', 'App\Http\Controllers\Api\LinkController@linkHitsPerInterval')->middleware('auth:api');
Route::get('/pages/{from}/{to}', 'App\Http\Controllers\Api\LinkController@pageTypeHitsPerInterval')->middleware('auth:api');
Route::get('/journey/{user_id}', 'App\Http\Controllers\Api\LinkController@customerJourney')->middleware('auth:api');
Route::get('/same_journey/{user_id}', 'App\Http\Controllers\Api\LinkController@sameCustomerJourney')->middleware('auth:api');
