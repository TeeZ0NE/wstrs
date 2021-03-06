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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customer/{name}/{cnp}','UserController')->name('user.add');
Route::apiResource('transactions','TransactionController');
Route::group(['prefix' => 'transactions'], function () {
	Route::get('{customerid}/filter','TransactionController@filter');
	Route::get('{customerid}/{transactionid}','TransactionController@get');
});
