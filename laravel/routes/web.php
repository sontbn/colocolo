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

Route::get('login', 'AuthController@index');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::middleware(['auth'])->group(function() {
	
	Route::get('/', 'AppController@index');
	Route::get('token', 'AppController@token');

	Route::prefix('dropdown')->group(function() {});

	Route::prefix('ref')->group(function() {

		Route::get('app', 'RefAppController@index');
		Route::post('app', 'RefAppController@store');
		Route::get('app/{id}', 'RefAppController@edit');
		Route::put('app', 'RefAppController@update');
		Route::delete('app', 'RefAppController@destroy');

	});

	Route::prefix('monitoring')->group(function() {

		//Route::get();

	});

});
