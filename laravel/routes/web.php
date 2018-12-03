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

	Route::prefix('dropdown')->group(function() {});

});
