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
//Route::get('/users',[\App\Http\Controllers\TraceUserSyncController::class,'getUserList']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/task-list', 'App\Http\Controllers\StatusUpdateAPIController@orderList');
Route::get('/task-list-created', 'App\Http\Controllers\StatusUpdateAPIController@orderCreatedList')->name('task-list');
Route::get('/task-search', 'App\Http\Controllers\StatusUpdateAPIController@orderSearchList');
Route::post('/task-list/assigned', 'App\Http\Controllers\StatusUpdateAPIController@orderAssignedStatus');
Route::post('/task-list/delivered', 'App\Http\Controllers\StatusUpdateAPIController@orderDeliveredStatus');
Route::post('/task-list/returned', 'App\Http\Controllers\StatusUpdateAPIController@orderReturnStatus');
Route::post('/task-list/cancelled', 'App\Http\Controllers\StatusUpdateAPIController@orderCancelStatus');
