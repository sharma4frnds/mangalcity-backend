<h1> Welcome To mangalcity</h1>
<form id="logout-form" action="{{ route('logout') }}" method="POST" >
				{{ csrf_field() }}
				<input type="submit" name="logout" value="logout">
				</form>