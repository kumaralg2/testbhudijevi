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
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/')}}">Home</a></li>
            <li class="active">Settings</li>
        </ol>
    </div>
    <div class="row">
        
      <div class="col-md-3">
       
          <div class="subCategoriesBlk studentProfile">
			
			   <h2>Enrollments and Subscriptions</h2>
            <ul>
            <?php if(Auth::user()->nUsrRoleID != 1004): ?>
				      <li><a href="tsSubscriptions">Subscriptions</a><span>List of Active and Expired subscriptions with us. </span></li>
			         <li><a href="tsCallBack">Call Back’s and Appointments</a>><span>Inquiry request from Students against your Courses..</span></li>
               <?php endif; ?>
			 <?php if(Auth::user()->nUsrRoleID == 1004 ): ?>
              <li><a href="tsSubscriptions">Subscriptions</a>
              	<span>Please find your list of all your Enrolments till date through Takshashilaonline.com</span>
              </li>
			   <?php   endif; ?>
			   <?php if(Auth::user()->nUsrRoleID == 1002 || Auth::user()->nUsrRoleID == 1003): ?>
              <li style="display:none"><a href="tsBilling">Billing</a>
              <span>Please provide your payment method to have an active subscription with us.</span>
              </li>
			  
              <li><a href="tsTax">Identification/Tax Settings</a><span>Please provide us your PAN information.</span></li>
         
			  	 <?php   endif; ?>
            </ul>
			  
			  
            <h2>User Information</h2>
            <ul>
              <li><a href="tsProfileBox">Basic Information</a>
              <span>Please verify and confirm your basic user information. Thank you!</span>
              </li>
            
              <li><a href="tsAddressBox">Address</a><span>Please confirm your communication address. Thank you!</span></li>
              <li><a href="tsEducationBox">Education Information</a><span>Providing your education information will enable us to serve you even better. Thank you!</span></li>
              <li style="display:none"><a href="tsWorkExpBox">Work Experience</a><span>Your Work experience will highlight your profile. Thank you!</span></li>
               <li><a href="tsUI">Identity Information</a>
              
              <span>These information will help us to recommend you with any eligible government benefits!</span>
              </li>
                 <li><a href="tsResetPassword">Password</a>
              <span>Please Reset your new password. Thank you!</span>
              </li>
            </ul>
            
             <h2>Role</h2>
            <ul>
              <li><a href="tsStudent">Profile Type</a>
              	<span>Please update your correct Training Institure address information!</span>
              </li>
             
              <?php if(Auth::user()->nUsrRoleID == 1002 || Auth::user()->nUsrRoleID == 1003): ?>
               <li><a href="tsAddInformation">Additional Information</a>
              
              <span>The information provided here add weightage to your/your institutes profile's !</span>
              </li>
              
              
               <li><a href="tsFacilitiesAvl">Facilities Available</a>
              
              <span>Please select from the list on the facilities available for the Student willing to be trained under you.</span>
              </li>
              <?php   endif; ?>
              
              
            </ul>
           
           
		
          </div>
        
      </div>
      <div class="col-md-9">
        <div class="takshaInfo">
       
          
          	<ul class="tsFormList">
            
            <li class="tsSubscriptions profileList">
				 
               <?php if(Auth::user()->nUsrRoleID < 1004 ): ?>   
              
             <h3>Subscriptions</h3>   
             
             <div class="col-md-12">
              <h4>Expired Contract</h4>

              <div class="enrollCol subscriptionList">
             	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="infoTable">
                  <tr>
                    <th valign="top">Contract ID</th>
                    <th valign="top">Contract Type</th>
                    <th valign="top">Start Date</th>
                    <th valign="top">End Date</th>
                    <th valign="top">Status</th>
                    <!--<th valign="top">Total Training Batche Eligible (No.)</th>
                    <th valign="top">Total Training Batches created (No.)</th>-->
                    <th valign="top">Purchase Order No</th>
                    <th valign="top">Sales Order No</th>
                    <th valign="top">Amount</th>
                  </tr>
                  <?php

                    $userId = Auth::user()->ausrid; 

                    $getInstitution = DB::table('tblinstitutemaster')
                                            ->where('nInstituteMgrIncharge', '=', $userId)                                            
                                            ->get();
                    if($getInstitution){
                      foreach($getInstitution as $institution){
                        $instituteId  = $institution->aInstituteID;
                      }

                      $inactiveContracts = DB::table('tbltakinstituteaffiliation')
                                              ->join('tblcontract', 'tblcontract.aContractID', '=', 'tbltakinstituteaffiliation.ncontractid')
                                              ->whereDate('tbltakinstituteaffiliation.denddate', '<' , date('Y-m-d'))
                                              ->where('tbltakinstituteaffiliation.nInstituteid', '=',$instituteId)
                                              ->get();               

                  ?>

                  @foreach($inactiveContracts as $inactive)
                    <?php 

                        /**$activeBatches = DB::table('tbltrainingbatchmaster')
                                              ->whereDate('dTrainingBatchEndDate', '>=', date('Y-m-d'))
                                              ->where('nInstituteID',$inactive->nInstituteid)
                                              ->count();

                        $totalBatches = DB::table('tbltrainingbatchmaster')                                              
                                              ->where('nInstituteID',$inactive->nInstituteid)
                                              ->count();*/
                    ?>
                    <tr>
                    <td valign="top">{{$inactive->atakaffiliationid}}</td>
                    <td valign="top">{{$inactive->tContractName}}</td>
                    <td valign="top">{{ Carbon\Carbon::parse($inactive->dstartdate)->format('d/m/Y') }}</td>
                    <td valign="top">{{ Carbon\Carbon::parse($inactive->denddate)->format('d/m/Y') }}</td>
                    <td valign="top" class="orange">Expired</td>
                    <!--<td valign="top"><?php //echo $activeBatches+1; ?></td>
                    <td valign="top"><?php //echo $totalBatches; ?></td>-->
                    <td valign="top">{{$inactive->tPurchaseorder ?: 'Purchase order not available'}}</td>
                    <td valign="top">{{$inactive->tSalesOrder ?: 'Sales order not available'}}</td>
                    <td valign="top">Rs {{$inactive->nContractValue}}/-</td>
                  </tr>
                  @endforeach
                  <?php } ?>
                </table>
             </div>
             
             
             <h4>Active Contract</h4>
             <div class="enrollCol subscriptionList">
             	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="infoTable">
                  <tr>
                    <th valign="top">Contract ID</th>
                    <th valign="top">Contract Type</th>
                    <th valign="top">Start Date</th>
                    <th valign="top">End Date</th>
                    <th valign="top">Status</th>
                    <!--<th valign="top">Training Batches Eligible (No.)</th>
                    <th valign="top">Training Batches created (No.)</th>-->
                    <th valign="top">Purchase Order No</th>
                    <th valign="top">Sales Order No</th>
                    <th valign="top">Amount</th>
                  </tr>

                  <?php 

                    if($getInstitution){

                     $activeContracts = DB::table('tbltakinstituteaffiliation')
                                              ->join('tblcontract', 'tblcontract.aContractID', '=', 'tbltakinstituteaffiliation.ncontractid')
                                              ->whereDate('tbltakinstituteaffiliation.denddate', '>=' , date('Y-m-d'))                                            
                                              ->where('tbltakinstituteaffiliation.nInstituteid', '=',$instituteId)
                                              ->get();

                  ?>


                  @foreach($activeContracts as $active)
                    <?php 

                        /*$activeBatches = DB::table('tbltrainingbatchmaster')
                                              ->whereDate('dTrainingBatchEndDate', '>=', date('Y-m-d'))
                                              ->where('nInstituteID',$active->nInstituteid)
                                              ->count();

                        $totalBatches = DB::table('tbltrainingbatchmaster')                                              
                                              ->where('nInstituteID',$active->nInstituteid)
                                              ->count();*/
                    ?>
                    <tr>
                    <td valign="top">{{$active->atakaffiliationid}}</td>
                    <td valign="top">{{$active->tContractName}}</td>
                    <td valign="top">{{ Carbon\Carbon::parse($active->dstartdate)->format('d/m/Y') }}</td>
                    <td valign="top">{{ Carbon\Carbon::parse($active->denddate)->format('d/m/Y') }}</td>
                    <td valign="top" class="green">Active</td>
                    <!--<td valign="top"><?php //echo $activeBatches+1; ?></td>
                    <td valign="top"><?php //echo $totalBatches; ?></td>-->
                    <td valign="top">{{$active->tPurchaseorder ?: 'Purchase order not available'}}</td>
                    <td valign="top">{{$active->tSalesOrder ?: 'Sales order not available'}}</td>
                    <td valign="top">Rs {{$active->nContractValue}}/-</td>
                  </tr>
                  @endforeach
                  <?php } ?>
                </table>
             </div>
             
             </div>
             
             <?php endif; ?>            
                <?php if(Auth::user()->nUsrRoleID == 1004 ): ?>       
             <h3>Subscriptions</h3>   
             
             <div class="col-md-12">
             
             <div class="enrollCol">
             	<ul>
                    <li class="first">Batch No:</li>
                    <li class="second">Enrollment Date</li>                    
                    <li>Institute/Trainer Name</li>
                    <li class="last">Feedback</li>
                </ul>
                <ul>
                    <li class="first">1</li>
                    <li class="green second">MM/DD/YYYY</li>                 
                    <li>Full Name</li>
                    <li class="last"><a href="#">Feedback</a></li>
                </ul>
 				 <ul>
                    <li class="first">2</li>
                    <li class="green second">MM/DD/YYYY</li>                 
                    <li>Full Name</li>
                    <li class="last"><a href="#">Feedback</a></li>
                </ul>   
 				 <ul>
                    <li class="first">3</li>
                    <li class="green second">MM/DD/YYYY</li>                 
                    <li>Full Name</li>
                    <li class="last"><a href="#">Feedback</a></li>
                </ul>                          
             	
             </div>
             
             </div>
             <?php endif; ?>
                    
                     
            
           </li>
        
		 <li  class="tsCallBack profileList">
                 
              
             <h3>Call Back’s and Appointments</h3>   
             
            
             <div class="col-md-12">
           
             	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="infoTable">
                  <tr>
                    <th valign="top">Lead ID</th>
                    <th valign="top">Batch Name</th>
                    <th valign="top">Course Name</th>
                    <th valign="top">Requested Date</th>
                    <th valign="top">Request Type</th>
                    <th valign="top">Appointment Date</th>
                    <th valign="top">Appointment Time</th>
                    <th valign="top">Student Full Name</th>
                    <th valign="top">Student Email</th>
                    <th valign="top">Student Mobile</th>
                    <th valign="top" width="20%">Request Comments</th>
                  </tr>


                   <?php
                      
                      $userId = Auth::user()->ausrid; 

                      $instuteDetailsObj = DB::table('tblinstitutemaster')
                                            ->where('nInstituteMgrIncharge', '=', $userId)                                            
                                            ->get();

                      if($instuteDetailsObj){
                      $instuteDetailsArray = json_decode(json_encode($instuteDetailsObj), True);
                      
                      $instituteId =  $instuteDetailsArray[0]['tInstituteName'];

                      $callbackRequests = DB::table('tblstudentcourseenquiry')
                                            ->join('tbltrainingbatchmaster', 'tbltrainingbatchmaster.aTrainingBatchMasterID', '=', 'tblstudentcourseenquiry.nBatchid')
                                            ->join('tblcoursecataloguemaster','tblcoursecataloguemaster.aCourseMasterID','=','tbltrainingbatchmaster.nCourseMasterid')
                                            ->join('tblusermaster','tblstudentcourseenquiry.nUserid','=','tblusermaster.ausrid')
                                            #->whereDate('tbltrainingbatchmaster.nInstituteID', '=' ,2)
                                            ->where('tbltrainingbatchmaster.nInstituteID','=',$instituteId)
                                            ->get(); 
                  ?>

                 
                  @foreach($callbackRequests as $request)
                   <tr>
                    <td valign="top">{{$request->aEnquiryid}}</td>
                    <td valign="top">{{$request->tTrainingBatchName}}</td>
                    <td valign="top">{{$request->tCoursetitle}}</td>
                    <td valign="top">{{ Carbon\Carbon::parse($request->created_at)->format('d/m/Y') }}</td>                    
                    <td valign="top">{{$request->tEnquiryType}}</td>
                    <td valign="top">@if( $request->nScheduleTime >0) {{ Carbon\Carbon::parse($request->nScheduleDate)->format('d/m/Y') }}@endif</td>
                    <td valign="top">@if( $request->nScheduleTime >0) {{ Carbon\Carbon::parse($request->nScheduleTime)->format('H:m: A') }}@endif</td>
                    <td valign="top">{{$request->tCoursetitle}}</td>
                    <td valign="top"><a href="mailto:email@email.com" title="{{$request->tUsrEmail}}">{{$request->tUsrEmail}}</a></td>
                    <td valign="top">{{$request->tUsrMobileNumber}}</td>
                    <td valign="top" width="20%">{{$request->tEnquiryComment}}</td>
                  </tr>
                @endforeach
                <?php } ?>
                </table>
                
                	<a href="#" title="Download File" class="downloadBtn">Download File</a>
               
                
             </div>
             <div class="col-md-12">
              <!--<p>pagination goes here</p>-->
             </div>
             
            
           </li>
                <li class="tsTax profileList">
                   <form action="" method="" id="UpdatePAN" >                
               <h3>Identification/Tax Settings</h3>
               
               
               <div class="col-md-6">
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<?php
					$pan = DB::table('tbluserinstidinfo')
					->where('nUsrID', Auth::user()->ausrid)
					->where('nIDMaster', 1)
					->first();
					if(isset($pan->tIDValue)){
						$pan_no = $pan->tIDValue;
					}else{
						$pan_no = '';
					}
				?>
                <div class="fields"> 
                    <label for="panNo" class="hide">Permanent Account Number (PAN):</label>
                    <input type="text" placeholder="Permanent Account Number (PAN):" value="{{$pan_no}}" id="panNo" name="panNo"  />
                </div>
            </div>
                 <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  
               
                <div class="col-md-12">
                    <div class="fields submitFields">
                        <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                          <a class="goBackBtn" href="/account/profile">Cancel</a>
                    </div>
                </div>
               
             </form>
             </li>
            
            	<li class="tsProfileBox profileList">
                   <form action="" method="" id="BasicInformation">
                 <h3>Profile</h3>
            
             <div class="col-md-6">
             
              <div class="fields">
                <label for="fName" class="hide">First Name*</label>
				 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" placeholder="First Name"  id="fName" name="fName" value="{{$user->tUsrFName}}" />
              </div>
             
             </div>
             
              <div class="col-md-6">
              
               <div class="fields">
                <label for="lName" class="hide">Last Name*</label>
                <input type="text" placeholder="Last Name" value="{{$user->tUsrLName}}" id="lName" name="lName"  />
              </div>
              
              
             </div>
             
               <div class="col-md-12">
               
               <div class="fields radioRow">
              
                <label for="tsMale">Male
                <input type="radio" name="tsGender" id="tsMale" value="Male" <?php if($user->tUsrgender == 'Male'){ echo "checked"; } ?>/>
                </label>
                
                <label for="tsFemale">Female
                <input type="radio" name="tsGender" id="tsFemale" value="Female" <?php if($user->tUsrgender == 'Female'){ echo "checked"; } ?>/>
                </label>
                
              </div>
               
               </div>
             
            <div class="col-md-12">
            
            
            

             <div class="fields">
             
                <label for="tsEmail" class="hide">Email*</label>
               
               
             
                <div class="col-md-6 no-padding">
                    <input type="text" placeholder="Email" value="{{$user->tUsrEmail}}" id="tsEmail" name="tsEmail"  />               
                </div>
                <div class="col-md-3 smlTxt11">                  
                    <span>Not Verified <a href="#" style="text-decoration:underline;">Click here for Verification</a></span>                  
                </div>
                
                <div class="col-md-3 smlTxt11">    
                    <label for="tsNewsLetter" class="newsLetterLabel">
                    <input type="checkbox" name="tsNewsLetter" id="tsNewsLetter" value="1" <?php if($user->nNewsLetterSubscription == 1){ echo "checked"; }?>/> <span class="newsLetterTxt">Recieve Taskhashilaonline Newsletter</span>
                    </label>               
                </div>
             
             
              </div>  

           
                 
            </div>
            
            <div class="col-md-12">
            
             <div class="fields">
             
                <label for="fName" class="hide">Mobile*</label>
                  <div class="col-md-6 no-padding">
               		 <input type="text" placeholder="Mobile" maxlength="10" value="{{$user->tUsrMobileNumber}}" id="mobile" name="mobile"  />
               
             	</div>
                  <div class="col-md-6  smlTxt11">
                  
                   <span>Not Verified <a href="#" style="text-decoration:underline;">Click here for Verification</a></span>
                  
                  </div>
                  
              </div>

			</div>
            
           
            
           
                
        <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>   
                
        <div class="col-md-12">
            <div class="fields submitFields">
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
               <a class="goBackBtn" href="/account/profile">Cancel</a>
            </div>
        </div>      
            
            </form>
                
                </li>
                
               
                
                <li class="tsAddressBox profileList">
                
        <form action="" method="post" id="Address">
                   
                <h3>Address</h3>
            <div class="col-md-12">            
              <div class="fields">
                <label for="tsAddress1" class="hide">Address 1*</label>
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="text" placeholder="Building Name/Apt.No, Street Name (Address1)" value="{{$user->tUsrBldName_StName_Add1}}" id="tsAddress1" name="tsAddress1"  />
              </div>            
            </div>           
            <div class="col-md-12">           
               <div class="fields">
                <label for="tsAddress1" class="hide">Address 2*</label>
                <input type="text" placeholder="Location/Blvd, Area (Address2)" value="{{$user->tUsrAve_Blvd_Add2}}" id="tsAddress2" name="tsAddress2"  />
              </div>            
            </div>
            
            <div class="col-md-12">
              <div class="fields">
                <label class="hide">State*</label>
				<?php
					$States = DB::table('tbllocationmaster')->groupBy('tState_County')->get();
				?>
                <select class="dropdownq"  name="state" onChange="getDistrict(this.value); return false">
                  <option value="">State</option>
				  @foreach($States as $State)
                  <option value="{{$State->tState_County}}" <?php if($State->aLocationID == $user->tUsrLocation){ echo "selected"; } ?> >{{$State->tState_County}}</option>
				  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="fields">
                <label class="hide">District*</label>
				
                <select class="dropdown1" name="locationid" id="district">
                  <option value="">District</option>
                </select>
              </div>
            </div>  
                     
            <div class="col-md-12">
                <div class="fields">
                    <label for="tsEmail" class="hide">Pincode*</label>
                    <input type="text" placeholder="Pincode" value="{{$user->tUsrPinZipCode}}" id="tsLocation" name="pincode"  />
                </div>
            </div>
                     
            <div class="col-md-12">
                <div class="fields">
                    <label for="tsEmail" class="hide">Google Location*</label>
                    <input type="text" placeholder="Location" value="{{$user->tGoogleLoc}}" id="tGoogleLoc" name="tGoogleLoc"  />
                </div>
            </div>
             <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  
            <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                 <a class="goBackBtn" href="/account/profile">Cancel</a>
              </div>
            </div>
            
            </form>
                 
                </li>
                
                <li class="tsEducationBox profileList">
                
                   <form id="EducationInfo">
                  <h3>Education Information</h3>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-12">
            	<div class="row">
                  <?php
			$edu_info = DB::table('tblusereduinfo')
					->join('tblinstitutemaster', 'tblusereduinfo.nInstitutionMasterID', '=', 'tblinstitutemaster.aInstituteID')
					->where('tblusereduinfo.nUsrID', Auth::user()->ausrid)
					->get();
			$required_field = 3 - count($edu_info);

					
				
			for( $i = 0; $i < count($edu_info); $i++ ){
				$degree = DB::table('tbldegreemaster')->get();
			?>      
                <input type="hidden" name="aUserEduInfo[]" value="<?php echo $edu_info[$i]->aUserEduInfo; ?>">
                 <div class="col-md-3">
             
            <div class="fields">
                <label  class="hide">Basic/Graduation*</label>
				
                <select class="dropdown1" id="degreeId" name="degree[]" >				
                    <option value="">Degree</option>    
                   @foreach($degree as $degree)
				  <option value="{{$degree->aDegreeID}}" <?php if($degree->aDegreeID == $edu_info[$i]->nDegreeid){ echo "selected";  }  ?> >{{$degree->tDegree}}</option>
				  @endforeach
                </select>
            </div>
              
              </div>
              
              
               <div class="col-md-3">
              
              	<div class="fields">
                	    <label  class="hide">University Name*</label>
                             <input type="text" placeholder="University Name" value="<?php echo $edu_info[$i]->tInstituteName; ?>" id="insName" name="insName[]"  />
                    
                </div>
              
              
              </div>
              
              
              
              <div class="col-md-3">
              	<div class="fields">
                	<label class="hide">Year*</label>
                       <select class="dropdown1" id="yearOfCompletion" name="year_of_passing[]">				
                    <option value="">Year Of Passing</option>    
                   <?php $start_year = 1977; for( $y = 0; $y+$start_year <= date("Y"); $y++ ) { ?>
				  <option value="<?php echo $start_year+ $y; ?>"  <?php if($start_year+ $y == $edu_info[$i]->nYearofPassing){ echo "selected"; }  ?>><?php echo $start_year+ $y; ?></option>
				   <?php } ?>
                </select>
                    
                </div>
               </div> 
               
               
               <div class="col-md-3">
              
              	<div class="fields">
                	<label  class="hide">Grade</label>
                    <?php $grade = DB::table('tblgrademaster')->get(); ?>
                    <select class="dropdown1" id="gradeId" name="grade[]"> 
                    	
                        <option value="">Grade</option>
                    	 @foreach($grade as $grade)
				  <option value="{{$grade->aGradeid}}" <?php if($grade->aGradeid == $edu_info[$i]->nUsrCGPA){ echo "selected"; }  ?>>{{$grade->tGrade}}</option>
				  @endforeach
                        
                     </select>
                    
                </div>
              
              </div>
              <?php	} 		?>
			<?php for( $j = 0; $j < $required_field; $j++ ) {
	$degree = DB::table('tbldegreemaster')->get();
			?>
                 <div class="col-md-3">
             
            <div class="fields">
                <label  class="hide">Basic/Graduation*</label>
                <select class="dropdown1" id="degreeId" name="degree[]" >				
                    <option value="">Degree</option>    
                   @foreach($degree as $degree)
				  <option value="{{$degree->aDegreeID}}" >{{$degree->tDegree}}</option>
				  @endforeach
                </select>
            </div>
              
              </div>
              
              
               <div class="col-md-3">
              
              	<div class="fields">
                	    <label  class="hide">University Name*</label>
                             <input type="text" placeholder="University Name" value="" id="insName" name="insName[]"  />
                    
                </div>
              
              
              </div>
              
              
              
              <div class="col-md-3">
              	<div class="fields">
                	<label class="hide">Year*</label>
                       <select class="dropdown1" id="yearOfCompletion" name="year_of_passing[]">				
                    <option value="">Year Of Passing</option>    
                   <?php $start_year = 1977; for( $y = 0; $y+$start_year <= date("Y"); $y++ ) { ?>
				  <option value="<?php echo $start_year+ $y; ?>" ><?php echo $start_year+ $y; ?></option>
				   <?php } ?>
                </select>
                    
                </div>
               </div> 
               
               
               <div class="col-md-3">
              
              	<div class="fields">
                	<label  class="hide">Grade</label>
                    <?php $grade = DB::table('tblgrademaster')->get(); ?>
                    <select class="dropdown1" id="gradeId" name="grade[]"> 
                    	
                        <option value="">Grade</option>
                    	 @foreach($grade as $grade)
				  <option value="{{$grade->aGradeid}}" >{{$grade->tGrade}}</option>
				  @endforeach
                        
                     </select>
                    
                </div>
              
              </div>
                 <?php	} 		?>
                
                </div>
            </div>
                      <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  
                
                <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                  <a class="goBackBtn" href="/account/profile">Cancel</a>
              </div>
            </div>
            
            </form>
                
                </li>
                
                <li class="tsWorkExpBox profileList">
                   <form action="" method="" >
                
               <h3>Work Experience</h3>
              
              
               <!--block 1-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 1-->
             
             
             
              <!--block 2-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm2" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo2" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 2-->
             
             
              <!--block 3-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm3" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo3" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 3-->
             


   <!--block 4-->
            <div class="col-md-12">
                <div class="row">
 
 
 <div class="col-md-1">
    <select id="expFrm4" class="dropdown"> 
    <option value="-1">From</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>                 
                               
                
