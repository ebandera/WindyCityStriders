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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('blog', 'BlogController@index');

Route::get('gallery', 'GalleryController@index');
Route::get('join', 'JoinController@index');
Route::get('team', 'TeamController@index');
Route::get('about', 'AboutController@index');
Route::get('contact','ContactController@index');
Route::any('sendMessage',function(){
	//return current request data
	var_dump(Input::all());
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
