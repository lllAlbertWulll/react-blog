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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/show/{id}', 'HomeController@show');
Route::get('/about', 'HomeController@about');
Route::get('/jianli', 'HomeController@jianli');

// 后台
Route::get('/admin', 'AdminController@index')->name('admin');

/*********** comment ***********/
Route::post('/comment/store', 'CommentController@store')->name('addComment');
