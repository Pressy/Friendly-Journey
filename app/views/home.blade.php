<!DOCTYPE html>

<html>
<body>
	@if(Session::has('flash_notice'))
		<p>{{ Session::get('flash_notice')}}</p>
	@endif
	@if(Auth::check())
		{{ 'Hi '.Auth::user()->firstname.' '.Auth::user()->lastname }}
	@endif
	<ul>
		<li>{{ HTML::linkRoute('home','Home') }}</li>
		<li>{{ HTML::linkRoute('home','Register Vehicle') }}</li>
		<li>{{ HTML::linkRoute('home','Search Vehicle') }}</li>
		@if(Auth::check())
			<li>{{ HTML::linkRoute('home','Profile') }}</li>
			<li>{{ HTML::linkRoute('user-logout','Logout') }}</li>
		@else
			<li>{{ HTML::linkRoute('user-login','Login') }}</li>
			<li>{{ HTML::linkRoute('user-register','Signup') }}</li>
		@endif
	</ul>	
</body>
</html>
