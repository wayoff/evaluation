<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'API'], function() {
	Route::post('/login', 'UsersController@login');
	Route::get('users', 'UsersController@index');
	Route::get('evaluations', 'EvaluationsController@index');
	Route::get('evaluations/{id}','EvaluationsController@show');
	Route::post('evaluations', 'EvaluationsController@store');
});
