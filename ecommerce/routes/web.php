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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@directory');
Route::get('/product/{id}', 'ProductController@show');

Route::get('/cart', 'PurchaseOrderController@show');
Route::post('/cart/add', 'PurchaseOrderController@store');

Route::get('/checkout', 'PurchaseOrderController@checkout');
Route::get('/checkout/confirm', 'PurchaseOrderController@confirm');

