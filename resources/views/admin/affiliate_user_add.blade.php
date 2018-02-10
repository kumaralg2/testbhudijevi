@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')
<div class="row"> 
	<div class="container-fluid bg-primary-color course-highlight">
		<div class="row">
			<div class="container">
				<div class="col-md-7">
					<p class="course-title-big">Settings</p>            
				</div>            
			</div>
		</div>
	</div>
	<div class="container-fluid cbc profileTemp">
		<div class="row">
			<div class="container">
				<ol class="breadcrumb">
					<li><a href="http://bhudhijeevi">Home</a></li>
					<li class="active">Settings</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<div class="col-md-3"> 
					@include('includes/admin-menu')					
				</div>
				<div class="col-md-9">
					<div class="takshaInfo">
					<ul class="">
						<li style="display: block;" class="dashboardtab profileList">
						<h3>Add New Affiliate User</h3>
				              <div class="col-md-12">
                        <form action="" method="post" id="InstitutesSignUp">
                            <!---->
                            <div class="col-md-12" >
                                <div class="fields">
                                    <label for="iName">Institute Name*</label>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="text" value="" placeholder="Institute Name *" id="iName" name="iName" />
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="fields">
                                    <label for="ufName">User First Name*</label>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="text" value="" placeholder="First Name *" id="ufName" name="ufName" />
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <div class="fields">
                                    <label for="ulName">User Last Name*</label>
                                    <input type="text" value="" placeholder="Last Name *" id="ulName" name="ulName" />
                                </div>
                            </div>
                            <!---->
                            <!---->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fields">
                                            <label for="eAddress">Email Address*</label>
                                            <input type="text" value="" placeholder="Email Address *" id="eAddress" name="email" type="email" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <!---->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fields">
                                            <label for="mNumber">Mobile Number*</label>
                                            <input type="text" value="" placeholder="Mobile Number*" id="mNumber" name="phone" maxlength="10" type="tel" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fields">
                                            <label for="passWord">Password*</label>
                                            <input type="password" value="" placeholder="Password *" id="passWord" name="password" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-12">
                                <p id="LoadingImag"></p>
                                <p style="color:red" id="resmsg"></p>
                            </div>
                            <!---->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="fields submit">
                                            <input type="submit" name="submit" id="submit" value="Submit"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </form>
                    </div>
                          	  
                    </div>
                </div>
            </div>
</div>
</div>
</div>
@endsection
@section('page_script')
<script>
$("#InstitutesSignUp").validate({
    		rules: {
    			iName: 'required',
    			ufName: 'required',
    			ulName: 'required',
    			email: {
    			required: true,
    			email: true
    			},								
    			phone: {
    			required: true,
    			minlength: 10,
    			number: true,
    			},	
    			password: {
    			required: true,
    			minlength: 6
    			},				
    		},
    		messages: {
    		  // iName: "Please enter your Institute name",
    		  // ufName: "Please enter your first name",
    		  // ulName: "Please enter your last name",
    		  // email: "Please enter valid email address",
    		  // phone: "Please enter valid mobile number",
    		  // password: "Please enter password minimum six digit",
    		},
    		submitHandler: function(form) {
    			var formData = $("form#InstitutesSignUp").serialize()
    			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
    			$.ajax({
    				url: '/admin/affiliate-user-add',
    				type: 'POST',
    				data: formData,
    				dataType: "json",
    				success: function (data) {
    					$('p#LoadingImag').html('');
    					if(data.status == 'success'){
    						document.getElementById('InstitutesSignUp').reset();
							$('p#resmsg').html('Success');
    					}else{
    						$('p#resmsg').html(data.msg);
    					}
    					
    				}
    			});
    		},
    	});
</script>
@endsection

