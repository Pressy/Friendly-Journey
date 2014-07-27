<?php

class LogoutController extends BaseController{
	public function getLogout(){

		if(Auth::check()){
			Auth::logout();
			return Redirect::route('home')
					->with('flash_notice','You are successfully logged out.');
		}else{
			return Redirect::route('home');
		}
	}
}

?>
