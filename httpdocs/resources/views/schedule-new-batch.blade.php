@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')
	@include('layouts/banner')
			
					
	<div class="container cbc">
   
		
      <div class="col-md-3">
        <div class="row">
          <div class="subCategoriesBlk">
                       <h2>Course Information</h2>
            <ul>
                <li>Course Image
                	<span>Plase upload the relevant image that will describe the course</span>
                </li>
                <li>Course Details
                	<span>Please provide the Course Title description and the assoiciated industry sector</span>
                </li>

            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="takshaInfo">
          <form >
			
			 	
			   <div class="col-md-12">   
			  <div class="profileBox"><img src="/assets/images/{{$course->tImageFileName}}" />
				  
			  </div>
			  
     
            <h3>Basics</h3>
            <div class="col-md-6">
              <div class="fields">
                <label for="title">Title* ?</label>
                <input type="text" value="{{$course->tCoursetitle}}"    disabled>
              </div>
              <div class="fields">
                <label for="subTitle">Sub Title* ?</label>
                <input type="text" value="{{$course->tCoursesubtitle}}" disabled>
              </div>
            </div>
            <div class="col-md-6">
              <div class="fields">
                <label for="takshaLang">Language?</label>
				<?php
					$languages = DB::table('tbllanguagemaster')->whereNotIn('aCourseLangOptionID', [4,5])->get();
				?>
                <select disabled>				
                  <option value="">Select</option>
				  @foreach($languages as $language)
                  <option value="{{$language->aCourseLangOptionID}}" <?php if($course->nCourseLangOptionID == $language->aCourseLangOptionID){ echo "selected"; } ?> >{{$language->tCourseLangName}}</option>
				  @endforeach
                </select>
              </div>
              <div class="fields">
                <label for="sectorBlk">Sector* ?</label>
				<?php
					$sectors = DB::table('tblsectormaster')->get();
				?>
                <select disabled>
                  <option value="">Select</option>
				  @foreach($sectors as $sector)
                  <option value="{{$sector->aSectorID}}" <?php if($course->nSectorID == $sector->aSectorID){ echo "selected"; } ?>>{{$sector->tSectorName}}</option>
				  @endforeach
                </select>
              </div>
            </div>			  
            <div class="col-md-12">
              <div class="fields radioRow">
                <p>Complexity Level*?</p>				
				<?php
					$complexity = DB::table('tblcoursecomplexitymaster')->get();
				?>
				 @foreach($complexity as $complexity)
                <label for="{{$complexity->tCourseComplexity}}">{{$complexity->tCourseComplexity}}
                <input type="radio" value="{{$complexity->aCoursecomplexityMasterID}}" <?php if($course->nCourseComplexityID == $complexity->aCoursecomplexityMasterID){ echo "checked"; } ?> disabled>
                </label>
				 @endforeach
              </div>
            </div>
			<div class="col-md-6">
				<!--category-->
				<div class="fields">
                <label class="categories">Category*?</label>
				<?php 
				$categories = DB::table('tblcourseaspintcategory')
				->join('tbltakshashila_url', 'tblcourseaspintcategory.id_url', '=', 'tbltakshashila_url.id_url')
				->where('tblcourseaspintcategory.status', 1)->orderby('tblcourseaspintcategory.orders')->get();				
				?>
                <select disabled>


                  <option value="">Select</option>
				  @foreach($categories as $category)
                  <option value="{{$category->aAspIntCatID}}" <?php if($course->nCourseCategoryID == $category->aAspIntCatID){ echo "selected"; } ?>>{{$category->tAspIntCategory}}</option>
				  @endforeach
                </select>
              </div>
				<!--category-->
			</div>
			  
			   <div class="col-md-6">
				<!--JOB ROLE-->
				   <div class="fields">
                <label class="jobRoles">Job Role*?</label>				
                <select disabled>
				<?php
					$jobrole = DB::table('tblaspirationinterests')->where('naspintcatid', $course->nCourseCategoryID)->get();
				?>
                  <option value="">Select</option>	
					 @foreach($jobrole as $job)
                  <option value="{{$job->aAspIntID}}"  <?php if($course->njobroleid == $job->aAspIntID){ echo "selected"; } ?>>{{$job->tAspirationinterest}}</option>
				  @endforeach
                </select>
              </div>
				<!--JOB ROLE-->
			  </div>
			  
		
            <!--<h3>Course Summary</h3>-->
            <div class="col-md-12">
              <div class="fields">
                <label for="summary">Course Summary*?</label>
                <p><?php echo $course->tCoursedescription; ?></p>
              </div>
            </div>
           
	
     
          </form>
        </div>
      </div>
   
	
  </div>
  
  
  <!---->
  <div class="container cbc" >
   
      <div class="col-md-3">
        <div class="row">
          <div class="subCategoriesBlk">

             <h2>Batch Information</h2>
            <ul>
                <li>Trainer Details
                	<span>Please input the registered email address of the Trainer</span>
                </li>
                <li>Batch Details
                	<span>Please provide the training batch information which includes Batch Start Date, End Date and Last day of the Enrollment</span>
                </li>
                 <li>Price Details
                	<span>Please provide the total price to enroll into the course</span>
                </li>

            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="takshaInfo">
          <form action="" method="" id="ScheduleNewBatch">
			 	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
			   
			
          <input type="hidden" name="aCourseMasterID" value="{{$course->aCourseMasterID}}">
           
			  
            <h3>Institute Information</h3>
            <div class="col-md-12">
				
			 <div class="fields">
                <label for="address">Full Address of Training Institute with Pincode*? </label>
                <textarea maxlength="250" id="address" rows="5" cols="5" name="address" disabled>@if(isset($institute))
				{{$institute->tInstituteStNameAdd1}},
				{{$institute->tInstituteAreaBlvdAdd}},
				Pincode - {{$institute->tInstitutePINZipCode}}.
				@else
				{{$user->tUsrBldName_StName_Add1}},
				{{$user->tUsrAve_Blvd_Add2}},
				Pincode - {{$user->tUsrPinZipCode}}.
				@endif
				</textarea>
			</div>
				<?php 				
				if(isset($institute)){
					$location = $institute->tGoogleInsLoc;
				}else {
					$location = $user->tGoogleLoc;
				}
				?>
              <div class="row"> 
                <div class="col-md-6">
                    <div class="fields">
                        <label for="location">Location*?</label>
                        <input type="text" value="{{$location}}" id="location" name="location"  disabled>
                    </div>
                </div>
				 <div class="col-md-6">  </div>
				  </div>
				 <div class="row headerBorder"> 
					 <h4>Trainer Details</h4>
				<div class="col-md-6">
                    <div class="fields">
                        <label for="email">Email Address* ?</label>						
					<?php if( Auth::user()->nUsrRoleID == 1003 ){  ?>
					<input type="text" value="{{$user->tUsrEmail}}" id="email" name="email" disabled>
                        <input type="hidden" value="{{$user->ausrid}}" id="trainer_userid" name="trainer_userid"  />
                        <input type="hidden" value="{{Auth::user()->ausrid}}"  name="user_id"  />
					<?php }else{ ?>
                        <input type="text" value="" id="email" name="email" />
                        <input type="hidden" value="" id="trainer_userid" name="trainer_userid"  />
                        <input type="hidden" value="{{Auth::user()->ausrid}}"  name="user_id"  />
					<?php } ?>
                        
                    </div>
               </div>
				 <div class="col-md-6">  </div>
				</div>
                
				<div class="row"> 
                <div class="col-md-6">
                  <div class="fields">
                    <label for="fname">Trainer First Name*?</label>
					<?php if( Auth::user()->nUsrRoleID == 1003 ){  ?>
					  <input type="text"  id="fname" name="fname" value="{{$user->tUsrFName}}"  disabled>
					<?php }else{ ?>
                    <input type="text" id="fname" name="fname" >
					<?php } ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="fields">
                    <label for="lname">Trainer Last Name*?</label>
					@if( Auth::user()->nUsrRoleID == 1003 )
					 <input type="text" id="lname" name="lname" value="{{$user->tUsrLName}}" disabled>
					@else
                    <input type="text" id="lname" name="lname"  >
					@endif
                   
                  </div>
                </div>			
                
              
				<p id="trainer_msg" ></p>
                
              </div>
             
                <?php if( Auth::user()->nUsrRoleID == 1003 ){  ?>
                    <div class="row headerBorder">
                        <h4>Instituite Details</h4>
                        <div class="col-md-12">
                            <div class="fields">
                                <label class="types">Instituition</label>
                                <?php
                                    $active_instituites = DB::table('tblinstitutemaster')
                                        ->join('tbltakinstituteaffiliation','tbltakinstituteaffiliation.nInstituteid','=','tblinstitutemaster.aInstituteID')
					->where('tbltakinstituteaffiliation.naffiliationstatus','=',1)
                                        ->where('tbltakinstituteaffiliation.denddate','<=',date('Y-m-d'))
                                        ->groupby('aInstituteID')
                                        ->distinct('aInstituteID')
                                        ->get();
                                ?>
                                <select class="dropdown" name="insID">
                                    <option value="">Select</option>
                                    @foreach($active_instituites as $active_instituite)
                                    <option value="{{$active_instituite->aInstituteID}}">{{$active_instituite->tGoogleInsLoc}}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>
                    </div>
                <?php } ?>
		
            
            </div>
			
			  
			   <h3>Batch information</h3>	  
			  
			  
            <div class="col-md-12">
              
              
              <div class="fields">
                <div class="dateCol first">
                  <label for="summary">Batch Start Date*?</label>
				  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                  <input type="text" id="BatchStartDate" onchange="startDateValidation(this.value)" name="BatchStartDate">
					 <input type="hidden" value="{{$course->tCoursetitle}}"    name="ctitle">
					 <input type="hidden" value="{{$course->tSectorName}}"    name="tSectorName">
                </div>
                <div class="dateCol">
                  <label for="summary">Batch End Date*?</label>
				  <input type="text" id="BatchEndDate" name="BatchEndDate" onchange="endDateValidation(this.value)" >
                </div>
                <div class="dateCol">
                  <label for="summary">Expiration Date*?</label>
                  <input type="text" id="ExpirationDate" name="ExpirationDate" onchange="expDateValidation(this.value)" >
                </div>
              </div>
				<p id="date_msg" style="color:red"> </p>
			
				
			
					
				
				      <div class="col-md-12  no-padding">
              <div class="fields">
                <label class="types">Course type*?</label>
				<?php
					$type = DB::table('tblcoursetypemaster')->get();
				?>
                <select class="dropdown CourseType" name="types" id="ctype">
                  <option value="">Select</option>
				  @foreach($type as $type)
                  <option value="{{$type->aCoursetypeMasterID}}">{{$type->tCoursetype}}</option>
				   @endforeach
                </select>
              </div>
            </div>
				    <div class="col-md-12">
              <div class="fields radioRow">
                <p>Mode*?</p>
				<?php
					$mode = DB::table('tblcoursemodemaster')->get();
				?>
				@foreach($mode as $mode)
                <label for="croom">{{$mode->tCourseModetype}}
                <input type="radio" value="{{$mode->aCourseModeID}}" id="{{$mode->tCourseModetype}}" name="mode">
                </label>
				@endforeach
              </div>
            </div>
              <div class="col-md-12 no-padding headerBorder">
				  <h4>Programme Details</h4>
				  <div class="fields">
               <label for="">Name of Programme ?</label>
               
               <select name="nProgramid" onchange="getGoverningBody(this.value); return false">
                   <option value="">Select your program</option>
                   @foreach($programs as $program)
                    <option value="{{$program->aProgramid}}">{{$program->tprogramname}}</option>
                   @endforeach
               </select>                
            
              </div>
				  
              <!--<div class="fields">
               <label for="sectorBlk">Total Duration(In Hours)* ?</label>
               
              
               <input type="text" value="" placeholder="In Hours" />
                
            
              </div>-->
              </div>
			
				<div class="row">
					
					<div class="col-md-6">
					<div class="fields">
						
						<label for="govBody">Governing Body*</label>
						<input type="text" value="" id="govBody" name="govBody"  />
						
					</div>
				</div>
				<div class="col-md-6">
					<div class="fields">
						
						<label class="prog" for="insType">Governing Body Type*</label>
						<?php
							$ins_type = DB::table('tblinstitutetype')->get();
						?>
						<select class="dropdow" id="insType" name="insType">
							<option value="">Select</option> 
							@foreach($ins_type as $ins_type)
							  <option value="{{$ins_type->aInstituteRoleMasterID}}">{{$ins_type->tInstituteType}}</option>
							@endforeach
						</select>					
					</div>
				</div>
					
				</div>
				
			 
				
            </div>
        
            <h3>Price &amp; Discount</h3>
            <div class="col-md-12">
              <div class="fields radioRow">
                <p>Pricing*?</p>
                <label for="free">Free
                <input type="radio" value="" id="free" class="CoursePrice free" name="fp">
                </label>
                <label for="paid">Paid
                <input type="radio" value="" id="paid" class="CoursePrice paid" name="fp">
                </label>
              </div>
              <div class="fields">
                <label for="amount">Enter the Amount*? </label>
                <input type="text" value="" placeholder="INR" id="amount" class="" name="amount">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="fields">
                    <label for="discount">Discount? </label>
                    <input type="text" value="" placeholder="%" id="discount" name="discount">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="fields">
                    <label for="ccode">Coupon code?</label>
                    <input type="text" value="" placeholder="Enter coupon code" id="ccode" name="ccode">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="fields"> <p id="resmsg"></p>  <p id="LoadingImag"></p> </div>
            </div>
            <div class="col-md-12">
              <div class="fields submitFields">
                 <!--<input type="submit" name="publish" alt="Publish" value="Publish" >-->
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
  <a href="/course-listing" class="goBackBtn">CANCEL</a>
              </div>
            </div>
          </form>
        </div>
      </div>
   
		
 
  </div>
  <!---->
  
  
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@endsection
@section('page_script')
 
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{ asset('assets/js/course.js') }}"></script>
 <script>
  $(document).ready(function(){
  $('.CoursePrice').click(function(){
            if($('.CoursePrice.free').is(':checked') == true){
               $("#amount").attr("disabled", "disabled"); 
               $("#discount").attr("disabled", "disabled"); 
               $("#ccode").attr("disabled", "disabled"); 
               $("#amount").removeClass("required"); 
            }
            else if($('.CoursePrice.paid').is(':checked') == true){
               $("#amount").removeAttr("disabled"); 
               $("#discount").removeAttr("disabled"); 
               $("#ccode").removeAttr("disabled"); 
			    $("#amount").addClass("required"); 
            }
        });
	 });	
        $("#ScheduleNewBatch").validate({
		rules: {
                    email: {
                    required: true,
                    email: true,
                        remote: {
                            url: "/is-trainer-exists",
                            type: "post",
                            data: {
                                _token: $("#token").val(),
                                email: $("email").val()
                            },
                            complete: function(data){
                                console.log(data);
                                if( data.responseText == "true" ) {
                                    setTrainerInfo($("#email").val());
                                } else {
                                    $('#trainer_userid,#fname,#lname').val("");
                                }
                            }
                        }
                    },			
                    BatchStartDate: 'required',
                    BatchEndDate: 'required',
                    ExpirationDate: 'required',
                    types: 'required',
                    mode: 'required',
                    fp: 'required',
                    programmename: 'required',
                    insID: 'required',
                    nProgramid: {
                        required: {
                            depends: function(element){
                                return ($("#ctype").val() != 1);
                            }
                        }
                    },
                    govBody: {
                        required: {
                            depends: function(element){
                                return ($("#ctype").val() != 1);
                            }
                        }
                    },
                    insType: {
                        required: {
                            depends: function(element){
                                return ($("#ctype").val() != 1);
                            }
                        }
                    },
				
		},
		 messages: {
		 },
		submitHandler: function(form) {
			var token = $('#token').val(); 
			var formData = $("form#ScheduleNewBatch").serialize();
			var CourseType  = $('.CourseType option:selected').val();
			if( CourseType == 2 ){
				var govBody  = $('#govBody').val(); 
				if( govBody == '' ){
					alert('Please enter Governing Body'); return false;
				}
				var insType  = $('#insType option:selected').val(); 
				if( insType == '' ){
					alert('Please choose Governing Body Type'); return false;
				}
			}
			
			var discount  = $('#discount').val();
			var ccode  = $('#ccode').val();
			if( discount != '' ){
				if( ccode == '' ){
					alert('Please enter Coupon code'); return false;
				}
			}
			  if($('.CoursePrice.paid').is(':checked') == true){
				  var amount  = $('#amount').val();
				  if( parseInt(amount) < 101 ){
					 alert('Course amount should be greater than 100'); return false;
				  }
			  }
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/create-batch',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						$('p#resmsg').html(data.msg);
						window.location='/batch-list/'+data.course_id;
					}else{
						$('p#resmsg').html(data.msg);
					}
					
				}
			});
		},
	});
    
        function setTrainerInfo(email){
            var token = $('#token').val(); 
            $.ajax({
                url: '/get-trainerinfo',
                type: 'POST',
                data: "_token="+token+"&email="+email,
                dataType: "json",
                success: function (data) {					
                    if(data.trainer_userid){
                        $('#trainer_userid').val(data.trainer_userid);
                        $('#fname').val(data.trainer_fname);
                        $('#lname').val(data.trainer_lname);
                    }
                }
            });
        }
	
	function getGoverningBody(program_id){
            var token = $('#token').val(); 
            $.ajax({
                url: '/get-governingbody',
                type: 'POST',
                data: "_token="+token+"&program_id="+program_id,
                dataType: "json",
                success: function (data) {					
                    if(data.status == 'success'){
                        $('#govBody').val(data.govBody);
                        $('#insType').val(data.insType);

                    }

                }
            });
    }
 </script>
@endsection

