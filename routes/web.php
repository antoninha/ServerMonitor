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

Route::get('/', 'MonitorController@index');
Route::get('/list', 'MonitorController@index');
Route::get('/add', 'MonitorController@add');
Route::post('/add', 'MonitorController@add');
Route::get('/delete', 'MonitorController@delete');
Route::post('/delete', 'MonitorController@delete');