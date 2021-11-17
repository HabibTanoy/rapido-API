<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function() {
    return redirect()->route('admin-login');
});
Route::group(['prefix' => 'admin'], function() {

    Route::get('/login', 'App\Http\Controllers\AdminController@loginPage')->name('admin-login');
    Route::post('login', 'App\Http\Controllers\AdminController@login')->name('adminlogin-check');
    Route::get('/signup', 'App\Http\Controllers\AdminController@registerPage')->name('admin-signup');
    Route::post('/signup', 'App\Http\Controllers\AdminController@register')->name('register');
    Route::get('/logout', 'App\Http\Controllers\AdminController@logout')->name('logout');


Route::group(['middleware' => ['auth:admin']], function() {
//Route::get('/', 'App\Http\Controllers\FileImportDataController@fileImportExport')->name('import-file');
Route::post('file-import', 'App\Http\Controllers\FileImportDataController@fileImport')->name('file-import');
//Route::get('file-export', 'App\Http\Controllers\UserController@fileExport')->name('file-export');
//Crud
Route::get('/create-product', 'App\Http\Controllers\FileImportDataController@orderCreateView')->name('create');
Route::post('product_create', 'App\Http\Controllers\FileImportDataController@orderCreate')->name('order-create');
Route::get('/product-list', 'App\Http\Controllers\FileImportDataController@listOfOrder')->name('order-list');
Route::get('/task/{id}', 'App\Http\Controllers\FileDataHandleController@updateOrderInformation')->name('task-update-info');
Route::post('/task-update/{id}', 'App\Http\Controllers\FileDataHandleController@updatedOrder')->name('order-update');
Route::delete('/delete/{id}', 'App\Http\Controllers\FileDataHandleController@deleteOrder')->name('delete');
Route::get('/search-data', 'App\Http\Controllers\FileDataHandleController@orderDateFilter')->name('date-filter');
Route::get('/dashboard', 'App\Http\Controllers\FileDataHandleController@dataCount')->name('dashboard');
});

});
