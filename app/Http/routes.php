<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('adminhome','HomeController@admin');

Route::get('blog', 'BlogController@index');
Route::get('blog/{id}','BlogController@show');
Route::get('memberblog', 'BlogController@member');
Route::get('adminblog', 'BlogController@admin');


Route::get('gallery', 'GalleryController@index');
Route::get('admingallery', 'GalleryController@index');

Route::get('join', 'JoinController@index');
Route::get('adminjoin', 'JoinController@index');

Route::get('team', 'TeamController@index');
Route::get('adminteam', 'TeamController@admin');

Route::get('about', 'AboutController@index');
Route::get('adminabout', 'AboutController@admin');

Route::get('contact','ContactController@index');
Route::get('admincontact','ContactController@admin');


Route::get('calendar','CalendarController@index');
Route::get('calendar/{id}','CalendarController@selectEvent');
Route::get('calendar/{direction}/{dateReference}','CalendarController@changeTime');

Route::post('test',function(){return 'test3';});
Route::any('test',function(){return 'test1';});
Route::get('test',function(){return 'test2';});
Route::post('updateCarouselItem/{id}','JsonRequestController@updateCarousel');
Route::post('updateAboutItem/{id}','JsonRequestController@updateAbout');
Route::post('insertBlog','JsonRequestController@insertBlog');
Route::post('insertComment','JsonRequestController@insertComment');
Route::post('deleteComment','JsonRequestController@deleteComment');


    //'JsonRequestController@index');
Route::any('sendMessage',function(){
	//return current request data
	var_dump(Input::all());
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
