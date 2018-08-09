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
    return view('welcome');
});

Route::get('/todo/','MainController@index');
Route::get('/todo/add/{note}','MainController@add');
//Route::get('/tod/get','MainController@retrieveDb');
Route::get('/todo/edit','MainController@edit');
Route::get('/todo/remove','MainController@remove');