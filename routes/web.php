<?php

use Illuminate\Support\Facades\Route;

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

// Routes for customer
Route::prefix('customers')->group(function () {
    Route::get('/view', 'App\Http\Controllers\Backend\CustomerController@view')->name('customers.view');
    Route::get('/add', 'App\Http\Controllers\Backend\CustomerController@add')->name('customers.add');
    Route::post('/store', 'App\Http\Controllers\Backend\CustomerController@store')->name('customers.store');
    Route::get('/view/{id}', 'App\Http\Controllers\Backend\CustomerController@show')->name('customers.show');
    Route::get('/delete/{id}', 'App\Http\Controllers\Backend\CustomerController@delete')->name('customers.delete');
    Route::get('/edit/{id}', 'App\Http\Controllers\Backend\CustomerController@edit')->name('customers.edit');
    Route::post('/update/{id}', 'App\Http\Controllers\Backend\CustomerController@update')->name('customers.update');
    Route::post('/status', 'App\Http\Controllers\Backend\CustomerController@statusUpdate');
});
