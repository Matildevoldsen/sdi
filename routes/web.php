<?php

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
Auth::routes();

//Main Sites
Route::get('/', 'HomeController@index')->name('home');
Route::get('om-mig', 'AboutController@index')->name('about');

//Article sites
Route::get('artikel/ny', 'PostController@create')->name('post.new');
Route::get('artikel/{id}/s-{slug}', 'PostController@show')->name('post.show');
Route::get('artikel/slet-{id}', 'PostController@delete')->name('post.destroy');
Route::get('artikel/rediger-{id}', 'PostController@edit')->name('post.edit');

//Category Sites
Route::get('katogori/vis/{id}', 'CategoryController@view')->name('category.show');
Route::get('katogori/new', 'CategoryController@index')->name('category.showForm');
Route::post('katogori/slet', 'CategoryController@destroy')->name('category.delete');
Route::post('katogori/new', 'CategoryController@store')->name('category.new');

//Top Categories
Route::get('over-katogori/vis/{id}', 'TopCategoryController@view')->name('top.category.show');
Route::post('over-katogori/slet', 'TopCategoryController@destroy')->name('top.category.delete');
Route::post('over-katogori/new', 'TopCategoryController@store')->name('top.category.new');

//Site Settings
Route::get('indstillinger/rediger', 'SettingsController@edit')->name('settings.edit');
Route::post('indstillinger/opdater', 'SettingsController@update')->name('settings.update');
