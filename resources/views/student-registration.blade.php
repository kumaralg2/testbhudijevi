@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')
	@include('layouts/banner')
			
    				
	<div class="container cbc">	
      <div class="col-md-3">        
      </div>
      <div class="col-md-8">
	  <h3 class="text-center">Student Registration Form</h3> <br>
        <div class="takshaInfo">                      
             <form action="" method="post" id="studentRegistrationForm">
			 	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
								
                   
           <div class="col-md-10">
              <div class="fields">
                <label for="candidatename">Candidate Name </label>
                <input type="text" value="" id="candidatename" name="candidatename"  />								
              </div>
               </div>
			   <div class="col-md-10">
              <div class="fields">
                <label for="fathername">Father's Name </label>
                <input type="text" value="" id="fathername" name="fathername"  />				  
              </div>
               </div>
			   <div class="col-md-10">
              <div class="fields">
                <label for="mothername">Mother's Name </label>
                <input type="text" value="" id="mothername" name="mothername"  />				 
              </div>
               </div>
			    <div class="col-md-10">
              <div class="fields">
                <label for="gender">Gender </label>
                <input type="radio" value="male"   id="gender" name="gender" /> Male &nbsp; &nbsp;
                <input type="radio" value="female" id="gender" name="gender"  /> Female			
              </div>
               </div>		

			 <div class="col-md-10">
				<!--category-->
				<div class="fields">
                <label for="DOB">Date Of Birth</label>
					<input type="text" value=""  name="dob" id="DOB" class="datepicker" placeholder="yyyy-mm-dd">					
				</div>			
			</div>
			    <div class="col-md-5">
              <div class="fields">
                <label for="disability">Any Disability </label>
                <input type="radio" value="yes"   id="disability" name="disability"  /> Yes &nbsp; &nbsp;
                <input type="radio" value="no" id="disability" name="disability"  /> No				
              </div>
               </div>
			    <div class="col-md-5">
				<!--category-->
				<div class="fields">
                <label for="specify">If Yes, Specify:</label>
					<input type="text" value=""  name="specify" id="specify" >					
				</div>			
			</div>
			<div class="col-md-5">
              <div class="fields">
                <label for="mblnumber">Candidate Mobile Number </label>
                <input type="text" value="" id="mblnumber" name="mblnumber" maxlength="10"  />				  
              </div>
               </div>
			<div class="col-md-5">
              <div class="fields">
                <label for="mail">Email Id</label>
                <input type="text" value="" id="mail" name="email"  />				  
              </div>
               </div>			   
			<div class="col-md-10">
              <div class="fields">
                <label for="guardiannum">Guardian Contact Number </label>
                <input type="text" value="" id="guardiannum" name="guardiannum"  />				 
              </div>
               </div>
			<div class="col-md-10">
              <div class="fields">
                <label for="aadhar">Aadhar Card No </label>
                <input type="text" value="" id="aadhar" name="aadhar" maxlength="12" />				 
              </div>
               </div>
			<div class="col-md-10">
              <div class="fields">
                <label for="location">Current Location </label>
                <input type="radio" value="urban"   id="location" name="location"  /> Urban &nbsp; &nbsp;
                <input type="radio" value="semiurban" id="location" name="location"  /> Semi Urban	&nbsp; &nbsp;			
                <input type="radio" value="rural" id="location" name="location"  /> Rural				
              </div>
               </div>
			   <div class="col-md-10">
              <div class="fields">
                <label for="postaladdress">Postal Address</label>
                <input type="text" value="" id="postaladdress" name="postaladdress"  />				 
              </div>
               </div>
			<div class="col-md-10">
              <div class="fields">
                <label for="city">City/District </label>
                <input type="text" value="" id="city" name="city"  />
				 
              </div>
               </div>
			   <div class="col-md-5">
              <div class="fields">
                <label for="pincode">Pincode </label>
                <input type="text" value="" id="pincode" name="pincode"  />
				  <input type="hidden" name="image_filename" class="image_filename">              </div>
               </div>
			   <div class="col-md-5">
              <div class="fields">
                <label for="state">State</label>
                <input type="text" value="" id="state" name="state"  />				  
              </div>
               </div>
			   <div class="col-md-10">
              <div class="fields">
                <label for="googlelocation">Google Location </label>
                <input type="text" value="" id="googlelocation" name="googlelocation"  />
				 
              </div>
               </div>
			   <div class="col-md-5">
              <div class="fields">
                <label for="number">Any Other Phone Number:</label>
                <input type="text" value="" id="number" name="number"  />				  
              </div>
               </div>
			   <div class="col-md-5">
              <div class="fields">
                <label for="income">Monthly Family Income</label>
                <input type="text" value="" id="income" name="income"  />				  
              </div>
               </div>
			   <div class="col-md-5">
              <div class="fields">
                <label for="driving_license">Driving License</label>
                <input type="radio" value="Yes" id="location" name="driving_license"  /> Yes &nbsp; &nbsp;                	
                <input type="radio" value="No"  id="location" name="driving_license"  /> No				
              </div>
               </div>
			   <div class="col-md-5">
              <div class="fields">
                <label for="provide">If Yes,Provide Number </label>
                <input type="text" value="" id="provide" name="provide"  />				  			
              </div>
               </div>
			   <div class="col-md-10">
             
                <label for="qualification">Qualification </label>
                <table id="example2" class="table table-bordered table-hover qualification">                
				<thead>
                <tr>
                  <th>Educational Qualification</th>
                  <th>Year</th>                  
                  <th>Completed</th>
                  <th>Could Not Pass</th>
                  <th>School/Institute</th>
				  </tr>				  
                </thead>
                <tbody>				
                <tr>
                  <th>10th</td>
                  <td class="fields1"> <input type="text" name="year_10th"></td>                  
                  <td class="fields1"> <input type="text" name="completed_10th"></td>                   
                   <td class="fields1"> <input type="text" name="could_not_pass_10th"></td>                  
                  <td class="fields1"> <input type="text" name="institute_10th"></td>              
                </tr>
				<tr>
                  <th>12th</td>
                  <td class="fields1"> <input type="text" name="year_12th"></td>                     
                  <td class="fields1"> <input type="text" name="completed_12th"></td> 
				 <td class="fields1"> <input type="text" name="could_not_pass_12th"></td>                    
                 <td class="fields1"> <input type="text" name="institute_12th"></td>               
                </tr>
				<tr>
                  <th>Other(Mention)</td>
                  <td class="fields1"> <input type="text" name="year_other"></td>            
                  <td class="fields1"> <input type="text" name="completed_other"></td>  
				  <td class="fields1"> <input type="text" name="could_not_pass_other"></td>  				  
                  <td class="fields1"> <input type="text" name="institute_other"></td>                 
                </tr>				
				</tbody>
				</table>	             
               </div>
				<div class="col-md-10">
              <div class="fields">
                <label for="doing">What Is The Student doing at Present?</label>
                <input type="text" value="" id="doing" name="doing"  />				  
              </div>
               </div>
			   <div class="col-md-10">
              <div class="fields">
                <label for="travel">Willingness To Travel To Work EveryDay:</label>
                <input type="radio" value="Less Than 20Kms" id="travel" name="travel"  /> Less Than 20Kms &nbsp; &nbsp;                	
                <input type="radio" value="More than 20 Kms"  id="travel" name="travel"  /> More than 20 Kms &nbsp; &nbsp; 	
                <input type="radio" value="Migration to Metro Cities"  id="travel" name="travel"  />  Migration to Metro Cities	
              </div>
               </div>
			   <div class="col-md-10">
			   <div class="fields">
                <label for="work">Work Experience? If Yes, Please Give Details :</label>  
				<input type="text" value="" id="work" name="work_experience"  />				
              </div>
              </div>
			   <div class="col-md-10">
			   <div class="fields">
                <label for="mention"> 1.Please mention about your Family Members<br>(ನಿಮ್ಮ ಮನೆಯಲ್ಲಿನ ಸದಸ್ಯರು ಯಾರು?)</label>
                <input type="text" value="" id="mention" name="familydetails"  />				 
              </div>
              </div>
			  <div class="col-md-10">
			   <div class="fields">
                <label for="hobbies"> 2.Please tell us about your Interests and Hobbies<br>(ನಿಮ್ಮ ಕೆಲಸದ ಆಸಕ್ತಿಗಳು ಮತ್ತು ಹವ್ಯಾಸಗಳು ಯಾವುವು?)</label>
                <input type="text" value="" id="hobbies" name="hobbies"  />				 
              </div>
              </div>
			  <div class="col-md-10">
			   <div class="fields">
                <label for="intersred"> 3.Are you interested to Migrate to Cities for Work? If So, Why?<br>(ನೀವು ನಗರಗಳಲ್ಲಿ ಕೆಲಸ ಮಾಡಲು ಆಸಕ್ತಿ ಹೊಂದಿರುವಿರಾ? ಹಾಗಿದ್ದರೆ, ಯಾಕೆ?)</label>
                <input type="text" value="" id="intersred" name="intersred"  />				 
              </div>
              </div>
			  <div class="col-md-10">
			   <div class="fields">
                <label for="reason"> 4.Please give us the reasons, why you would like to avail this Free/Subsidized scholarship from our Clients?<br> (ಈ ಉಚಿತ / ಅನುದಾನಿತ ವಿದ್ಯಾರ್ಥಿವೇತನ ನಿಮಗೆ ಏಕೆ ಬೇಕು?)</label>
                <input type="text" value="" id="reason" name="reason"  />				  
              </div>
              </div>
			  <!--div class="col-md-10">
              <div class="fields">
                <label for="provided">Mandatory Enclosures Provided: </label>

                <input type="checkbox" value="marksheet"   id="provided" name="marksheet"  /> 10th Mark Sheet / Highest qualification Marksheet &nbsp; &nbsp;<br>
                <input type="checkbox" value="aadharcard" id="provided" name="aadharcard"  /> Identity Proof (Aadhar Card)	&nbsp; &nbsp;<br>			
                <input type="checkbox" value="votercard" id="provided" name="votercard"  /> Address Proof (Voter Id Card / Ration Card / Passport / Driving License)&nbsp; &nbsp;<br>			
                <input type="checkbox" value="passport" id="provided" name="passport"  /> Two Passport Sized Color Photographs	&nbsp; &nbsp;	<br>		
                <input type="checkbox" value="bankaccount" id="provided" name="bankaccount"  /> Bank Account Number				
              </div>
               </div-->
			   <div class="col-md-10">
                    <div class="fields submitFields">
					<p id="studregistation"></p>
                      <button type="submit" class="blueBtn">Save</button><br><br>
                    </div>
                 </div>
			   			   
			    </div>	
          </form>
        </div>
      </div>
     </div>
  
