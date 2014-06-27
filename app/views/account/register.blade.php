<!DOCTYPE html>

<html>
	<body>
		<h1>This is my starting page </h1>
		<form method="POST" action= " {{ url('account/register') }} " >

			First Name <input type="text" name="firstname"/>

			@if($errors->has('firstname'))
				{{ $errors->first('firstname') }}
			@endif<br/>

			Last Name<input type="text" name="lastname"/>
			@if($errors->has('lastname'))
				{{ $errors->first('lastname') }}
			@endif<br/>

			Email<input type="email" name="email"/>
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif<br/>

			Username<input type="text" name="username" placeholder="username or email"/>
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif<br/>

			Password<input type="password" name="password" placeholder="password"/>
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif<br/>

			<input type="submit" name="sign up">
			
			@if(Session::has('msg'))
				{{ Session::get('msg') }}
			@endif

		</form>
	</body>
</html>
