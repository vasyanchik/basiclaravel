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



Route::post('voucher', 'VoucherController@store');
Route::post('product', 'ProductController@store');
Route::put('product/{product}/{voucher}', 'ProductController@bind');
Route::delete('product/{product}/{voucher}', 'ProductController@unbind');
Route::post('product/{product}/buy', 'ProductController@buy');

Route::get('products/{sortBy?}/{order?}', 'ProductController@index');
