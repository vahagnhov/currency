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

Route::resource('/exchange-rates', 'ExchangeRatesController', ['only' => ['index','store']]);

Route::get('/exchange-rates/history/','ExchangeRatesController@index');

Route::post('/exchange-rates','ExchangeRatesController@store');
