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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::get('/calculate', ['uses' => 'CurrenciesFeedController@index']);
//     Route::get('user', 'UserController@getAuthenticatedUser');
// });

Route::group(['prefix' => 'schedules'], function () {
    Route::get('/', ['uses' => 'ScheduleController@index']);
    Route::post('/store', ['uses' => 'ScheduleController@store']);
    Route::get('/{schedule}', ['uses' => 'ScheduleController@show']);
    Route::put('/{schedule}', ['uses' => 'ScheduleController@update']);
    Route::delete('/{schedule}', ['uses' => 'ScheduleController@delete']);
});

Route::group(['prefix' => 'movies'], function () {
    Route::get('/', ['uses' => 'MovieController@index']);
    Route::post('/store', ['uses' => 'MovieController@store']);
    Route::get('/{movie}', ['uses' => 'MovieController@show']);
    Route::put('/{movie}', ['uses' => 'MovieController@update']);
    Route::delete('/{movie}', ['uses' => 'MovieController@delete']);
});