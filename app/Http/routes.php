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

//Route::get('/', function () {
//    return view('welcome');
//});

//Index Route
Route::get('/', ['as' => 'products', 'uses' => 'ProductController@index']);
//Index Route too
Route::get('/product', ['as' => 'products', 'uses' => 'ProductController@index']);
//Ajax Create Route
Route::post('/product/create', ['as' => 'products', 'uses' => 'ProductController@create']);

// PRoducts Resource
Route::resource('product', 'ProductController');