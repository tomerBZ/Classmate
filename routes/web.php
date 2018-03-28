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
Auth::routes();

Route::get('/', 'WelcomeController@index')->name('welcome');


Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/destroy', 'UserController@destroy')->name('destroy.profile');
        Route::get('/profile', 'UserController@index')->name('my.profile');
        Route::get('/profile/edit', 'UserController@show')->name('show.profile');
        Route::put('/profile/edit', 'UserController@edit')->name('edit.profile');
        Route::post('/add/{user}', 'UserController@addFriend')->name('add.friend');
        Route::post('/approve/{user}', 'UserController@approveFriend')->name('approve.friend');
    });
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/MyPosts', 'PostsController@index')->name('my.posts');
        Route::post('/crate', 'PostsController@create')->name('create.post');
    });
});