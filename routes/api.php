<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/task-list', 'App\Http\Controllers\StatusUpdateAPIController@productList')->name('task-list');
Route::get('/task-search', 'App\Http\Controllers\StatusUpdateAPIController@productSearchList');
Route::post('/task-list/assigned', 'App\Http\Controllers\StatusUpdateAPIController@assignedStatus');
Route::post('/task-list/delivered', 'App\Http\Controllers\StatusUpdateAPIController@deliveredStatus');
Route::post('/task-list/returned', 'App\Http\Controllers\StatusUpdateAPIController@returnStatus');
Route::post('/task-list/cancelled', 'App\Http\Controllers\StatusUpdateAPIController@cancelStatus');
