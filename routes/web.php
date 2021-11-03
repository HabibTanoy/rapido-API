<?php

use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'App\Http\Controllers\FileImportDataController@fileImportExport');
Route::post('file-import', 'App\Http\Controllers\FileImportDataController@fileImport')->name('file-import');
//Route::get('file-export', 'App\Http\Controllers\UserController@fileExport')->name('file-export');
//Crud
Route::get('/task-list', 'App\Http\Controllers\FileDataHandleController@show')->name('task-list');
Route::get('/task/{id}', 'App\Http\Controllers\FileDataHandleController@updateData')->name('task-update-info');
Route::post('/task-update/{id}', 'App\Http\Controllers\FileDataHandleController@updated')->name('task-update');
Route::delete('/delete/{id}', 'App\Http\Controllers\FileDataHandleController@delete')->name('delete');
