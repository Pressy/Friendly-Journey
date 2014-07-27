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

Route::get('/',array(
				'as'   => 'home',
				'uses' => 'PageController@getHome'
				)
);//->before('guest');

Route::get('account/register',array(
						'as'   => 'user-register',
						'uses' => 'PageController@getRegister'
					)
)->before('guest');

Route::get('account/login',array(
						'as'   => 'user-login',
						'uses' => 'PageController@getLogin'
					)
)->before('guest');

//	Route to activate user account

Route::get('activate/{id}/{key}',function($id,$key){
	$user = User::find($id);
	
	if(!empty($user)){
		
		if($user->activation_key == $key && $user->activated == 0){
		
			$user->activated = 1 ;
			$user->save();

			Auth::login($user);

			return Redirect::route('home')
					->with('flash_notice','Your account has been activated.');
		}else{

			if($user->activation_key != $key){
				return Redirect::route('home')
						->with('flash_notice','Wrong Activation Key.');
			}else if($user->activated == 1){
				return Redirect::route('home')
						->with('flash_notice','Your account is already activated.');
			}
		}
	}else{
		return Redirect::route('home')
				->with('flash_notice','User not found.');
	}
});

//Route::get('account/activate','AccountActivationController@getConfirmation');

Route::get('logout',array(
					'as'   => 'user-logout',
					'uses' => 'AccountController@getLogout'
					)
);
		
Route::post('account/register',array(
						'as'   => 'user-register-post',
						'uses' => 'AccountController@postRegister'
					)
);

Route::post('account/login',array(
						'as'   => 'user-login-post',
						'uses' => 'AccountController@postLogin'
					)
);

/*
Route::get('/use',function()
{
	return "Users!";
});

Route::get('users',function()
{
	$userp = DB::select('select email from users where id=?',array(2)) ;//User::all();
	return View::make('users');//->with('users',$userp);
});
*/


