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

	if (auth()->guest()) {
	    return view('welcome');
	}

	if (auth()->user()->user_type == 'student') {
		return view('welcome');
	}

	return redirect('/home');

});

Route::get('/auth/change-password', 'UsersController@changePassword');
Route::post('/auth/change-password', 'UsersController@updatePassword');
Auth::routes();
Route::get('/answers/{answer_id}/student', 'AnswerController@show');
Route::get('/answers/{evaluation_id}', 'AnswerController@create');
Route::post('/answers/{evaluation_id}', 'AnswerController@store');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'admin'], function() {
	Route::post('/users/import', 'UsersController@import');
	Route::get('/users/students/delete', 'UsersController@deleteStudents');
	Route::resource('users', 'UsersController');
	Route::resource('questions', 'QuestionsController');
	Route::resource('categories', 'CategoriesController');
	Route::get('forms/{id}/faculties/{facultyId}/pdf', 'FormFacultiesController@pdf');
	Route::resource('forms/{id}/faculties', 'FormFacultiesController');
	Route::resource('forms', 'FormsController');
});
