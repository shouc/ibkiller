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


Route::prefix('admin')->group(function () {
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
	Route::get('/help', 'HomeController@help')
		->name('help');
	Route::get('/api/questions', 'QuestionController@questionsJSON')
		->name('api.questions');
	Route::get('/api/stats', 'QuestionController@stats')
		->name('api.stats');
	Route::post('/api/modify', 'QuestionController@modify')
		->name('api.modify');
	Route::post('/api/add', 'QuestionController@add')
		->name('api.add');
	Route::get('/api/val', 'QuestionController@val')
		->name('api.val');
	Route::post('/api/pic_upload', 'QuestionController@upload')
		->name('api.upload');
	Route::get('/api/papers', 'QuestionController@papersJSON')
		->name('api.papers');
	Route::get('/api/paperModify', 'QuestionController@paperModify')
		->name('api.pm');
	Route::get('/api/del', 'QuestionController@del')
		->name('api.del');
});

Route::get('/', 'WebController@home')
	->name('web.home');
Route::get('/history', 'WebController@history')
	->name('web.history');
Route::get('/category', 'WebController@category')
	->name('web.category');
Route::get('/question', 'WebController@question')
	->name('web.question');
Route::get('/check', 'WebController@check')
	->name('web.check');

Route::get('/message', 'WebController@message')
	->name('web.message');

Route::get('/userLogin', 'WebController@userLoginAPI')
	->name('web.userLogin');
Route::get('/userRegister', 'WebController@userRegisterAPI')
	->name('web.userRegister');
Route::get('/userLogout', 'WebController@userLogoutAPI')
	->name('web.userLogout');
Route::get('/userCommitAnswer', 'WebController@userCommitAnswerAPI')
	->name('web.userCommitAnswer');
Route::get('/userAddFavorite', 'WebController@userAddFavoriteAPI')
	->name('web.userAddFavorite');
Route::get('/userDelFavorite', 'WebController@userDelFavoriteAPI')
	->name('web.userDelFavorite');
Route::get('/showDiscussion', 'WebController@showDiscussionAPI')
	->name('web.showDiscussion');
Route::get('/addDiscussion', 'WebController@addDiscussionAPI')
	->name('web.addDiscussion');
Route::get('/delDiscussion', 'WebController@delDiscussionAPI')
	->name('web.delDiscussion');
Route::get('/likeDiscussion', 'WebController@likeDiscussionAPI')
	->name('web.likeDiscussion');
Route::get('/unlikeDiscussion', 'WebController@unlikeDiscussionAPI')
	->name('web.unlikeDiscussion');

Route::get('/showMessage', 'WebController@showMessageAPI')
	->name('web.showMessage');
Route::get('/readMessage', 'WebController@readMessageAPI')
	->name('web.readMessage');
Route::get('/readAllMessage', 'WebController@readAllMessageAPI')
	->name('web.readAllMessage');

