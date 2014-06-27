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

Route::get('/', function(){
	return View::make('');
});

Route::get('account/register',array(
						'as'   => 'user-register',
						'uses' => 'RegisterController@getRegister'
					)
);

Route::get('account/login',array(
						'as'   => 'user-login',
						'uses' => 'LoginController@getLogin'
					)
);

Route::post('account/register',array(
						'as'   => 'user-register-post',
						'uses' => 'RegisterController@postRegister'
					)
);

Route::post('account/login',array(
						'as'   => 'user-login-post',
						'uses' => 'LoginController@postLogin'
					)
);

Route::get('/use',function()
{
	return "Users!";
});

Route::get('users',function()
{
	$userp = DB::select('select email from users where id=?',array(2)) ;//User::all();
	return View::make('users');//->with('users',$userp);
});

