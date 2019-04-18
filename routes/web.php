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
Route::group(['prefix' => 'my'], function() {
    Route::get('/likes', 'ShotController@mylikes')->name('likes.mine');
    Route::get('/shots', 'ShotController@mine')->name('shots.mine');
    Route::get('/discussions', 'DiscussionController@mine')->name('discussions.mine');
    Route::get('/requests', 'RequestsController@mine')->name('requests.mine');
});

Route::get('/profile/settings/avatar', 'UserController@avatar')->name('user');
Route::post('/profile/settings/avatar', 'UserController@upload')->name('user.upload');

Route::get('/profile', 'UserController@ownProfile')->name('profile');
Route::get('/profile/{id}', 'UserController@profile')->name('profile.view');

/*! Users */
Route::get('/users', 'UserController@index')->name('users');

/*! Grant Admin */
Route::get('/grantadmin', 'UserController@newRole')->name('grantadmin');

/*! Shots */
Route::group(['prefix' => 'shots'], function() {
        
    Route::get('/', 'ShotController@index')->name('shots');
    Route::get('/add', function() {
        return view('shots.add');
    })->name('shots.getAdd');

    Route::post('/add', 'ShotController@store')->name('shots.add');

    Route::get('/{id}', 'ShotController@view')->name('shots.view');
    Route::get('/{id}/like', 'ShotController@like')->name('shots.like');

});

/*! Discussions */
Route::group(['prefix' => 'discussions'], function() {
    
    Route::get('/', 'DiscussionController@index')->name('discussions');
    Route::post('/', 'DiscussionController@store')->name('discussions.store');
    Route::get('/create', 'DiscussionController@create')->name('discussions.create');
    Route::get('/categories', 'CategoryController@index')->name('discussions.categories');
    Route::get('/{category}', 'DiscussionController@showByCategory')->name('discussions.showByCategory');
    Route::get('/{category}/{discussion}', 'DiscussionController@show')->name('discussions.show');
    Route::post('/{category}/{discussion}/answers', 'AnswerController@store')->name('answers.store');

});

});

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', 'AdminController@index')->name('admin');
    Route::get('/discussions/categories/add', 'CategoryController@create')->name('categories.add');
    Route::post('/discussions/categories/add', 'CategoryController@store')->name('categories.store');

    Route::group(['prefix' => 'privileges'], function() {
        Route::get('/', 'PrivilegeController@index')->name('privileges');
        Route::post('/', 'PrivilegeController@store')->name('privileges.store');
        Route::get('/add', 'PrivilegeController@create')->name('privileges.create');
    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', 'RoleController@index')->name('roles');
        Route::post('/', 'RoleController@store')->name('roles.store');
        Route::get('/add', 'RoleController@create')->name('roles.create');
        Route::get('/{id}/permissions', 'RoleController@permissions')->name('roles.permissions');
        Route::post('/{id}', 'RoleController@storePermissions')->name('roles.storePermissions');
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UserController@adminIndex')->name('users.admin');
        Route::get('/{id}/edit', 'UserController@edit')->name('users.edit');
        Route::post('/{id}', 'UserController@save')->name('users.save');
    });
});