@endsection
@section('page_script')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
<script type="text/javascript">

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target.result);
                $('.profileBox').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
	
$("#studentRegistrationForm").validate({
     rules: {
         candidatename: 'required',
         //fathername: 'required',        
         dob: 'required',
         gender: 'required',            
         //postaladdress: 'required',
         //city: 'required',
         //pincode: 'required',
         //state: 'required',
         googlelocation: 'required',
         number: 'required',
         income: 'required',
         //doing: 'required',
         //familydetails: 'required',
         //hobbies: 'required',
         //intersred: 'required',
         //reason: 'required',
         disability: 'required',
         location: 'required',
         //driving_license: 'required',
         travel: 'required',
         //year_10th: 'required',
         //completed_10th: 'required',
         //could_not_pass_10th: 'required',
         //institute_10th: 'required',
		 email: {
			 required: false,
			 email:true
			},
		 aadhar: {
			 required: true,
			 minlength: 12,
			 maxlength: 12,
			 number: true,
			 
			},
		  mblnumber: {
			 required: true,
			 minlength: 10,
			 maxlength: 10,
			 number: true,
			},
		 
                  
         
     },
	 submitHandler: function(form) { 
         var formData = $("form#studentRegistrationForm").serialize();
        // $('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
         $.ajax({
             url: '<?php echo URL::to('add-student-registation'); ?>',
             type: 'POST',
             data: formData,
             dataType: "json",
             success: function(data) {
                 //$('p#LoadingImag').html('');
                 if (data.status == 'success') { 
                     $('#studregistation').html('<spn style="color:green">Registration Successfully Completed</span>');
					 document.getElementById("studentRegistrationForm").reset();
                    // window.location = '/course-listing';
                 } else { 
                     $('#studregistation').html('<spn style="color:red">'+data.msg+'</span>');
                 }

             }
         });
     },
	 });
	 
	  function initAutocomplete() {
      
      var userAddress = document.getElementById('googlelocation');
      var option =  {
                      types : [ '(regions)' ],
                      componentRestrictions : {country : "IN"}
                    };

      new google.maps.places.Autocomplete(userAddress,option);


      var instituteAddress = document.getElementById('googlelocation');
      new google.maps.places.Autocomplete(instituteAddress,option);  
      
    }
</script>
 <style>
 .qualification .fields1{
	 padding:0;
	 margin:0;
 }
 .qualification .fields1 input[type="text"]{
	border:none;
	height:35px;
 }
 </style>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script src="{{asset('/assets/js/course.js')}}"></script>
   <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo env('GOOGLE_PLACE_SEARCH_KEY'); ?>&libraries=places&callback=initAutocomplete" async defer></script>
@endsection


