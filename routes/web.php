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



Route::post('login', ['uses' => 'AuthController@login']);

Auth::routes();

Route::get('/', 'HomeController@index')
	->name('home');
Route::get('/bulk', 'HomeController@bulk')
	->name('bulk');
Route::get('/add', 'HomeController@add')
	->name('add');
Route::get('/modify', 'HomeController@modify')
	->name('modify');

Route::get('/api/questions', 'QuestionController@questionsJSON')
	->name('api.questions');
Route::get('/api/stats', 'QuestionController@stats')
	->name('api.stats');
Route::get('/api/modify', 'QuestionController@modify')
	->name('api.modify');
Route::get('/api/add', 'QuestionController@add')
	->name('api.add');
Route::get('/api/val', 'QuestionController@val')
	->name('api.val');