<div class="col-md-1">
    <select id="expTo4" class="dropdown"> 
    <option value="-1">To</option> <option value="2016">2016</option>  <option value="2015">2015</option>  <option value="2014">2014</option>  <option value="2013">2013</option>  <option value="2012">2012</option>  <option value="2011">2011</option>  <option value="2010">2010</option>  <option value="2009">2009</option>  <option value="2008">2008</option>  <option value="2007">2007</option>  <option value="2006">2006</option>  <option value="2005">2005</option>  <option value="2004">2004</option>  <option value="2003">2003</option>  <option value="2002">2002</option>  <option value="2001">2001</option>  <option value="2000">2000</option>  <option value="1999">1999</option>  <option value="1998">1998</option>  <option value="1997">1997</option>  <option value="1996">1996</option>  <option value="1995">1995</option>  <option value="1994">1994</option>  <option value="1993">1993</option>  <option value="1992">1992</option>  <option value="1991">1991</option>  <option value="1990">1990</option>  <option value="1989">1989</option>  <option value="1988">1988</option>  <option value="1987">1987</option>  <option value="1986">1986</option>  <option value="1985">1985</option>  <option value="1984">1984</option>  <option value="1983">1983</option>  <option value="1982">1982</option>  <option value="1981">1981</option>  <option value="1980">1980</option>  <option value="1979">1979</option>  <option value="1978">1978</option>  <option value="1977">1977</option>  <option value="1976">1976</option>  <option value="1975">1975</option>  <option value="1974">1974</option>  <option value="1973">1973</option>  <option value="1972">1972</option>  <option value="1971">1971</option>  <option value="1970">1970</option>   </select>
