@extends('layouts.master')
@extends('layouts.customer-sidebar')
@section('content')
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Change Password</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
								@foreach ($errors->all() as $error)
									<p>{{ $error }}</p>
								@endforeach
						</div>
					@endif
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
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/account/change-password') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">						

						<div class="form-group">
							<label class="col-md-4 control-label">Current Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="current_password" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">New Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm New Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@endsection
