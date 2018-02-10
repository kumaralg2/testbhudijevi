 $(function() {
     $("#BatchStartDate").datepicker({
         dateFormat: 'yy/mm/dd'
     });
     $("#BatchEndDate").datepicker({
         dateFormat: 'yy/mm/dd'
     });
     $("#ExpirationDate").datepicker({
         dateFormat: 'yy/mm/dd'
     });
 });
 $("#CourseCreation").validate({
     rules: {
         title: 'required',
         subTitle: 'required',
         sectorBlk: 'required',
         bie: 'required',
         categories: 'required',
         jobRoles: 'required',
         mode: 'required',
         summary: 'required',
         address: 'required',
         location: 'required',
         fname: 'required',
         lname: 'required',
         lname: 'required',
         types: 'required',
         programmename: 'required',
         BatchStartDate: 'required',
         BatchEndDate: 'required',
         ExpirationDate: 'required',
         govBody: 'required',
         fp: 'required',
         amount: 'required',
         insType: 'required',
         email: {
             required: true,
             email: true
         },
     },
     // messages: {
     // iName: "Please enter your Institute name"
     // },
     submitHandler: function(form) {
         var formData = $("form#CourseCreation").serialize();
         $('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
         $.ajax({
             url: '/create-course',
             type: 'POST',
             data: formData,
             dataType: "json",
             success: function(data) {
                 $('p#LoadingImag').html('');
                 if (data.status == 'success') {
                     $('p#resmsg').html(data.msg);
                     window.location = '/course-listing';
                 } else {
                     $('p#resmsg').html(data.msg);
                 }

             }
         });
     },
 });

 $("#EditCourse").validate({
     rules: {
         title: 'required',
         subTitle: 'required',
         sectorBlk: 'required',
         bie: 'required',
         categories: 'required',
         jobRoles: 'required',
         mode: 'required',
         summary: 'required',
         address: 'required',
         location: 'required',
         fname: 'required',
         lname: 'required',
         lname: 'required',
         types: 'required',
         programmename: 'required',
         BatchStartDate: 'required',
         BatchEndDate: 'required',
         ExpirationDate: 'required',
         govBody: 'required',
         fp: 'required',
         amount: 'required',
         insType: 'required',
         email: {
             required: true,
             email: true
         },
     },
     // messages: {
     // iName: "Please enter your Institute name"
     // },
     submitHandler: function(form) {
         var formData = $("form#EditCourse").serialize();
         $('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
         $.ajax({
             url: '/edit-course',
             type: 'POST',
             data: formData,
             dataType: "json",
             success: function(data) {
                 $('p#LoadingImag').html('');
                 if (data.status == 'success') {
                     $('p#resmsg').html(data.msg);
                     window.location = '/course-listing';
                 } else {
                     $('p#resmsg').html(data.msg);
                 }

             }
         });
     },
 });

 function startDateValidation(startdate) {
     var joindate = new Date();
     joindate.setDate(joindate.getDate() + 5);


     var startdate = Date.parse(startdate);

     if (joindate <= startdate) {
         $('#date_msg').html('');
     } else {
         $('#BatchStartDate').val('');
         $('#date_msg').html('Batch Start Date should be greater than 5 days from the current date');
     }
 }

 function endDateValidation(enddate) {
     var startdate = $('#BatchStartDate').val();
     if (new Date(enddate) > new Date(startdate)) {
         $('#date_msg').html('');
     } else {
         $('#BatchEndDate').val('');
         $('#date_msg').html('Batch End date should be greater than Batch Start Date');
     }
 }

 function expDateValidation(expdate) {
     var date = new Date();

     var startdate = $('#BatchStartDate').val();
     if ((new Date(expdate) < new Date(startdate)) && (new Date(expdate) >= new Date())) {
         $('#date_msg').html('');
     } else {
         $('#ExpirationDate').val('');
         $('#date_msg').html('Expiration date should be greater than current date but less than Batch Start date');
     }
 }

 function uploadImage() {

     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
     $('.loadingimage').html('<img src="/assets/images/ajax-loader.gif">');
     var token = $('#token').val();
     var file_data = $('#image_file').prop('files')[0];
     var form_data = new FormData();
     var image_type = $('#image_type').val();
     form_data.append('image_type',image_type);
     form_data.append('file', file_data);
     $('.invalid-msg').empty();
     $.ajax({
         url: "/upload-image",
         cache: false,
         contentType: false,
         processData: false,
         data: form_data,
         type: 'post',
         dataType: "json",
         success: function(data) {
            $('.loadingimage').html('');
            if(data.status === 'success'){
                $('.profileBox').html(data.img);
                $('.image_filename').val(data.filename);
            } else if (data.status === 'failed') {
                //window.location.href = data.redirect_url;
                $('.invalid-msg').html('<div class="alert alert-danger" role="alert"> <strong>Error! </strong>'+data.msg+'</div>');
            }
         }
     });
     return false;
 }

 function getInterest(id_category) {
     if (id_category != '') {
         var token = $('#token').val();
         $.ajax({
             url: '/get-interest',
             type: 'POST',
             data: "_token=" + token + "&id_category=" + id_category,
             success: function(data) {
                 $('#Interest').html(data);
             }
         });
     } else {
         $('#Interest').html('<option value="">Select</option>');
         $('#Categories').html('<option value="">Select</option>');
     }
 }

 function getCategory(id_sector) {
     if (id_sector != '') {
         var token = $("#token").val();
         $.ajax({
             url: '/get-category',
             type: 'POST',
             data: "_token=" + token + "&id_sector=" + id_sector,
             success: function(data) {
                 $("#Categories").html(data);
                 //getInterest($('#Categories :selected').val());
             }
         });
     } else {
         $('#Categories').html('<option value="">Select</option>');
     }
 }



 function getTrainer(email) {
     var atpos = email.indexOf("@");
     var dotpos = email.lastIndexOf(".");
     if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
         alert("Not a valid e-mail address");
         return false;
     }
     var formData = $("form#ScheduleNewBatch").serialize();
     $.ajax({
         url: '/get-trainer',
         type: 'POST',
         data: "_token=" + token + "&" + formData,
         success: function(data) {
             $('#trainer_userid').val(data.trainer_userid);
             $('#fname').val(data.trainer_fname);
             $('#lname').val(data.trainer_lname);
             $('#trainer_msg').html(data.msg);
         }
     });
 }