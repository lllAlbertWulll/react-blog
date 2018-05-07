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

Route::middleware('api')->get('/articles/index', 'ArticleController@index_api');
Route::middleware('api')->get('/articles/{id}', 'ArticleController@show_api');
Route::middleware('api')->post('/articles/update', 'ArticleController@update_api');
Route::middleware('api')->post('/upload/cover', 'CommonController@uploadCover_api');
Route::middleware('api')->post('/upload/image', 'CommonController@uploadImage_api');