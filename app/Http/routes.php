<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::group(['prefix' => 'administrator'], function () {
    Route::get('/', ['as' => 'adminHome', 'uses' => 'AdminController@index']);
    Route::get('/statistics', ['as' => 'adminStat', 'uses' => 'AdminController@statistics']);
});


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/product/list', 'ProductController@listing');
Route::get('/product/show/{id}', 'ProductController@showAjax');
Route::post('/order/store','OrderController@store');

Route::group(['prefix' => 'administrator'], function () {
    Route::resource('product', 'ProductController');
    Route::resource('label', 'LabelController');
    Route::resource('photo', 'PhotoController');
    Route::resource('order', 'OrderController');
    Route::resource('category', 'CategoryController');
});
