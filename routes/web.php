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

Route::get('customer/{name}/{cnp}','UserController')->name('user.add');
/*
Route::group(['prefix' => 'transaction'], function () {
	Route::get('{customerid}/filter','TransactionController@filter');
	Route::get('{customerid}/add/{amount}','TransactionController@add');
	Route::get('{transactionid}/update/{amount}','TransactionController@update');
	Route::get('{transactionid}/delete','TransactionController@destroy');
	Route::get('{customerid}/{transactionid}','TransactionController@get')->name('transaction.get');
});
*/
