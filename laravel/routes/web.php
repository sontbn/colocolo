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

	Route::prefix('dropdown')->group(function() {

		Route::get('app', 'DropdownController@app');
		Route::get('env', 'DropdownController@env');
		Route::get('center', 'DropdownController@center');

		Route::get('app-form', 'DropdownController@app_form');
		Route::get('env-form', 'DropdownController@env_form');
		Route::get('center-form', 'DropdownController@center_form');
		Route::get('merk-form', 'DropdownController@merk_form');
		Route::get('os-form', 'DropdownController@os_form');
		Route::get('uakpb-form', 'DropdownController@uakpb_form');
		Route::get('uraianbmn-form', 'DropdownController@uraianbmn_form');
		Route::get('stslisensi-form', 'DropdownController@stslisensi_form');
		
	});


	Route::get('input', 'InputController@index');
	Route::post('input', 'InputController@store');
	Route::get('input/{id}', 'InputController@edit');
	Route::put('input', 'InputController@update');
	Route::delete('input', 'InputController@destroy');


	Route::prefix('mon')->group(function() {

		Route::get('hardware', 'MonHardwareController@index');
		Route::get('software', 'MonSoftwareController@index');
		Route::get('administrative', 'MonAdministrativeController@index');

	});

	
	Route::prefix('ref')->group(function() {

		Route::get('app', 'RefAppController@index');
		Route::post('app', 'RefAppController@store');
		Route::get('app/{id}', 'RefAppController@edit');
		Route::put('app', 'RefAppController@update');
		Route::delete('app', 'RefAppController@destroy');

		Route::get('merk', 'RefMerkController@index');
		Route::post('merk', 'RefMerkController@store');
		Route::get('merk/{id}', 'RefMerkController@edit');
		Route::put('merk', 'RefMerkController@update');
		Route::delete('merk', 'RefMerkController@destroy');

		Route::get('os', 'RefOsController@index');
		Route::post('os', 'RefOsController@store');
		Route::get('os/{id}', 'RefOsController@edit');
		Route::put('os', 'RefOsController@update');
		Route::delete('os', 'RefOsController@destroy');

	});

});
