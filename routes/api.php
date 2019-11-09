<?php

use Illuminate\Http\Request;
use App\User;
use App\Stat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->patch('/update', 'MainController@updatestats' );
Route::middleware('auth:api')->get('statdata','MainController@getStats');





Route::patch('/upgrade', 'MainController@upgrade');

// Route::get('statdata','MainController@getStats');

Route::patch('update', 'MainController@updatestats') ;

Route::patch('reset','MainController@reset');

Route::get('userid','MainController@getUserId' );
