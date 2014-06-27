<?php

class RegisterController extends BaseController{
	
/*	public function check(){
	 	$fname = Input::get('firstname');
		$pressy = RegisterModel::check() ;
		$fdo = "false";
		echo $fname;
//		return View::make('index')->withpressy($pressy);//->withpressy($pressy)->withfdo($fdo);

	}*/

	public function getRegister(){
		return View::make('account.register');
	}

	public function postRegister(){

		//validates user input 
		$validator = Validator::make(
			Input::all(),
			array(
				'firstname' => 'required',
				'lastname'  => 'required',
				'email' 	=> 'required|unique:users',
				'username'	=> 'required|unique:users',
				'password'	=> 'required|min:7'
			)
		);

		if($validator->fails()){
			return Redirect::route('user-register')
				   ->withErrors($validator)
				   ->withInput();
		}else{
			$firstname = Input::get('firstname');
			$lastname  = Input::get('lastname');
			$email 	   = Input::get('email');
			$username  = Input::get('username');
			$password  = Hash::make(Input::get('password'));

			$user = User::create(
				array(
					'firstname' => $firstname,
					'lastname'  => $lastname,
					'email'		=> $email,
					'username'	=> $username,
					'password'	=> $password
				)
			);

			if($user){
				return Redirect::route('user-register')
					->with('msg','Your account has been created successfully.');
			}else{
				return Redirect::route('user-register')
					->with('msg','Some problem in creating your account.Try again later.');
			}
		}

	}
}

?>
