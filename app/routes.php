<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
// App::missing(function($exception){
//     // return Response::view('errors.missing', array(), 404);
//     // if(Auth::check()){
//     // 	return Redirect::to('/home');
//     // }
//     return Redirect::to('/');
// });
header('Access-Control-Allow-Origin: *');
Route::get('/test', function(){
	// return User::find(1)->activities;
	$user = User::find(1);
	// $user->activities = User::find(1)->activities;
	$activities = User::find(1)->activities;
	// $user->custom = [];
	foreach ($activities as $activity){
		// $user->custom[] += $activity;
	}
	// $user->custom = $activities;
	return User::with('activities')->find(1);
	return $user;
	return $activities;
	// return Activity::find(1);
	// return User::find(1);
    // return View::make('layouts.master');
    // return View::make('pages.splash');
    // return View::make('index');
});
Route::get('/', function(){
	// return 'splash page';
    return View::make('index');
});
Route::group(array('prefix' => 'service'), function() {
    Route::resource('authenticate', 'AuthenticationController');
});
Route::group(['prefix'=>'v1/api'], function(){
	Route::resource('user', 'UserController');
	Route::resource('activity', 'ActivityController');
});
Route::get('jsonp', function(){
	return Response::json(array('name' => 'Steve', 'state' => 'CA'))->setCallback(Input::get('callback'));
});
// Route::match(['GET','POST'],'/login', function(){
//  if(Request::method() == 'GET'){
//      return 'login get';
//  } else if(Request::method() == 'POST'){
//      return 'login post';
//  }
// });
// Route::group(['before' => 'auth'], function(){
//     Route::get('/home', function(){
//         // Has Auth Filter
//         return "home";
//     });
//     Route::get('/play', function(){
//         // Has Auth Filter
//         return "play";
//     });
//     Route::get('/profile', function(){
//      return "profile";
//     });
//     Route::get('/community', function(){
//      return "community";
//     });
// });