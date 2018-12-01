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

Route::post('/client/save', 'ClientsController@save');
Route::post('/client/list', 'ClientsController@list');

Route::get('/items/list/{id}', 'ItemsController@list');
Route::post('/items/save', 'ItemsController@save');
Route::post('/items/update/codes', 'ItemsController@regenerateItemCodes');
Route::post('/items/update/{id}', 'ItemsController@update');

Route::post('/order/approve', 'OrdersController@approveOrder');
Route::post('/order/disapprove', 'OrdersController@disapproveOrder');
Route::post('/order/save', 'OrdersController@save');
Route::get('/orders/list/{item_code}', 'OrdersController@list');

Route::get('/reports/list', 'ReportsController@list');

Route::get('/itemtypes/list', 'ItemTypesController@list');
Route::post('/itemtypes/save', 'ItemTypesController@save');
Route::post('/itemtypes/update/{id}', 'ItemTypesController@update');