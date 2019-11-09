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

Route::get('/', 'MainController@index')->name('index');
Route::get('/edit', 'MainController@edit')->name('edit');

Route::patch('reset', 'MainController@reset')->name('reset');

Route::patch('update', 'MainController@updatestats')->name('test') ;
Route::get('statdata','MainController@getStats');

Route::patch('upgrade', 'MainController@upgrade');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
