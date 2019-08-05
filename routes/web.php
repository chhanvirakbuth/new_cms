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

Route::get('/','FrontController@index')->name('home_page');
Route::get('/posts/{id}','FrontController@show')->name('show_page');

Auth::routes();
Route::middleware(['auth'])->group(function () {
  Route::get('/home', 'HomeController@index')->name('home');
  Route::resource('/category','CategoryController');
  Route::resource('/post','PostController');
  Route::resource('/tag','TagController');
  Route::get('trashed-post','PostController@trashed')->name('trashed-post.index');
  Route::get('restore-post/{id}','PostController@restore')->name('restore-post.restore');
  Route::get('user/profile','UserController@edit')->name('user-edit-profile');
  Route::put('user/profile','UserController@update')->name('user.update-profile');
});

Route::middleware(['auth','admin'])->group(function(){
  Route::get('user','UserController@index')->name('users.index');
  Route::post('user/{user}/make-admin','UserController@makeAdmin')->name('users.make-admin');
});
