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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('test', function(){
    return 'It works!';
});


// login
Route::get('login', array('as'=>'login', 'before'=>'guest', 'uses'=>'AuthController@getLogin'));
Route::post('login', array('before'=>'guest','uses'=>'AuthController@postLogin'));
// regiseter
Route::get('register', array('as'=>'register', 'before'=>'guest','uses'=>'AuthController@getRegister'));
Route::post('register',array('before'=>'guest','uses'=>'AuthController@postRegister'));
// logout
Route::get('logout', array('as'=>'logout','before'=>'auth','uses'=>'AuthController@getLogout'));
// check
Route::get('check', 'AuthController@getCheck');
// password reminder
Route::controller('password', 'RemindersController');
// users
Route::get('user/{id}', 'UserController@showProfile');
Route::controller('users','UserController');
// invite
Route::controller('invite', 'InvitationController');
// families
Route::controller('families', 'FamilyController');
// groups
Route::controller('groups', 'GroupController');
// talks
Route::resource('talk','TalkController');
// messages
Route::resource('message','MessageController');