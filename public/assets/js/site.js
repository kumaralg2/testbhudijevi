$(document).ready(function(){
   $("#forgot_pass").validate({
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
			var formData = $("form#forgot_pass").serialize();
			$('#LoadingImag_forgotpass').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/account/forgot-password',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('#LoadingImag_forgotpass').html('');
					$('#Message_forgotpass').html(data.msg);
				}
			});
		},
	});
   $("#FeedBackForm").validate({
        rules: {
            name: 'required',
            CaptchaCode: 'required',
            email: {
                    required: true,
                    email: true
            },								
            phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    number: true
            },							
            messages: {
                    required: true,
                    minlength:8,
                    maxlength:250
            },	
            requestType:{
                    required: true
            }
        },
        messages: {
            name: "Please enter your name",
            email: "Please enter valid email address",
            message: "Please enter your message",
            requestType :  "Please select an option from the list ",
            messages: {
                required: "Please enter your message",
                minlength: "Your message must contain at least 8 characters" ,
                maxlength: "Your message should contain a maximum 250 characters"
            },
            phone: {
                required: "Please enter your mobile number",
                minlength: "Your mobile number must 10 digit" ,
                maxlength: "Your mobile number must 10 digit"
            }
        },
//        submitHandler: function(form) {
//            var formData = $("form#FeedBackForm").serialize();
//            $('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
//            $.ajax({
//                url: '/send-feedback-mail',
//                type: 'POST',
//                data: formData,
//                dataType: "json",
//                success: function (data) {
//                    $('p#LoadingImag').html('');
//                    document.getElementById('FeedBackForm').reset();
//                    alert(data.msg);
//                }
//            });
//        }
    });
});