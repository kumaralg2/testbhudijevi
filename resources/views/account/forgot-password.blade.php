@extends('layouts.master')
@section('title', 'Forgot Password')
@section('content')
 <div class="container cbc newSignUpTemp">

  	<div class="col-md-12">
    	<p id="LoadingImag"></p>
		<p style="color:red" id="resmsg"></p>
    </div>

 	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>
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

 					<p class="smlTxt">Please enter your registered Email address and we’ll send you a link to reset your password</p>
					
					<form class="form-horizontal" role="form" method="POST" name="forgetPassword" id="forgetPassword" action="#">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<input type="submit" class="btn btn-primary" name="submit" id="submit" value="Send Password Reset Link"/>
								<?php if(isset($_GET['noheader'])){ ?>
								<a href="<?php echo URL::to('/'); ?>/account/login?noheader&nofooter" class="btn btn-primary" style="color:#fff" >Login/SignUp</a>
								<?php } ?>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>	
@endsection
@section('page_script')


<script type="text/javascript">
		
		$("#forgetPassword").validate({
		rules: {
			email: {
			     required: true,
			     email: true
			},				
		},
		messages: {
			 email: "Please enter valid email address",
		 
		},
		submitHandler: function(form) {
			var formData = $("form#forgetPassword").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/forgot-password',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						document.getElementById('forgetPassword').reset();
						//window.location=data.redirect_url;
						$('p#resmsg').html(data.msg);
					}else{
						$('p#resmsg').html(data.msg);
					}
					
				}
			});
		},
	});
	</script>
	@endsection