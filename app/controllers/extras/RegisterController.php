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
			$key	   = md5(time().$_SERVER['REMOTE_ADDR']);

			$user = User::create(
				array(
					'firstname'      => $firstname,
					'lastname'	     => $lastname,
					'email'			 => $email,
					'username'		 => $username,
					'password'		 => $password,
					'activated' 	 => 0,
					'activation_key' => $key
				)
			);

			if(!$user){
				return Redirect::route('user-register')
					->with('flash_notice','Some problem in creating your account.');
			}


			$to = $email;
			$subject = 'Activation for '.$username;
			$content = 'Hey there, '.$username.'
			<br/><br/>
			Thanks for registering.<br/>
			To activate your account, please click on this link.<br/>
			http://'.$_SERVER['SERVER_NAME'].'/activate/'.$user->id.'/'.$user->activation_key.'			<br/>
			<br/>
			<br/>
			Greetings,<br/>
			The	Admin 
			';

			$headers = 'From:activate@'.substr($_SERVER['SERVER_NAME'],4);

			$details = array(
				'to' 	  => $to,
				'name'	  => $username,
				'subject' => $subject,
				'content' => $content,
				'headers' => $headers
			);
//			mail($to,$subject,$message,$headers);

			$msg = 'Hey there '.$username.', <br/>

			Thanks for registering! <br/>
			We have sent a mail to '.$email.' with instructions to activate your account.
			<br/>
			<br/>
			Greetings,<br/>
			The Admin';
			
			$data = array('hello' => 'pressy') ;

			Mail::send('emails.message',$details,function($message) use ($details)
			{
				$message->to($details['to'],$details['name'])->subject($details['subject']);
			});

//			$user = User::where('username','=', $username)->first();

//			Auth::login($user);

			return Redirect::route('home')
					->with('flash_notice',$msg);
		}

	}
}

?>
