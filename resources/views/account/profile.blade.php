@extends('layouts.master')
@section('title', 'User profile ')
@section('content')
@include('includes/institute-profile')
@if( Auth::user()->nUsrRoleID == 1002 || Auth::user()->nUsrRoleID == 1003 ) 
	
@elseif( Auth::user()->nUsrRoleID == 1004 ) 
	
@endif
@endsection
@section('page_script')
<script>  
 $(document).ready(function(){
	 $('li').click(function(){
		 $('.ResponseMsg').html('');
		  });
	 
         $('.skillYN').click(function(){
            if($('.skillYN.yes').is(':checked') == true){
                $('#affiliatedsectors').css('display', 'block');
            }
            else if($('.skillYN.no').is(':checked') == true){
                $('#affiliatedsectors').css('display', 'none');
            }
        });
         $('.nsdcY').click(function(){ 
            if($('.nsdcY.yes').is(':checked') == true){ 
                $('#NSDCaffiliation').css('display', 'block');
            }
            else if($('.nsdcY.no').is(':checked') == true){ 
                $('#NSDCaffiliation').css('display', 'none');
            }
        });
    });
	
  $("#BasicInformation").validate({
		rules: {
			fName: 'required',
			lName: 'required',
			tsGender: 'required',
			tsEmail: {
			required: true,
			email: true
			},								
			mobile: {
			required: true,
			minlength: 10,
			maxlength: 10,
			number: true,
			},				
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#BasicInformation").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-profile',
				type: 'POST',
				data: formData+"&action=storeBasicInformation",
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				}
			});
		},
	});
  $("#EducationInfo").validate({
		rules: {
					
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#EducationInfo").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-educationinfo',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				}
			});
		},
	});
	 $("#Address").validate({
		rules: {
			tsAddress1: 'required',
			tsAddress2: 'required',
			locationid: 'required',
			state: 'required',
			pincode: 'required',
			tGoogleLoc: 'required',
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#Address").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-profile-address',
				type: 'POST',
				data: formData+"&action=storeAddress",
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				 }
			});
	}
	 });
	 $("#ResetPassword").validate({
		rules: {
			oldpassword: 'required',
		  newpassword : {
				required : true,
				minlength : 6,
			},
		  confirmpassword : {
				required : true,
				minlength : 6,
				equalTo : "#newpassword"
			},
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#ResetPassword").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/change-password',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				 }
			});
	}
	 });
	 $("#TIInfo").validate({
		rules: {
			tiName: 'required',
			insAddress1: 'required',
			insAddress2: 'required',
			inspincode: 'required',
			insstate: 'required',
			inslocationid: 'required',
			tGoogleInsLoc: 'required',
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#TIInfo").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-trainer-info',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				 }
			});
	}
	 });



	$("select.identityTypes").change(function () { 
    	$("select.identityTypes option[value='" + $(this).data('index') + "']").prop('disabled', false);
    	$(this).data('index', this.value);
    	$("select.identityTypes option[value='" + this.value + "']:not([value=''])").prop('disabled', true);
    	$(this).find("option[value='" + this.value + "']:not([value=''])").prop('disabled', false);
    });



	 $("#UserIdentityInfo").validate({
		rules: {
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#UserIdentityInfo").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-useridentity',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');					
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				 }
			});
	}
	 });
	 $("#AdditionalInfo").validate({
		rules: {
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#AdditionalInfo").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-user-lang',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				 }
			});
	}
	 });
	 $("#FacilitiesAvailable").validate({
		rules: {
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#FacilitiesAvailable").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-facilities',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				 }
			});
	}
	 });
	 $("#UpdatePAN").validate({
		rules: {
			panNo: 'required',
		},
		messages: {
		},
		submitHandler: function(form) {
			var formData = $("form#UpdatePAN").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/update-pan',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
					
				 }
			});
	}
	 });
	  function submitWorkExp(){
		  $('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
	  var formData = $("#WorkExp").serialize();
	   $.ajax({
             url: '/account/update-work-exp',
             type: 'POST',
             data: formData,
			 dataType: "json",
             success: function(data) {
                 $('p#LoadingImag').html('');
				 if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
             }
         });
	}
	  function submitClassroom(){
		  $('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
	  var formData = $("#submitClassroom").serialize();
	   $.ajax({
             url: '/account/update-classroom',
             type: 'POST',
             data: formData,
			 dataType: "json",
             success: function(data) {
                 $('p#LoadingImag').html('');
				 if(data.status == 'success'){
						$('.ResponseMsg').html(data.msg)
					}else{
						$('.ResponseMsg').html(data.msg)
					}
             }
         });
	}
	function getDistrict(state){
		var token = $('#token').val();
		$.ajax({
			url: '/get-district',
			type: 'POST',
			data: "_token="+token+"&state="+state,
			success: function (data) {
				$('#district').html(data);	
				//$('#district.dropdown').dropkick();	
				
			}
		});
	}
	function getInsDistrict(state){
		var token = $('#token').val();
		$.ajax({
			url: '/get-district',
			type: 'POST',
			data: "_token="+token+"&state="+state,
			success: function (data) {
				$('#insdistrict').html(data);			
			}
		});
	}
  </script>
@endsection
