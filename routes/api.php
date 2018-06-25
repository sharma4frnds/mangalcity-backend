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

	Route::POST('getstate', 'Api\CommonController@getState');
	Route::POST('getdistict', 'Api\CommonController@getDistict');
	Route::POST('getcity', 'Api\CommonController@getCity');
	
	Route::POST('getprofile','Api\UserController@getprofile');
	Route::POST('userprofile','Api\UserController@userprofile');
	Route::POST('change_profile_image','Api\UserController@upload_image_changes');
	Route::POST('change_cover_image','Api\UserController@change_cover_image');
	Route::POST('change_password','Api\UserController@change_password');

	
	Route::post('auth/logout', 'Api\UserController@logout');
	Route::POST('getuser', 'Api\UserController@getAuthUser');
	Route::POST('/post','Api\PostController@posts');
	Route::POST('/feeds','Api\PostController@feeds');
	Route::POST('/dolike','Api\PostController@dolikes');
	Route::POST('/dodislikes','Api\PostController@dodislikes');	
	Route::POST('/share_post','Api\PostController@share_post');	
	Route::POST('/delete_post','Api\PostController@delete_post');
	Route::POST('/spam_tags','Api\CommonController@spam_tags');
	Route::GET('/download_image/{url}','Api\CommonController@download_image');
	Route::POST('/report_feedback','Api\CommonController@reportFeedback');

	
});


//login
Route::post('auth/login', 'Api\UserController@login');
Route::post('auth/register', 'Api\UserController@register');
Route::post('auth/resend_otp', 'Api\UserController@resend_otp');
Route::post('auth/verifyUser', 'Api\UserController@verifyUser');
Route::POST('forgot_password_otp','Api\UserController@forgot_password_otp');
Route::POST('forgot_change_password','Api\UserController@forgot_change_password');


Route::get('/test', function () {
    echo 'test';
});
