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
    return view('pages.dashboard');
});
Route::get('/orders', function() {
	return view('pages.orders');
});
Route::get('/clients', function() {
	return view('pages.clients');
});
Route::get('/items', function() {
	return view('pages.items');
});
