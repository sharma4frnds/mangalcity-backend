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


//Social Authentication
Route::get('login/facebook', 'Auth\SocialController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\SocialController@handleProviderCallback');
Route::get('login/google', 'Auth\SocialController@redirectToProvider');
Route::get('login/google/callback', 'Auth\SocialController@handleProviderCallback');
Route::get('login/twitter', 'Auth\SocialController@redirectToProvider');
Route::get('login/twitter/callback', 'Auth\SocialController@handleProviderCallback');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::post('auth/ragisterOtp', ['as' => 'ragisterOtp', 'uses' => 'Auth\RegisterController@ragisterOtp']);
Route::post('auth/resend_otp', ['as' => 'resend_otp', 'uses' => 'Auth\RegisterController@resend_otp']);

Route::get('forgot', 'Auth\ForgotPasswordController@forgotMobPass');
Route::POST('changepass_otp', 'Auth\ForgotPasswordController@changepass_otp');
Route::get('changepassword', 'Auth\ForgotPasswordController@getchangepassword');
Route::post('changepassword', 'Auth\ForgotPasswordController@changepassword');
Route::get('/','HomeController@index')->middleware('guest');


Route::get('apidoc',function(){
	return view('apidoc');
});

Route::group(['middleware' => 'auth'], function()
{
	Route::get('/user/profile','UserController@profile');
	Route::POST('/user/profile','UserController@update_profile');
	Route::POST('/getdistict/{id}','AjaxController@getDistict');
	Route::POST('/getcity/{id}','AjaxController@getCity');
	
	Route::group(['middleware' => 'user'], function()
	{
		Route::get('/user','UserController@index');
		Route::get('/imagepopup','UserController@imagepopup');
		Route::get('/coverpopup','UserController@coverpopup');
		Route::GET('/user/change_password','UserController@get_change_password');
		Route::POST('/user/change_password','UserController@change_password');
		Route::POST('/user/change_image','UserController@uploadImagechanges');
		Route::POST('/user/change_cover_image','UserController@change_cover_image');
		Route::get('/home','PostController@feeds');
		Route::POST('/post','PostController@posts');
		Route::POST('/dolike','PostController@dolikes');
		Route::POST('/dodislikes','PostController@dodislikes');
		Route::POST('/postComment','PostController@postComment');
		Route::POST('/deleteComment','PostController@deleteComment');
		Route::GET('/reportFeedback/{post_id}','PostController@reportPopup');
		Route::POST('/reportFeedback','PostController@reportFeedback');
		Route::POST('/delete_post_popup','PostController@delete_post_popup');
		Route::POST('/delete_post','PostController@delete_post');
		Route::POST('/share_post_popup','PostController@share_post_popup');
		Route::POST('/share_post','PostController@share_post');
		Route::GET('/download_image/{url}','HomeController@download_image');
		Route::GET('/change_location','HomeController@change_location');
		Route::GET('/image_popup/{url}','HomeController@image_popup');
		Route::GET('/activity','ActivityController@allactivity');


	});
});


Route::group(['middleware' => 'admin'], function()
{
	Route::get('admin','Admin\DashboardController@index');
	Route::get('admin/city','Admin\DashboardController@city');
	Route::get('admin/addcity','Admin\DashboardController@getcity');
	Route::POST('admin/addcity','Admin\DashboardController@addcity');
	Route::POST('admin/daleteCity','Admin\DashboardController@daleteCity');
	Route::get('admin/dashboard','Admin\DashboardController@index');
	Route::resource('admin/users','Admin\UserController');
	Route::resource('admin/tags','Admin\SpamtagController');
	Route::resource('admin/feedback','Admin\FeedbackController');

	
});

Route::get('admin/login','Admin\DashboardController@login');