</div>          
                		
                          <div class="col-md-4">
                                    <div class="fields">
                                        <label for="ioName" class="hide">Institute/Organisation Name*</label>
                                        <input type="text" placeholder="Institute/Organisation Name" value="" id="ioName" name="ioName"  />
                                    </div>
                                </div>
                         
                          <div class="col-md-3">                          
                            <div class="fields">
							    <label for="designation" class="hide">Designation*</label>
                             	<input type="text" placeholder="Designation" value="" id="designation" name="designation"  />
                            </div>                          
                          </div>
                          
                    <div class="col-md-3">
                     <div class="fields">
                       <label for="sector" class="hide">Sector*</label>
                            <select id="sector" class="dropdown">  
                                <option value="-1">Sector</option>
                                <option value="1">Sector 1</option>
                                <option value="2">Sector 2</option>
                                <option value="3">Sector 3</option>
                            </select>
                        </div>
                    </div>
                          
                          
                </div>
            </div>
             <!--block 4-->             
            
            

            
             
                          
                       
                        
                        <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                  <a class="goBackBtn" href="/account/profile">Cancel</a>
              </div>
            </div>
            
            </form>
            
                
                </li>
                
                 <li class="tsFacilitiesAvl profileList">
                 
                 <h3>Facilities Available</h3>
                 <!---->
                    <form action="" method="" id="FacilitiesAvailable" >
					 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <?php
					$facilities = DB::table('tbltrainingfacilities')->get();	
					?>
                    <div class="col-md-12">                 	
                       <div class="row">
							<?php $count = 0; ?>
							@foreach($facilities as $facility)
								  
								<?php if( ($count%3) == 0) {  ?>
								 <div class="col-md-4">
                        	<div class="col-md-12 no-padding">    
								<?php } ?>
							  <div class="fields">  
                                    <label for="">
                                        <input type="checkbox" value="{{$facility->atrainingfacilityid}}"  name="facility[]" 
										<?php 
										$fac = DB::table('tblinstitutefacilities')
										->where('nFacilityID', $facility->atrainingfacilityid)
										->where('nUserId', Auth::user()->ausrid)
										->get();
										if( count($fac) > 0 ){
											echo "checked";
										}
										?>
										> <span>{{$facility->tfacilityname}}</span>
                                    </label> 
                                 </div> 
								 <?php if( (($count + 1)%3) == 0) {  ?>
								 </div>
								 </div>
								<?php } ?>
								 <?php $count++; ?>
							@endforeach
                       </div>
                    </div>
			
                      <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  
                    
                    <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                  <a class="goBackBtn" href="/account/profile">Cancel</a>
              </div>
            </div>
                 
                 <!---->
                  </form>
                 </li>
                
                
                 
           
             <li class="tsResetPassword profileList">
                  <form action="" id="ResetPassword" >
                  
                     <h3>Reset Password</h3>
                     
                       <div class="col-md-12">            
                          <div class="fields">
                            <label for="tsOldPassword1" class="hide">Old Password*</label>
							 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="password" placeholder="Old Password" value="" id="tsOldPassword1" name="oldpassword"  />
                          </div>            
                        </div>           
                        <div class="col-md-12">           
                           <div class="fields">
                            <label for="tsNewPassword" class="hide">New Password*</label>
                            <input type="password" placeholder="New Password" value="" id="newpassword" name="newpassword"  />
                          </div>            
                        </div>
                         <div class="col-md-12">           
                           <div class="fields">
                            <label for="tsReenterPassword" class="hide">Reenter Password*</label>
                            <input type="password" placeholder="Reenter Password" value="" name="confirmpassword" id="confirmpassword"  />
                          </div>            
                        </div>   
  <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  						
                        <div class="col-md-12">
                            <div class="fields submitFields">
                                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                                <a class="goBackBtn" href="/account/profile">Cancel</a>
                            </div>
                        </div>      

                  
                  
                 </form>
                 </li>
          
           <li class="tsStudent profileList">
               <h3>Profile Type</h3>
            <div class="col-md-6">                          
            	<div class="fields">
                <label class="hide" for="tsStudent">Trainer/Institue*</label>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<?php 
				$role = '';
				if( $user->nUsrRoleID == 1002 ){
					$role = 'Training Institue';
				}elseif( $user->nUsrRoleID == 1003 ){
					$role = 'Trainer';
				}elseif( $user->nUsrRoleID == 1004 ){
					$role = 'Student';
				}
				?>
                <input type="text" name="tsStudent" id="tsStudent" value="<?php echo $role; ?>" placeholder="Trainer/Training Institute Manager" disabled>
            	</div>                          
          	</div> 
			<?php if(Auth::user()->nUsrRoleID == 1002): ?>
            <form action="" id="TIInfo">           
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
             <h3 class="noBackground">Training Institute Information</h3>
            
            
             <div class="col-md-12">    
            <p>Please provide us your Training Institute information. !</p>
            </div>
            <div class="col-md-12">                          
            	<div class="fields">
                <label for="tiName" class="hide">Name of the Institute*</label>
                <input type="text" placeholder="Name of the Institute" value="{{$user->tInstituteName}}" id="tiName" name="tiName"  />
            	</div>                          
          	</div>
            
             <div class="col-md-12">            
              <div class="fields">
                <label for="ttAddress1" class="hide">Address 1*</label>
                <input type="text" placeholder="Building Name/Apt.No, Street Name (Address1)" value="{{$user->tInstituteStNameAdd1}}" id="insAddress1" name="insAddress1"  />
              </div>            
            </div>           
            <div class="col-md-6">           
               <div class="fields">
                <label for="ttAddress2" class="hide">Address 2*</label>
                <input type="text" placeholder="Location/Blvd, Area (Address2)" value="{{$user->tInstituteAreaBlvdAdd}}" id="insAddress2" name="insAddress2"  />
              </div>            
            </div>
            
               <div class="col-md-6">
                <div class="fields">
                    <label for="tsEmail" class="hide">Pincode*</label>
                    <input type="text" placeholder="Pincode" value="{{$user->tInstitutePINZipCode}}" id="tsLocation" name="inspincode"  />
                </div>
            </div>
            
               <div class="col-md-12">
                <div class="fields">
                    <label for="tsEmail" class="hide">Location*</label>
                    <input type="text" placeholder="Location" value="{{$user->tGoogleInsLoc}}" id="tGoogleInsLoc" name="tGoogleInsLoc"  />
                </div>
            </div>
             <div class="col-md-12">
              <div class="fields">
                <label class="hide">State*</label>
				<?php
					$allstates = DB::table('tbllocationmaster')->groupBy('tState_County')->get(); 
					 $loc = DB::table('tbllocationmaster')->where('aLocationID', $user->tInstituteLoc)->first();
					 if(isset($loc->tState_County)){
						 $tState_County = $loc->tState_County;
					 }else{
						  $tState_County = '';
					 }
				?>
                <select class="dropdownq"  name="insstate" onChange="getInsDistrict(this.value); return false">
                  <option value="">State</option>
				  @foreach($allstates as $State)
                  <option value="{{$State->tState_County}}" <?php if($State->tState_County == $tState_County){ echo "selected"; } ?>>{{$State->tState_County}}</option>
				  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="fields">
			  
			  <?php $dist = DB::table('tbllocationmaster')->where('tState_County', $tState_County)->groupBy('tDistrict')->get(); ?>
                <label class="hide">District*</label>
				
                <select class="dropdown1" name="inslocationid" id="insdistrict">
                  <option value="">District</option>
				  @foreach( $dist as $key=>$value )
				   <option value="{{$value->aLocationID}}" <?php if($value->aLocationID == $user->tInstituteLoc){ echo "selected"; } ?> >{{$value->tDistrict}}</option>
				  @endforeach
                </select>
              </div>
            </div>  
           
              <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  
            <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
               <a class="goBackBtn" href="/account/profile">Cancel</a>
              </div>
            </div>
            
            </form>
           <?php endif; ?>
           </li>
           
           <li class="tsUI profileList">
           
            <form action="" method="" id="UserIdentityInfo">
           
            <h3>Identity Information</h3>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <?php
			$user_ids = DB::table('tbluserinstidinfo')
					->where('nUsrID', Auth::user()->ausrid)
					->get();
			$required_fields = 3 - count($user_ids);

			for( $i = 0; $i < count($user_ids); $i++ ){
				
			?>
			  <div class="col-md-6">                          
            	<div class="fields">
                <label for="tsUI{{$user_ids[$i]->nIDMaster}}" class="hide">User Identity Information*</label>					
				<?php
					$identity = DB::table('tblidmaster')->where('aIDtype', '!=', 1)->get();
				?>
               <select name="id[]" id="tsUI" class="dropdown1 identityTypes">
                		<option value="" disabled>Identity Type</tion>
						@foreach($identity as $identity)
						  <option value="{{$identity->aIDtype}}" <?php if($identity->aIDtype == $user_ids[$i]->nIDMaster){ echo "selected"; } ?>>{{$identity->tIDName}}</option>
						  @endforeach
               		</select>
            	</div>                          
          	</div>
			   <div class="col-md-6">
             <div class="fields">
                <label for="tsInumber" class="hide">Identity Number*</label>
                <input type="text" placeholder="Identity Number" value="{{$user_ids[$i]->tIDValue}}" id="tsInumber" name="val[]"  />
            	</div>    
            </div>
			<?php	} 		?>
			<?php for( $j = 0; $j < $required_fields; $j++ ) { ?>
            <div class="col-md-6">                          
            	<div class="fields">
                <label for="tsUI" class="hide">User Identity Information*</label>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<?php
					$identity = DB::table('tblidmaster')->where('aIDtype', '!=', 1)->get();
				?>
               <select name="id[]" id="tsUI" class="dropdown1">
                		<option value="">Identity Type</tion>
						@foreach($identity as $identity)
						  <option value="{{$identity->aIDtype}}">{{$identity->tIDName}}</option>
						  @endforeach
               		</select>
            	</div>                          
          	</div>
            
            <div class="col-md-6">
             <div class="fields">
                <label for="tsInumber" class="hide">Identity Number*</label>
                <input type="text" placeholder="Identity Number" value="" id="tsInumber" name="val[]"  />
            	</div>    
            </div>
            <?php } ?>
			
              <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  
            <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
               <a class="goBackBtn" href="/account/profile">Cancel</a>
              </div>
            </div>
            
            </form>
           
           </li>
           
           <li class="tsAddInformation profileList">
           <form action="" method="" id="AdditionalInfo" >
           
            <h3>Addititional Information</h3>
            
            <h3 class="noBackground">Language</h3>
            	
               
               
					
					
					
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <?php
			$lang_ids = DB::table('tbluserlang')
					->where('nuserid', Auth::user()->ausrid)
					->get();
			$required_fields = 3 - count($lang_ids);

			for( $i = 0; $i < count($lang_ids); $i++ ){
				
			?>
			
				<div class="col-md-12">
                	<div class="row">
			
                      <!--1-->
                <div class="col-md-3">
                   <div class="fields">
                <label for="tsUI" class="hide">Language*</label>
				<?php
					$lang = DB::table('tbllanguagemaster')->get();
				?>
               <select name="langid[]" id="tsUI" class="dropdown1">
                		<option value="">Select Language</tion>
						@foreach($lang as $lang)
						  <option value="{{$lang->aCourseLangOptionID}}" <?php if($lang->aCourseLangOptionID == $lang_ids[$i]->nlangid){ echo "selected"; } ?>>{{$lang->tCourseLangName}}</option>
						  @endforeach
               		</select>
            	</div>  
                </div>
                <!--1-->
                 <!--1-->
                <div class="col-md-3">
                    <div class="fields">	
                    	<label for="ttRead" class="readLabel">
                    	<input type="checkbox" value="1" id="ttRead" name="read[]" <?php if( $lang_ids[$i]->bread == 1){ echo "checked"; } ?>/> <span>Read</span>
                    	</label>
                    </div>
                </div>
                <!--1-->
                  <!--1-->
                <div class="col-md-3">
                    <div class="fields">	
                    	
                       <label for="ttWrite" class="readLabel">
                    	<input type="checkbox" value="1" id="ttWrite" name="write[]" <?php if( $lang_ids[$i]->bwrite == 1){ echo "checked"; } ?>/> <span>Write</span>
                    	</label>
                        
                    </div>
                </div>
                <!--1-->
                   <!--1-->
                <div class="col-md-3">
                    <div class="fields">	
                   
                        
                          <label for="ttSpeak" class="readLabel">
                    	<input type="checkbox" value="1" id="ttSpeak" name="speak[]" <?php if( $lang_ids[$i]->bspeak == 1){ echo "checked"; } ?>/> <span>Speak</span>
                    	</label>
                    </div>
                </div>
                <!--1-->
                    
                    </div>
                </div>
			 
			<?php	} 		?>
			<?php for( $j = 0; $j < $required_fields; $j++ ) { ?>
			
				<div class="col-md-12">
                	<div class="row">
			
                      <!--1-->
                <div class="col-md-3">
                   <div class="fields">
                <label for="tsUI" class="hide">Language*</label>
				<?php
					$lang = DB::table('tbllanguagemaster')->get();
				?>
               <select name="langid[]" id="tsUI" class="dropdown1">
                		<option value="">Select Language</option>
						@foreach($lang as $lang)
						  <option value="{{$lang->aCourseLangOptionID}}">{{$lang->tCourseLangName}}</option>
						  @endforeach
               		</select>
            	</div>  
                </div>
                <!--1-->
                 <!--1-->
                <div class="col-md-3">
                    <div class="fields">	
                    	<label for="ttRead" class="readLabel">
                    	<input type="checkbox" value="1" id="ttRead" name="read[<?php echo $j; ?>]" /> <span>Read</span>
                    	</label>
                    </div>
                </div>
                <!--1-->
                  <!--1-->
                <div class="col-md-3">
                    <div class="fields">	
                    	
                       <label for="ttWrite" class="readLabel">
                    	<input type="checkbox" value="1" id="ttWrite" name="write[<?php echo $j; ?>]" /> <span>Write</span>
                    	</label>
                        
                    </div>
                </div>
                <!--1-->
                   <!--1-->
                <div class="col-md-3">
                    <div class="fields">	
                   
                        
                          <label for="ttSpeak" class="readLabel">
                    	<input type="checkbox" value="1" id="ttSpeak" name="speak[<?php echo $j; ?>]" /> <span>Speak</span>
                    	</label>
                    </div>
                </div>
                <!--1-->
                    
                    </div>
                </div>
            
         
            <?php } ?>

				
                
                 <h3 class="noBackground">Skill Proficiency</h3>
                
            <div class="col-md-12">
                <div class="fields">
                    <p>Describe any 10 keywords that would describe your or Institute's Skill proficiency and Area of Study!</p>
                    <label for="summary"><i>Please separate every key word with a <strong class="green">;&nbsp;</strong></i></label>
					<?php
					$result = DB::table('tblusrinstskillprof')
					->where('nusrid', Auth::user()->ausrid)
					->get();
					$skillp	= array();				
					foreach($result as $value){
						$skillp[] = $value->tSkillDescription;
						
					}
					$summary = implode(';', $skillp);
					?>
                    <textarea name="summary" cols="5" rows="5" id="summary" maxlength="250"><?php echo $summary; ?></textarea>
                </div>
            </div>
            
             <h3 class="noBackground">Affiliation</h3>
             
            <div class="col-md-12 skillSection">
                <div class="row">
                   <div class="fields">  
                            <div class="col-md-8">
                                <p>Are you affiliated/Certified to any of the Sector Skill Councils?</p>
                            </div>
                            <div class="col-md-2">
                                <label for="skillYes"><span>Yes</span>
                                    <input type="radio" value="1" class="skillYN yes" name="skillYN" />
                                </label>
                            </div>
                            <div class="col-md-2">                                   
                                 <label for="skillNo"><span>No</span>
                                     <input type="radio" value="0" class="skillYN no" name="skillYN" />
                                </label>                     
                            </div>                    
                   </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="row" id="affiliatedsectors">
                
                	<div class="col-md-12">
                     <p>Please select the affiliated sectors from the list below!</p>
                    </div>
                                        
                   <?php
					$sectors = DB::table('tblsectormaster')->get();	
					?>
                    <div class="col-md-12">                 	
                       <div class="row">
							<?php $count = 0; ?>
							@foreach($sectors as $sector)
								  
								<?php if( ($count%4) == 0) {  ?>
								 <div class="col-md-3">
								<?php } ?>
							  <div class="fields">  
                                    <label for="">
                                        <input type="checkbox" value="{{$sector->aSectorID}}"  name="aff_sectors[]" 
										<?php 
										$aff_sectors = DB::table('tblsectoraffiliation')
										->where('nsectorid', $sector->aSectorID)
										->where('nuserid', Auth::user()->ausrid)
										->get();
										if( count($aff_sectors) > 0 ){
											echo "checked";
										}
										?>
										> <span>{{$sector->tSectorName}}</span>
                                    </label> 
                                 </div> 
								 <?php if( (($count + 1)%4) == 0) {  ?>
								 </div>
								<?php } ?>
								 <?php $count++; ?>
							@endforeach
                       </div>
                    </div>
                   
                   
                   
                  
                        
                           
                  
                    
    
                         
							
                    

                <div class="col-md-12">                 	
                    <div class="row">   
                    
                  
                                     <div class="col-md-3">       
                                
                                <div class="fields">  
                                    <label for="">
                                     <input type="checkbox" value="" id="" name="" /> <span>Management and Management Services</span>
                                    </label> 
                                </div> 
                            
                              </div>            
                                
                                   <div class="col-md-3">
                                <div class="fields">  
                                    <label for="">
                                        <input type="checkbox" value="" id="" name="" /> <span>Chemicals and Petrochemical</span>
                                    </label> 
                                 </div> 
                          
                          
                         </div>                    
                    
                  
								
								
                        		
                      
 					               


                                            
                          </div>        
                    </div>         
                   
                </div>
            </div>
            
			<div class="col-md-12 skillSection">
                <div class="row">
                   <div class="fields">  
                            <div class="col-md-8">
                                <p>Are you a NSDC affiliated Training Institute?</p>
                            </div>
                            <div class="col-md-2">
                                <label for="nsdcY"><span>Yes</span>
                                    <input type="radio" value="1" class="nsdcY yes" name="nsdcYN" <?php if(isset($user->nNSDC_affiliation) && $user->nNSDC_affiliation == 1) { echo "checked"; } ?>/>
                                </label>
                            </div>
                            <div class="col-md-2">                                   
                                 <label for="nsdcN"><span>No</span>
                                     <input type="radio" value="0" class="nsdcY no" name="nsdcYN" <?php if(isset($user->nNSDC_affiliation) && $user->nNSDC_affiliation == 0) { echo "checked"; } ?>/>
                                </label>                     
                            </div>                    
                   </div>
                </div>
            </div>  
            
            <div class="col-md-6" id="NSDCaffiliation">
                <div class="fields"> 
                    <label for="nsdcNo" class="hide">NSDC affiliation Registration No./Certification Number</label>
                    <input type="text" placeholder="NSDC affiliation Registration No./Certification Number" value="<?php if(Auth::user()->nUsrRoleID == 1002) { echo $user->tNSDC_affiliation_cert_no; } ?>" id="nsdcNo" name="nsdcNo"  />
                </div>
            </div>      
              <div class="col-md-12">
			<p id="LoadingImag"></p>
            <p class="ResponseMsg"></p>
        </div>  
             <div class="col-md-12">
              <div class="fields submitFields">
               
                <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                  <a class="goBackBtn" href="/account/profile">Cancel</a>
              </div>
            </div>     
           
           </form>
           
           </li>
           
           <li class="tsBilling profileList">
           
             <form action="" method="" >
           
            <h3>Billing</h3>
             <!---->
            	<div class="col-md-6">
                	<div class="fields">
                    
                   
                    <ul class="grid">
                    
                    <li class="mb20 card-wrapper">
            	<label class="mb10 hide" for="cardNumber">Cardholder Name</label>
            	<p class="cd">
            	
            		<input type="text" value="" placeholder="Cardholder Name" id="" name="" >
					
				</p>
                
                </li>
                    
        		<li class="mb20 card-wrapper">
            	<label class="mb10 hide" for="cardNumber">ENTER DEBIT CARD NUMBER</label>
            	<p class="cd">
            	
            		<input type="text" value="" placeholder="Enter Debit Card Number" data-type="ts" maxlength="23" id="cn1" name="" autocomplete="off" class="tsCardNumber  text-input large-input cardInput type-tel d" kl_virtual_keyboard_secure_input="on">
					<input type="hidden" class="required" value="" name="cardNumber">
				</p>
                
                </li>
			
            <li style="overflow:hidden; clear:both;" class="fl expiry-wrapper">
     	    	<label for="tsExpMonth" class="mb10 tsExpMonth tsExpYear">EXPIRY DATE</label>
               	<div class="mb10">
               		<div id="tsExpMonthWrapper" class="fl">
                	<select style="width: 80px;" name="ccExpiryMonth" id="tsExpMonth" class="tsExpMonth  combobox required dropdown">
                		<option value="0">MM</option>
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
               		</select>
               		</div>
               		
               	 	<div id="tsExpYearWrapper" class="fl ml10">
               			<select style="width: 80px;" name="ccExpiryYear" id="tsExpYear" class="tsExpYear combobox required dropdown">
             				<option value="0">YY</option>
                           <option value="2016">2016</option>
							  
							<option value="2017">2017</option>
							  
							<option value="2018">2018</option>
							  
							<option value="2019">2019</option>
							  
							<option value="2020">2020</option>
							  
							<option value="2021">2021</option>
							  
							<option value="2022">2022</option>
							  
							<option value="2023">2023</option>
							  
							<option value="2024">2024</option>
							  
							<option value="2025">2025</option>
							  
							<option value="2026">2026</option>
							  
							<option value="2027">2027</option>
							  
							<option value="2028">2028</option>
							  
							<option value="2029">2029</option>
							  
							<option value="2030">2030</option>
							  
							<option value="2031">2031</option>
							  
							<option value="2032">2032</option>
							  
							<option value="2033">2033</option>
							  
							<option value="2034">2034</option>
							  
							<option value="2035">2035</option>
							  
							<option value="2036">2036</option>
							  
							<option value="2037">2037</option>
							  
							<option value="2038">2038</option>
							  
							<option value="2039">2039</option>
							  
							<option value="2040">2040</option>
							  
							<option value="2041">2041</option>
							  
							<option value="2042">2042</option>
							  
							<option value="2043">2043</option>
							  
							<option value="2044">2044</option>
							  
							<option value="2045">2045</option>
							  
							<option value="2046">2046</option>
							  
							<option value="2047">2047</option>
							  
							<option value="2048">2048</option>
							  
							<option value="2049">2049</option>
							  
							<option value="2050">2050</option>
							  
							<option value="2051">2051</option>
							  
							</select>
               	 </div>
               	 <div class="clear"></div>
               </div>
               
               
               
                </li>
                
            
            <li id="tsCvvWrapper" class="ml10 fl relative">
               
                <div class="cvv-block">
                	<label class="mb10" for="cvvNumber">CVV</label>
                	<input type="text" autocomplete="off" class="f-hide" name="">
                	<input type="password" placeholder="CVV" maxlength="4" id="tsCvvBox" name="cvvNumber" autocomplete="off" class="tsCvvBox  text-input small-input width40 required type-tel" kl_virtual_keyboard_secure_input="on">
                	<div class="clear"></div>
                	</div>
                
                <div class="cvv-clue-box hide">
	                <div class="ts-cvv-clue ui-cluetip mt10">
	                	The last 3 digit printed on the signature panel on the back of your debit card.
	                </div>
	            </div>
            </li>
		</ul>
        
        
                   
                    
                    </div>
                </div>
                 <!---->
                 
                <div class="col-md-12">
                    <div class="fields submitFields">
                        <input type="submit" class="blueBtn" name="save" alt="Save" value="Save"/>
                          <a class="goBackBtn" href="/account/profile">Cancel</a>
                    </div>
                </div>
                 
                  </form> 
                
                </li>
            
           

                
                
            </ul>
        </div>
      </div>
      
    </div>
  </div>
  
  