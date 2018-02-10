@extends('layouts.master')
@section('title', 'Customer Login')
@section('content')
<div class="container cbc newSignUpTemp">
    <div class="row">
        <!--log in blk starts-->
        <div class="loginBlk">
            <div class="col-md-12">
                <div class="loginContainer">
                    <!---->
                    <h2>Log In</h2>
                    <p>New to Buddhijeevi ? <a href="#" class="signUpBtn"> Sign Up </a> for a free Account.</p>
                    <div class="logInBox">
                        <!---->
                        <div id="login_panel" class="ts_sign_wrapper">
                            <div class="ts_panel_form">
                                <form name="ts_login_form" id="ts_login_form" method="post" action="{{ URL::route('UserLogin') }}">
                                    <div class="fields">
                                        <label for="emailAdd">Email Address *</label>
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="text" name="email" id="emailAdd" placeholder="Email Address*" value="{{Request::cookie('email')}}"  />
                                    </div>
                                    <div class="fields">
                                        <label for="uName">Password *</label>
                                        <input type="password" maxlength="50" autocomplete="off" placeholder="Password" name="password" id="panel_field_password" class="panel_input panel_input_error">
                                    </div>
                                    <p id="LoadingImag"></p>
                                    <p id="Message"></p>
                                    <div class="fields checBoxFields">
                                        <label for="rememberuid">
                                        @if(Cookie::has('email'))
                                        <input type="checkbox" checked="" class="check_box" value="Y" name="remember" id="rememberuid">
                                        @else
                                        <input type="checkbox" class="check_box" value="Y" name="remember" id="rememberuid">
                                        @endif
                                        Remember me</label>
                                        <a href="{{ URL::route('ForgotPassword') }}" class="forgotPass">Forgot Password</a>
                                    </div>
                                    <!---->
                                    <div class="submitBlk">
                                        <div class="fields submit">
                                            <label for="submit">Submit</label>
                                            <input type="submit" value="Login" id="submit" name="submit"/>
                                        </div>
                                        <div class="ts_separation_wrapper">
                                            <div class="ts_separation_line"></div>
                                            <div class="ts_separation_text ">Or</div>
                                        </div>
                                        <div class="fields social">                                
                                            <?php                               
                                                $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
                                                $login_url = $fb->getLoginUrl(['email']);
                                                echo '<a class="facebook"  href="'.$login_url.'">Sign in  with Facebook</a>';
                                                ?>  								
                                        </div>
                                    </div>
                                    <!---->
                                    <!---->
                                </form>
                            </div>
                        </div>
                        <!---->
                        </form>                    
                    </div>
                    <!---->
                </div>
            </div>
        </div>
        <!--log in blk ends-->
        <!--sign up blk starts-->
        <div class="signUpBlk">
            <div class="headingArea">
                <h2>Sign Up <span class="smlTxt"><strong>for Free!</strong></span></h2>
                <p>Already have a Buddhijeevi Account ? <a href="#" class="logInBtn"> Log In </a></p>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="signUpHeader">
                        <div class="col-md-4">
                            <h3 class="active"><a href="studentSignUp">Student</a></h3>
                        </div>
                        <div class="col-md-4">
                            <h3><a href="instituteSignUp">Training Institute</a></h3>
                        </div>
                        <div class="col-md-4">
                            <h3><a href="trainerSignUp">Trainer</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!--student sign up column starts-->
            <div class="col-md-12 studentSignUp signUpSection">
                <div class="signUpBox">
                    <!---->
                    <div class="col-md-4">
                        <div class="imageBlk">
                            <img classs="img-responsive" src="{{asset('assets/images/system/student1.jpg')}}" />
                        </div>
                    </div>
                    <!---->
                    <!---->
                    <div class="col-md-8">
                        <form action="" method="post" id="StudentSignUp">
                            <!---->
                            <div class="col-md-6">
                                <div class="fields">
                                    <label for="ufName">First Name*</label>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="text" value="" placeholder="First Name *" id="ufName" name="ufName" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fields">
                                    <label for="ulName">Last Name*</label>
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
                                            <label for="submit">Submit</label>
                                            <input type="submit" name="submit" id="submit" value="Sign Up"/>
                                        </div>
                                    </div>
