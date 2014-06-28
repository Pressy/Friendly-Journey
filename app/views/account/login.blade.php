<!DOCTYPE html>

<html>
<body>
	<form method="POST" action=" {{ url('account/login') }} ">

		Username <input type="text" name="username" placeholder="username or email"/>
		@if($errors->has('username'))
			{{ $errors->first('username') }}
		@endif<br/>

		Password <input type="password" name="password" placeholder="password"/>
		@if($errors->has('password'))
			{{ $errors->first('password') }}
		@endif<br/>

		<input type="checkbox" name="remember"/><label for="remember">Remember Me</label>
		<br/>

		<input type="submit" value="Login"/>

		@if(Session::has('flash_notice'))
			{{ Session::get('flash_notice') }} 
		@endif

	</form>
</body>
</html>
