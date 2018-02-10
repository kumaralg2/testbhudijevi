@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')
	@include('layouts/banner')
			
    				
	<div class="container cbc">
    <div class="row">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/')}}">Home</a></li>
                <li class="active">Create Course</li>
            </ol>
        </div>
    </div>
		
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
          <form action="" method="" id="CourseCreation">
			 	<input type="hidden" name="_token" value="{{ csrf_token() }}">                                
                                <input type="hidden" name="image_type" value="course" id="image_type" />
			   <div class="col-md-12">
			 <div class="profileBox img-responsive">
			  </div>
                        <p class="primary-color">Note:
                            <ol class="primary-color">
                                <li>Please upload an image whose width equal or more then 810px  and height equals or more then 562px for a better view</li>
                                <li>You may use MSPaint to modify the Image to the required resolution</li>
                            </ol>  
                        </p>
			  </div>
			  
            <div class="col-md-12">
                
                <p class="loadingimage"></p>
                <div class="fields browseImage">
                  <input type="file" onchange="uploadImage(); return false" name="image" id="image_file" class="inputfile inputfile-6" />
                  <label for="file-7"><span></span> <strong> Choose a file&hellip;</strong></label>
                </div>
            </div>
            <div class="col-md-12">                                    
                <p class="invalid-msg"></p>
            </div>
			  
           <h3>Basics</h3>
            <div class="col-md-6">
              <div class="fields">
                <label for="title">Title* ?</label>
                <input type="text" value="" id="title" name="title"  />
				  <input type="hidden" name="image_filename" class="image_filename">
              </div>
              <div class="fields">
                <label for="subTitle">Sub Title* ?</label>
                <input type="text" value="" id="subTitle" name="subTitle"  />
              </div>
            </div>
            <div class="col-md-6">
              <div class="fields">
                <label for="takshaLang">Language?</label>
				<?php
					$languages = DB::table('tbllanguagemaster')->whereNotIn('aCourseLangOptionID', [4,5])->get();
				?>
                <select class="dropdown" name="takshaLang">				
                  <option value="">Select</option>
				  @foreach($languages as $language)
                  <option value="{{$language->aCourseLangOptionID}}">{{$language->tCourseLangName}}</option>
				  @endforeach
                </select>
              </div>
              <div class="fields">
                <label for="sectorBlk">Sector* ?</label>
				<?php
					$sectors = DB::table('tblsectormaster')->get();
				?>
                <select class="dropdown" name="sectorBlk" onchange="getCategory(this.value)">
                  <option value="">Select</option>
				  @foreach($sectors as $sector)
                  <option value="{{$sector->aSectorID}}">{{$sector->tSectorName}}</option>
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
                <input type="radio" value="{{$complexity->aCoursecomplexityMasterID}}" id="{{$complexity->tCourseComplexity}}" name="bie">
                </label>
				 @endforeach
              </div>
            </div>
			<div class="col-md-6">
				<!--category-->
				<div class="fields">
                <label class="categories">Category*?</label>
		
        <select class="" name="categories" onchange="getInterest(this.value)" id="Categories">
           <option value="">Select</option>
        </select>

      </div>

			</div>
			  
			   <div class="col-md-6">
				<!--JOB ROLE-->
				   <div class="fields">
                <label class="jobRoles">Job Role*?</label>				
                <select class="" name="jobRoles" id="Interest">
                  <option value="">Select</option>				 
                </select>
              </div>
				<!--JOB ROLE-->
			  </div>
			  <!--youtube link-->
			    <div class="col-md-12">
			  <div class="fields">
                <label for="title">YouTube Link ? </label>
                <input type="text" value="" id="title" name="youtube_link"  />
              </div>
		      </div>
            <!--<h3>Course Summary</h3>-->
            <div class="col-md-12">
              <div class="fields">
                <label for="summary">Course Summary*?</label>
                <textarea  id="summary" rows="5" cols="5" name="summary" class="jqte-test"></textarea>
              </div>
            </div>
           
	
            
            <div class="col-md-12">
              <div class="fields"> <p id="resmsg"></p>  <p id="LoadingImag"></p> </div>
            </div>
            <div class="col-md-12">
              <div class="fields submitFields">
                 <!--<input type="submit" name="publish" alt="Publish" value="Publish" >-->
                <input class="blueBtn" type="submit" name="save" alt="Save" value="Save"/>
  <a href="/course-listing" class="goBackBtn">CANCEL</a>
              </div>
            </div>
          </form>
        </div>
      </div>
   
	
  </div>
  
  
  <!---->
  <div class="container cbc" style="display:none">
   
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
          <form action="" method="" id="CourseCreation">
			 	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			   
			
          
           
			  
            <h3>Trainer Information (Trainer Details)</h3>
            <div class="col-md-12">
				
			 <div class="fields">
                <label for="address">Full Address of Training Institute with Pincode*?</label>
                <textarea maxlength="250" id="address" rows="5" cols="5" name="address">@if(isset($institute))
				{{$institute->tInstituteStNameAdd1}},
				{{$institute->tInstituteAreaBlvdAdd}},
				{{$institute->tInstituteLoc}},
				Pincode - {{$institute->tInstitutePINZipCode}}.
				@else
				{{$user->tUsrBldName_StName_Add1}},
				{{$user->tUsrAve_Blvd_Add2}},
				{{$user->tUsrLocation}},
				Pincode - {{$user->tUsrPinZipCode}}.
				@endif
				</textarea>
			</div>
				
              <div class="row"> 
                
                <div class="col-md-6">
                  <div class="fields">
                    <label for="fname">First Name*?</label>
					<?php if( Auth::user()->nUsrRoleID == 1003 ){  ?>
					  <input type="text"  id="fname" name="fname" value="{{$user->tUsrFName}}"  />
					<?php }else{ ?>
                    <input type="text" id="fname" name="fname"  />
					<?php } ?>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="fields">
                    <label for="lname">Last Name*?</label>
					@if( Auth::user()->nUsrRoleID == 1003 )
					 <input type="text" id="lname" name="lname" value="{{$user->tUsrLName}}" >
					@else
                    <input type="text" id="lname" name="lname"  />
					@endif
                   
                  </div>
                </div>
				 <div class="col-md-6">
                    <div class="fields">
                        <label for="email">Email Address* ?</label>						
					<?php if( Auth::user()->nUsrRoleID == 1003 ){  ?>
					<input type="text" value="{{$user->tUsrEmail}}" id="email" name="email">
                        <input type="hidden" value="{{$user->ausrid}}" id="trainer_userid" name="trainer_userid"  />
                        <input type="hidden" value="{{Auth::user()->ausrid}}"  name="user_id"  />
					<?php }else{ ?>
                     <input type="text" value="" id="email" name="email"  onchange="getTrainer(this.value)"/>
                        <input type="hidden" value="" id="trainer_userid" name="trainer_userid"  />
                        <input type="hidden" value="{{Auth::user()->ausrid}}"  name="user_id"  />
					<?php } ?>
                        
                    </div>
                </div>
				
                
              	<div class="col-md-6">
                    <div class="fields">
                        <label for="location">Location*?</label>
                        <input type="text" value="" id="location" name="location"  />
                    </div>
                </div>
				<p id="trainer_msg" ></p>
                
              </div>
             
				
		
            
            </div>
				
				
                    
           <!--
            <h3>Facilities Available</h3>
            <div class="col-md-6">
              <div class="fields checBoxFields">
                <label for="projector">Projector
                <input type="checkbox" value="" id="projector" name="projector">
                </label>
                <label for="pl">Practical Lab
                <input type="checkbox" value="" id="pl" name="pl">
                </label>
                <label for="desktop ">Desktop Computers
                <input type="checkbox" value="" id="desktop" name="desktop">
                </label>
                <label for="tab">Tab Facility,
                <input type="checkbox" value="" id="tab" name="tab">
                </label>
               
              </div>
            </div>
            <div class="col-md-6">
              <div class="fields checBoxFields">
            
                <label for="ac">A/C
                <input type="checkbox" value="" id="ac" name="ac">
                </label>
                <label for="iht">In-house Training
                <input type="checkbox" value="" id="iht" name="iht">
                </label>
                <label for="lms">Learning Management System
                <input type="checkbox" value="" id="lms" name="lms">
                </label>
                <label for="fs">Finishing School
                <input type="checkbox" value="" id="fs" name="fs">
                </label>
              </div>
            </div>
				-->
			  
			   <h3>Batch information</h3>	  
			  
			  
            <div class="col-md-12">
              
              
              <div class="fields">
                <div class="dateCol first">
                  <label for="summary">Batch Start Date*?</label>
                  <input type="text" id="BatchStartDate" onchange="startDateValidation(this.value)" name="BatchStartDate">
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
                <label class="types">Programme Type*?</label>
				<?php
					$type = DB::table('tblcoursetypemaster')->get();
				?>
                <select class="dropdown" name="types">
                  <option value="">Select</option>
				  @foreach($type as $type)
                  <option value="{{$type->aCoursetypeMasterID}}">{{$type->tCoursetype}}</option>
				   @endforeach
                </select>
              </div>
            </div>
				
              <div class="col-md-12 no-padding">
				  
				  <div class="fields">
               <label for="">Name of Programme* ?</label>
               
              
               <input type="text" value="" id="" name="programmename"/>
                
            
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
						
						<label class="prog" for="insType">Institute Type*</label>
						<?php
							$ins_type = DB::table('tblinstitutetype')->get();
						?>
						<select class="dropdown" name="insType">
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
                <input type="radio" value="" id="free" name="fp">
                </label>
                <label for="paid">Paid
                <input type="radio" value="" id="paid" name="fp">
                </label>
              </div>
              <div class="fields">
                <label for="amount">Enter the Amount*? </label>
                <input type="text" value="" placeholder="INR" id="amount" name="amount">
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
<script type="text/javascript">
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
</script>
 
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 <script src="{{asset('/assets/js/course.js')}}"></script>
@endsection

