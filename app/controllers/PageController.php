<?php

class PageController extends BaseController{

	public function getRegister(){
		return View::make('account.register');
	}

	public function getLogin(){
			return View::make('account.login');
		}
		
	public function getHome(){
		return View::make('home');
	}

}

?>
