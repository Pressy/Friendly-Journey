<!DOCTYPE html>

<html>
<body>
	<ul>
		<li>{{ HTML::linkRoute('home','Home') }}</li>
		<li>{{ HTML::linkRoute('home','Register Vehicle') }}</li>
		<li>{{ HTML::linkRoute('home','Search Vehicle') }}</li>
		@if(Auth::check())
			<li>{{ HTML::linkRoute('home','Profile') }}</li>
			<li>{{ HTML::linkRoute('home','Logout') }}</li>
		@else
			<li>{{ HTML::linkRoute('account/login','Login') }}</li>
			<li>{{ HTML::linkRoute('account/register','Signup') }}</li>
		@endif
	</ul>	
</body>
</html>
