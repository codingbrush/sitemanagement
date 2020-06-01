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

Route::get('/', 'CustomerController@index')->name('customer.index');
Route::get('/customer/create', 'CustomerController@create')->name('customer.create');
Route::get('/customer/edit/{id}','CustomerController@edit')->name('customer.edit');
Route::post('/customer', 'CustomerController@store')->name('customer.store');
Route::put('/customer/{id}/update','CustomerController@update')->name('customer.update');