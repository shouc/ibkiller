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
	Route::get('/', 'ContributeController@index')
		->name('home');
	Route::get('/add', 'ContributeController@add')
		->name('add');
	Route::post('/userAddQuestion', 'ContributeController@userAddQuestion')
		->name('userAddQuestion');
	Route::post('/upload', 'ContributeController@upload')
		->name('upload');
	Route::get('/showContributedQuestion', 'ContributeController@showContributedQuestion')
		->name('showContributedQuestion');
	Route::get('/modify', 'ContributeController@modify')
		->name('modify');
	Route::post('/userModifyQuestion', 'ContributeController@userModifyQuestion')
		->name('userModifyQuestion');
	//del before publish
	Route::post('/adminAddQuestion', 'ContributeController@adminAddQuestion')
		->name('adminAddQuestion');
	Route::get('/adminAdd', 'ContributeController@adminAdd')
		->name('adminAdd');
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
Route::get('/pricing', 'WebController@pricing')
    ->name('web.pricing');

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

Route::get('/payWithPaypal', 'PayController@payWithPaypal')
    ->name('pay.payWithPaypal');

Route::get('/payWithPaypalCompleted', 'PayController@payWithPaypalCompleted')
    ->name('pay.payWithPaypalCompleted');
Route::get('/payWithAlipay', 'PayController@payWithAlipay')
    ->name('pay.payWithAlipay');

Route::get('/payWithAlipayCompleted', 'PayController@payWithAlipayCompleted')
    ->name('pay.payWithAlipayCompleted');


Route::prefix('admin')->group(function () {
    Route::post('login', ['uses' => 'AuthController@login']);
    Auth::routes();
    Route::get('/', 'AdminController@indexOld')
        ->name('home');
    Route::get('/bulk', 'AdminController@bulkOld')
        ->name('bulk');
    Route::get('/add', 'AdminController@addOld')
        ->name('add');
    Route::get('/modify', 'AdminController@modifyOld')
        ->name('modify');

    Route::get('/api/questions', 'AdminController@questionsJSON')
        ->name('api.questions');
    Route::get('/api/stats', 'AdminController@stats')
        ->name('api.stats');
    Route::post('/api/modify', 'AdminController@modify')
        ->name('api.modify');
    Route::post('/api/add', 'AdminController@add')
        ->name('api.add');
    Route::get('/api/val', 'AdminController@val')
        ->name('api.val');
    Route::post('/api/pic_upload', 'AdminController@upload')
        ->name('api.upload');
    Route::get('/api/papers', 'AdminController@papersJSON')
        ->name('api.papers');
    Route::get('/api/paperModify', 'AdminController@paperModify')
        ->name('api.pm');
    Route::get('/api/del', 'AdminController@del')
        ->name('api.del');
});

Route::prefix('mail')->group(function () {
    Route::get('/tracing', 'WebController@tracing')
        ->name('mail.tracing');
    Route::get('/redirecting', 'WebController@redirecting')
        ->name('mail.redirecting');
});