<!--                                    <div class="col-md-2">
                                        <div class="ts_separation_wrapper">
                                            <div class="ts_separation_line"></div>
                                            <div class="ts_separation_text ">Or</div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="fields social">
                                            <?php                               
                                                $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
                                                $login_url = $fb->getLoginUrl(['email']);
                                                echo '<a class="facebook fbLogin"  id="student" href="'.$login_url.'">Sign Up  with Facebook</a>';
                                                ?>                               
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <p class="smlTxt">* By Signing Up you agree to our <a href="/privacy-policy" target="_blank">Privacy Policy</a> and <a href="/terms-of-use" target="_blank">Terms of Use</a></p>
                        </form>
                    </div>
                </div>
            </div>
            <!--student sign up column ends-->
            <!--Institute sign up column starts-->
            <div class="col-md-12 instituteSignUp signUpSection">
                <div class="signUpBox">
                    <!---->
                    <div class="col-md-4">
                        <div class="imageBlk">
                            <img classs="img-responsive" src="{{asset('assets/images/system/instituite1.jpg')}}" />
                        </div>
                    </div>
                    <!---->
                    <!---->
                    <div class="col-md-8">
                        <form action="" method="POST" id="InstitutesSignUp">
                            <!---->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fields">
                                            <label for="iName">Name of the Institute</label>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="text" value="" placeholder="Institute Name *" id="iName" name="iName" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fields">
                                    <label for="ufName">First Name</label>
                                    <input type="hidden" value="1" name="nInstituteTypeID">
                                    <input type="text" value="" placeholder="Your First Name *" id="ufName" name="ufName" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fields">
                                    <label for="ulName">Last Name</label>
                                    <input type="text" value="" placeholder="Your Last Name *" id="ulName" name="ulName" />
                                </div>
                            </div>
                            <!---->
                            <!---->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fields">
                                            <label for="eAddress">Email Address</label>
                                            <input type="text" value="" placeholder="Email  *" id="eAddress" name="email"  type="email" />
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
                                            <label for="passWord">Password</label>
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
                                            <label for="submit">Submit</label>
                                            <input type="submit" name="submit" id="instituteSignupSubmit" value="Sign Up"/>
                                        </div>
                                    </div>
<!--                                    <div class="col-md-2">
                                        <div class="ts_separation_wrapper">
                                            <div class="ts_separation_line"></div>
                                            <div class="ts_separation_text ">Or</div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="fields social">
                                            <?php                               
                                                $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
                                                $login_url = $fb->getLoginUrl(['email']);
                                                echo '<a class="facebook fbLogin"  id="training institute manager" href="'.$login_url.'">Sign Up  with Facebook</a>';
                                                ?>										
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <!---->
                            <p class="smlTxt">* By Signing Up you agree to our <a href="/privacy-policy" target="_blank">Privacy Policy</a> and <a href="/terms-of-use" target="_blank">Terms of Use</a></p>
                        </form>
                    </div>
                    <!---->
                </div>
            </div>
            <!--Institute sign up column ends-->
            <!--Trainer sign up column starts-->
            <div class="col-md-12 trainerSignUp signUpSection">
                <div class="signUpBox">
                    <!---->
                    <div class="col-md-4">
                        <div class="imageBlk"> 
                            <img classs="img-responsive" src="{{asset('assets/images/system/trainer1.jpg')}}" />
                        </div>
                    </div>
                    <!---->
                    <!---->
                    <div class="col-md-8">
                        <form action="" method="POST" id="TrainerSignUp">
                            <!---->
                            <div class="col-md-6">
                                <div class="fields">
                                    <label for="ufName">First Name</label>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="text" value="" placeholder="First Name *" id="ufName" name="ufName" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fields">
                                    <label for="ulName">Last Name</label>
                                    <input type="text" value="" placeholder="Last Name *" id="ulName" name="ulName" />
                                </div>
                            </div>
                            <!---->
                            <!---->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="fields">
                                            <label for="eAddress">Email Address</label>
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
                                            <label for="passWord">Password</label>
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
                                            <label for="submit">Submit</label>
                                            <input type="submit" name="submit" id="submit" value="Sign Up" />
                                        </div>
                                    </div>
