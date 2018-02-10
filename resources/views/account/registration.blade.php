@extends('layouts.master')
@section('title', 'Registration Page')
@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">Register</div>
			<div class="panel-body">
				@if(Session::has('errormsg'))
					<div class="alert alert-danger">
						{{ Session::get('errormsg') }}
					</div>						
				@endif
				<form id="RegisterForm" class="form-horizontal" role="form" method="POST" action="{{ url('/account/registration') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-md-4 control-label">Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">E-Mail Address</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Password</label>
						<div class="col-md-6">
							<input type="password" id="password" class="form-control" name="password">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Confirm Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password_confirmation">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Register
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@section('page_script')
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script>
$(function() {	
	$("#RegisterForm").validate({  
		rules: {
			name: "required",
			password: {
			required: true,
			minlength: 6
			},
			email: {
			required: true,
			email: true
			},
			password_confirmation : {
			equalTo : "#password"
			},
		},
		messages: {
		  name: "Please enter your Name",
		  email: "Please enter your EMail",
		  password: "Please enter password. The Password lenght should be a minimum 6 digit",
		  password_confirmation: "Password does't match",
		},	
	});
});
</script>
@endsection
