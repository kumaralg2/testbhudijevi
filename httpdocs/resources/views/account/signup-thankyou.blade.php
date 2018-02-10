@extends('layouts.master')

@section('content')
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Signup Thankyou!

					<div>Thank you for signing up with BuddhiJeevi. Please verify your email....</div>

				</div>
				<div class="panel-body">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



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
					
				</div>
			</div>
		</div>
@endsection