<!--                                    <div class="col-md-2">
                                        <div class="ts_separation_wrapper">
                                            <div class="ts_separation_line"></div>
                                            <div class="ts_separation_text ">Or</div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="fields social">                                
                                            <?php                               
                                                $fb = App::make('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
                                                $login_url = $fb->getLoginUrl(['email']);
                                                echo '<a class="facebook fbLogin"  id="trainer" href="'.$login_url.'">Sign Up  with Facebook</a>';
                                                ?>                               
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                            <!---->
                            <p class="smlTxt">* By Signing Up you agree to our <a href="/privacy-policy" target="_blank">Privacy Policy</a> and <a href="/terms-of-use" target="_blank">Terms of Use</a></p>
                        </form>
                    </div>
                    <!---->
                </div>
            </div>
            <!--Trainer sign up column ends-->                   
        </div>
        <!--sign up blk ends-->
    </div>
</div>
@endsection
@section('page_script')
<script>
    $("#instituteSignupSubmit").click(function(){
        var settings = $("#InstitutesSignUp").validate().settings;    
        settings.rules.email = {required: true,email:true};
        settings.rules.ufName = {required: true};
        settings.rules.ulName = {required: true};
        settings.rules.password =  {required: true,minlength: 6};
    
    
    });
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
    				url: '/account/i-registration',
    				type: 'POST',
    				data: formData,
    				dataType: "json",
    				success: function (data) {
    					$('p#LoadingImag').html('');
    					if(data.status == 'success'){
    						document.getElementById('InstitutesSignUp').reset();
    						window.location=data.redirect_url;
    					}else{
    						$('p#resmsg').html(data.msg);
    					}
    					
    				}
    			});
    		},
    	});
       $("#TrainerSignUp").validate({
    		rules: {
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
    		  // ufName: "Please enter your first name",
    		  // ulName: "Please enter your last name",
    		  // email: "Please enter valid email address",
    		  // phone: "Please enter valid mobile number",
    		  // password: "Please enter password minimum six digit",
    		},
    		submitHandler: function(form) {
    			var formData = $("form#TrainerSignUp").serialize()
    			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
    			$.ajax({
    				url: '/account/t-registration',
    				type: 'POST',
    				data: formData,
    				dataType: "json",
    				success: function (data) {
    					$('p#LoadingImag').html('');
    					if(data.status == 'success'){
    						document.getElementById('TrainerSignUp').reset();
    						window.location=data.redirect_url;
    					}else{
    						$('p#resmsg').html(data.msg);
    					}
    					
    				}
    			});
    		},
    	});
       $("#StudentSignUp").validate({
    		rules: {
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
    		//  ufName: "Please enter your first name",
    		 // ulName: "Please enter your last name",
    		 // email: "Please enter valid email address",
    		 // phone: "Please enter valid mobile number",
    		 // password: "Please enter password minimum six digit",
    		},
    		submitHandler: function(form) {
    			var formData = $("form#StudentSignUp").serialize()
    			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
    			$.ajax({
    				url: '/account/s-registration',
    				type: 'POST',
    				data: formData,
    				dataType: "json",
    				success: function (data) {
    					$('p#LoadingImag').html('');
    					if(data.status == 'success'){
    						document.getElementById('StudentSignUp').reset();
    						window.location=data.redirect_url;
    					}else{
    						$('p#resmsg').html(data.msg);
    					}
    					
    				}
    			});
    		},
    	});
    
    
       $('.fbLogin').click(function(event){
            event.preventDefault();
            type = $(this).attr('id');
            
            formData = {"_token": "{{ csrf_token() }}",usertype:type};
    
            if(type="training institute manager"){
                var settings = $("#InstitutesSignUp").validate().settings;
                delete settings.rules.ufName;
                delete settings.rules.ulName;
                delete settings.rules.email; 
                delete settings.rules.password; 
                if($("#InstitutesSignUp").valid()){
                     var currentForm = $(this);                 
                    formData =  {
                                    "_token": "{{ csrf_token() }}",
                                    "usertype":type,
                                    "phone":$("#InstitutesSignUp").find('input[name="phone"]').val(),
                                    "insname" : $("#InstitutesSignUp").find('input[name="iName"]').val()
                                };
                }else{
                    return false;
                }
            }
    
            redirectUrl = this.href;
            $.ajax({
                url:'/facebook/set-usertype',
                type:'POST',
                data:formData,
                dataType:"json",
                success:function(data){
                    event.preventDefault();                
                    if(data.status == 'success'){
                       window.location = redirectUrl;
                    }
    
                }
            });
    
       })
    
    	
</script>
@endsection