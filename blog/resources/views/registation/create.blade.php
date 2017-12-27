@extends('layouts.master')

@section('content')
	<div class="col-sm-8 blog-main">
		<h1>Registration</h1>
		<hr>
		<form method="POST" action="/register">
			{{csrf_field()}}
			<div class="from-group"> 
				<label for="name">Name:</label>
				<input type="name" class="form-control" name="name" id="name" required>
			</div>
			<div class="form-group">
				<label for="email">Email:</label>
				<input type="email" id="email" name="email" class="form-control" required></input>
			</div>

			<div class="form-group">
				 <label for="password">Password:</label>
				 <input type="password" class="form-control" name="password" id="password" required>
			</div>

			<div class="form-group">
				 <label for="password_confirmation">Password Confirmation:</label>
				 <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Register</button>
			</div>	
		</form>

		@include ('layouts.errors')
	</div>
@endsection