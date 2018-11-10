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

Route::get('/', 'AppController@version')
	->name('version');
Route::get('/getPapers', 'AppController@getPapers')
	->name('getPapers');
Route::get('/getDetailOfPaper', 'AppController@getDetailOfPaper')
	->name('getDetailOfPaper');
Route::get('/commitAnswer', 'AppController@commitAnswer')
	->name('commitAnswer');
Route::get('/login', 'AppController@login')
	->name('login');
Route::get('/register', 'AppController@register')
	->name('register');
Route::get('/getDetailOfPID', 'AppController@getDetailOfPID')
	->name('getDetailOfPID');
Route::get('/getUserPID', 'AppController@getUserPID')
	->name('getUserPID');
Route::get('/addFavorite', 'AppController@addFavorite')
    ->name('addFavorite');
Route::get('/addDiscussion', 'AppController@addDiscussion')
    ->name('addDiscussion');
Route::get('/delDiscussion', 'AppController@delDiscussion')
    ->name('delDiscussion');
Route::get('/likeDiscussion', 'AppController@likeDiscussion')
    ->name('likeDiscussion');
Route::get('/unlikeDiscussion', 'AppController@unlikeDiscussion')
    ->name('unlikeDiscussion');
Route::get('/showDiscussion', 'AppController@showDiscussion')
    ->name('showDiscussion');