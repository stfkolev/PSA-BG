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

/*! Shots */
Route::get('/shots', 'ShotController@index')->name('shots');
Route::get('/shots/add', function() {
    return view('shots.add');
})->name('shots.getAdd');
Route::get('/shot/{id}', 'ShotController@view')->name('shot.view');

Route::post('/shots/add', 'ShotController@store')->name('shots.add');

