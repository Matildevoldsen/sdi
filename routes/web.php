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
Route::get('bruger/{id}', 'Auth\\UserController@view');

Route::middleware(['isAdmin'])->group(function () {
    Route::get('om-mig/rediger', 'AboutController@edit')->name('about.edit');

    //Article sites
    Route::get('artikel/slet-{id}', 'PostController@delete')->name('post.destroy');
    Route::get('artikel/ny', 'PostController@create')->name('post.new');
    Route::get('artikel/rediger-{id}', 'PostController@edit')->name('post.edit');

    //Category Sites
    Route::get('katogori-top/rediger/{id}', 'TopCategoryController@edit')->name('categoryTop.edit');
    Route::post('katogori-top/rediger/{id}', 'TopCategoryController@update')->name('categoryTop.update');

    Route::get('katogori/new', 'CategoryController@index')->name('category.showForm');
    Route::get('katogori/rediger/{id}', 'CategoryController@edit')->name('category.edit');
    Route::post('katogori/rediger/{id}', 'CategoryController@update')->name('category.update');
    Route::post('katogori/slet', 'CategoryController@destroy')->name('category.delete');
    Route::post('katogori/new', 'CategoryController@store')->name('category.new');

    //Top Categories
    Route::get('over-katogori/vis/{id}', 'TopCategoryController@view')->name('top.category.show');
    Route::post('over-katogori/slet', 'TopCategoryController@destroy')->name('top.category.delete');
    Route::post('over-katogori/new', 'TopCategoryController@store')->name('top.category.new');
//Site Settings
    Route::get('indstillinger/rediger', 'SettingsController@edit')->name('settings.edit');
    Route::post('indstillinger/opdater', 'SettingsController@update')->name('settings.update');
});

Route::get('artikel/{id}/s-{slug}', 'PostController@show')->name('post.show');

Route::get('katogori/vis/{id}', 'CategoryController@view')->name('category.show');
Route::get('search', 'SearchController@get')->name('search');
