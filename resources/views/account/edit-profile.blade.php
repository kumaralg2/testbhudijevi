@extends('layouts.master')
@extends('layouts.customer-sidebar')
@section('content')
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Edit  profile</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif					
					@if(Session::has('errormsg'))
						<div class="alert alert-danger">
							{{ Session::get('errormsg') }}
						</div>						
					@endif
					@if (count($errors) > 0)
						<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									<p>{{ $error }}</p>
								@endforeach
						</div>
					@endif

					<form id="EditProfile" class="form-horizontal" role="form" method="POST" action="{{ url('/account/edit-profile') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $customer->screen_name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ $customer->email }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Edit Profile
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
	$("#EditProfile").validate({  
		rules: {
			name: "required",
			email: {
			required: true,
			email: true
			},
		},
		messages: {
		  name: "Please enter your name",
		  email: "Please enter your eMail",
		},	
	});
});
</script>
@endsection