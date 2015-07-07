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


Route::get('gallerymain', 'GalleryController@main');
Route::get('admingallerymain', 'GalleryController@adminmain');

Route::get('gallery/{id}', 'GalleryController@index');
Route::get('admingallery/{id}', 'GalleryController@adminindex');
Route::post('insertGallery','GalleryController@insert');



Route::get('join', 'JoinController@index');
Route::get('adminjoin', 'JoinController@admin');
Route::post('saveJoinTextEdits','JsonRequestController@saveJoinTextEdits');
Route::post('uploadMembershipForm','JsonRequestController@uploadMembershipForm');

Route::get('team', 'TeamController@index');
Route::get('adminteam', 'TeamController@admin');
Route::get('team/{selectedYear}', 'TeamController@selectYear');
Route::get('adminteam/{selectedYear}', 'TeamController@adminSelectYear');

Route::get('about', 'AboutController@index');
Route::get('adminabout', 'AboutController@admin');
Route::post('uploadNewsletter', 'JsonRequestController@uploadNewsletter');

Route::get('contact','ContactController@index');
Route::get('admincontact','ContactController@admin');


Route::get('calendar','CalendarController@index');
Route::get('calendar/{id}','CalendarController@selectEvent');
Route::get('calendar/{direction}/{dateReference}','CalendarController@changeTime');
Route::get('admincalendar','CalendarController@admin');
Route::get('admincalendar/editEvent/{id}','CalendarController@editEvent');
Route::get('admincalendar/{id}','CalendarController@selectEventAdmin');
Route::get('admincalendar/{direction}/{dateReference}','CalendarController@changeTimeAdmin');
Route::post('getEventsForDateRange','JsonRequestController@getEventsForDateRange');  //returns Json
Route::post('getEventFromId','JsonRequestController@getEventFromId');               //returns Json
Route::post('updateEvent','JsonRequestController@updateEvent');
Route::post('updateEventData','JsonRequestController@updateEventData');
Route::post('addEvent','JsonRequestController@addEvent');
Route::post('deleteEvent','JsonRequestController@deleteEvent');
Route::post('updateBulkEvents','JsonRequestController@updateBulkEvents');


//Route::get('admincalendar/editEvent/{id}',function(){return phpinfo();});

Route::post('updateCarouselItem/{id}','JsonRequestController@updateCarousel');      //not Json
Route::post('deleteCarouselItem','JsonRequestController@deleteCarousel');
Route::post('uploadCarouselItem','JsonRequestController@uploadCarouselItem');

Route::post('uploadBlogItem','JsonRequestController@uploadBlogItem');

Route::post('uploadTeamImage','JsonRequestController@uploadTeamImage');
Route::post('updateTeam','JsonRequestController@updateTeam');
Route::post('deleteTeam','JsonRequestController@deleteTeam');

Route::post('updateAboutItem/{id}','JsonRequestController@updateAbout');
Route::post('updateAddress','JsonRequestController@updateAddress');
//Route::post('insertBlog','JsonRequestController@insertBlog');
Route::post('insertComment','JsonRequestController@insertComment');
Route::post('deleteComment','JsonRequestController@deleteComment');
Route::post('moveBlogUp','JsonRequestController@moveBlogUp');
Route::post('promoteToHomepage','JsonRequestController@promoteToHomepage');
Route::post('removeFromHomepage','JsonRequestController@removeFromHomepage');

Route:get('results','ResultsController@index');
Route::get('results/{id}','ResultsController@show');
Route::post('getResultsFromEventId','JsonRequestController@getResultsFromEventId');
Route::any('exportResultsToExcel/{id}','JsonRequestController@exportResultsToExcel');

Route::post('saveGalleryCaption','JsonRequestController@saveGalleryCaption');
Route::post('saveGalleryEdits','JsonRequestController@saveGalleryEdits');
Route::post('deleteGalleryItem','JsonRequestController@deleteGalleryItem');
Route::post('deleteGallery','JsonRequestController@deleteGallery');
Route::post('updateGalleryData','JsonRequestController@updateGalleryData');

Route::get('approveLogin','ApproveLoginController@index');
Route::get('sponsors','SponsorsController@index');
Route::get('adminsponsors','SponsorsController@admin');
Route::post('saveSponsorEdits','JsonRequestController@saveSponsorEdits');
Route::post('deleteSponsor','JsonRequestController@deleteSponsor');
Route::post('updateSponsorHeading','JsonRequestController@updateSponsorHeading');
Route::post('uploadSponsorImage','JsonRequestController@uploadSponsorImage');
Route::post('moveSponsorUp','JsonRequestController@moveSponsorUp');
Route::post('moveSponsorDown','JsonRequestController@moveSponsorDown');

Route::post('approveUser','JsonRequestController@approveUser');
Route::post('deleteUser','JsonRequestController@deleteUser');
Route::get('systemSettings','SystemSettingsController@index');
Route::post('updateSystemSettings','JsonRequestController@updateSystemSettings');

Route::post('contactusemail','EmailController@contactusemail');
Route::post('admincontactusemail','EmailController@index');
Route::post('approveuseremail','EmailController@approveuseremail');
    //'JsonRequestController@index');
Route::any('sendMessage',function(){
	//return current request data
	var_dump(Input::all());
});


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
