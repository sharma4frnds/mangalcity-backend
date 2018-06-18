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

Route::group(['middleware' => 'jwt.auth'], function () {

	Route::get('getstate', 'Api\CommonController@getState');
	Route::get('getdistict', 'Api\CommonController@getDistict');
	Route::get('getcity', 'Api\CommonController@getCity');
	Route::POST('userprofile','Api\UserController@userprofile');
	Route::POST('getuser', 'Api\UserController@getAuthUser');
	Route::POST('/post','Api\PostController@posts');	
});


//login
Route::post('auth/login', 'Api\UserController@login');
Route::post('auth/register', 'Api\UserController@register');
Route::post('auth/verifyUser', 'Api\UserController@verifyUser');
Route::post('auth/logout', 'Api\UserController@logout');

Route::get('/test', function () {
    echo 'test';
});
