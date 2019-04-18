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

Route::middleware(['forbid-banned-user'])->group(function() {
    
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*! Requests */
Route::get('/requests', 'RequestsController@index')->name('requests');
Route::get('/requests/add', function () {
    return view('requests.add');
});

Route::post('/requests/add', 'RequestsController@store')->name('requests.add');

Route::get('/requests/view/{id}', 'RequestsController@look')->name('requests.view');
Route::post('/requests/reply/{id}', 'RequestsController@reply')->name('requests.reply');

/*! Profile */
Route::get('/profile/settings/avatar', 'UserController@avatar')->name('user');
Route::post('/profile/settings/avatar', 'UserController@upload')->name('user.upload');

Route::get('/profile', 'UserController@ownProfile')->name('profile');
Route::get('/profile/{id}', 'UserController@profile')->name('profile.view');

/*! Users */
Route::get('/participants', 'UserController@index')->name('users');

/*! Grant Admin */
Route::get('/grantadmin', 'UserController@newRole')->name('grantadmin');

/*! Shots */
Route::get('/shots', 'ShotController@index')->name('shots');
Route::get('/shots/add', function() {
    return view('shots.add');
})->name('shots.getAdd');

Route::post('/shots/add', 'ShotController@store')->name('shots.add');

Route::get('/shot/{id}', 'ShotController@view')->name('shot.view');
Route::get('/shot/{id}/like', 'ShotController@like')->name('shots.like');

/*! Discussions */
Route::get('/discussions', 'DiscussionController@index')->name('discussions');
Route::get('/discussions/create', 'DiscussionController@create')->name('discussions.create');
Route::post('/discussions', 'DiscussionController@store')->name('discussions.store');
Route::get('/discussions/categories', 'CategoryController@index')->name('discussions.categories');
Route::get('/discussions/{category}', 'DiscussionController@showByCategory')->name('discussions.showByCategory');
Route::get('/discussions/{category}/{discussion}', 'DiscussionController@show')->name('discussions.show');
Route::post('/discussions/{category}/{discussion}/answers', 'AnswerController@store')->name('answers.store');

});

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/discussions/categories/add', 'CategoryController@create')->name('categories.add');
    Route::post('/discussions/categories/add', 'CategoryController@store')->name('categories.store');
});