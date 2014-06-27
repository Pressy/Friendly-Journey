<?php
	
	class LoginController extends BaseController{
		
		public function getLogin(){
			return View::make('account.login');
		}

		public function postLogin(){

			$validator = Validator::make(
				Input::all(),
				array(
					'username' => 'required',
					'password' => 'required'
				)
			);

			if($validator->fails()){
				return Redirect::route('user-login')
						->withErrors($validator)
						->withInput();
			}else{

				$remember = Input::has('remember') ? true : false ;
				$username = Input::get('username');
				$password = Input::get('password');

				$auth = Auth::attempt(
					array(
						'username' => $username,
						'password' => $password
					),
					$remember
				);

				if($auth){
					return Redirect::intended('/');
				}else{
					return Redirect::route('user-login')
							->with('global','Wrong Username or Password.');
				}
			}
		}

	}

?>
