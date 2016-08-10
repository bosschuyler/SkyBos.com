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

Route::get('/', function () {

	if (Auth::check())
	{
	    return Redirect::intended('home');
	} else {
		return view('welcome');
	}
    
});


Route::get('home', 'HomeController@index');

Route::get('tools/stair-calculator', 'ToolsController@stairCalculator');
Route::post('tools/stair-process', 'ToolsController@stairProcess');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::auth();

Route::get('/home', 'HomeController@index');
