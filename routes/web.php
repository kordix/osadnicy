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

Route::get('test',function(){
    return redirect('login');
});


Route::patch('upgrade', 'MainController@upgrade');
Route::patch('quest', 'heroController@quest');




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
