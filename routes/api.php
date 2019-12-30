<?php

use Illuminate\Http\Request;

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

Route::post('artikel/opret', 'PostController@store');
Route::post('katogori/opret', 'CategoryController@store');
Route::post('katogori/rediger/', 'CategoryController@update');
Route::post('artikel/rediger', 'PostController@update');
Route::post('om-mig/rediger', 'AboutController@update');
