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
Route::get('/product/{id}/{added?}', 'ProductController@show');
Route::post('/comment', 'ProductController@comment')->middleware('auth');

Route::get('/cart', 'PurchaseOrderController@show')->middleware('auth');
Route::post('/cart/add', 'PurchaseOrderController@add')->middleware('auth');    //product id and  (if it already exists, add to quantity)
Route::delete('/cart', 'PurchaseOrderController@delete')->middleware('auth');   //product id -- delete all quantity

Route::get('/checkout', 'CheckoutController@show')->middleware('auth');
Route::get('/checkout/confirm', 'CheckoutController@confirm')->middleware('auth');

