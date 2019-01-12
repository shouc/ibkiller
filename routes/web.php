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


Route::prefix('contribute')->group(function () {
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

#Web Pages
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

#Mate Section
Route::get('/mate', 'MatesController@index')
	->name('mate.index');
Route::get('/findMate', 'MatesController@findMate')
	->name('mate.findMate');
Route::get('/disband', 'MatesController@disband')
	->name('mate.disband');

#Auth Section
Route::get('/userLogin', 'WebController@userLoginAPI')
	->name('web.userLogin');
Route::get('/userRegister', 'WebController@userRegisterAPI')
	->name('web.userRegister');
Route::get('/userLogout', 'WebController@userLogoutAPI')
	->name('web.userLogout');
Route::get('/confirm', 'WebController@confirm')
	->name('web.confirm');
Route::get('/resendAuth', 'WebController@resendAuth')
	->name('web.resendAuth');

#APIs
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
Route::get('/countUnreadMessage', 'WebController@countUnreadMessageAPI')
	->name('web.countUnreadMessage');


