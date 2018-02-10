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
			 	<input type="hidden" name="_token" value="{{ csrf_token() }}">
			 	<input type="hidden" name="aCourseMasterID" value="{{$course->aCourseMasterID}}">
			   <div class="col-md-12">   
			  <div class="profileBox"><img src="/assets/images/{{$course->tImageFileName}}">
				  
			  </div>
			  
            <h3>Course Info</h3>
            <div class="col-md-6">
              <div class="fields">
                <label for="title">Title* ?</label>
                <input type="text" value="{{$course->tCoursetitle}}"  id="title" name="title"  disabled>
              </div>
              <div class="fields">
                <label for="subTitle">Sub Title* ?</label>
                <input type="text" value="{{$course->tCoursesubtitle}}" id="subTitle" name="subTitle" disabled  />
              </div>
            </div>
            <div class="col-md-6">
              <div class="fields">
                <label for="takshaLang">Language?</label>
				<?php
					$languages = DB::table('tbllanguagemaster')->whereNotIn('aCourseLangOptionID', [4,5])->get();
				?>
                <select  name="takshaLang" disabled>				
                  <option value="">Select</option>
				  @foreach($languages as $language)
                  <option value="{{$language->aCourseLangOptionID}}" <?php if($course->nCourseLangOptionID == $language->aCourseLangOptionID){ echo "selected"; } ?>>{{$language->tCourseLangName}}</option>
				  @endforeach
                </select>
              </div>
              <div class="fields">
                <label for="sectorBlk">Sector* ?</label>
				<?php
					$sectors = DB::table('tblsectormaster')->get();
				?>
                <select  name="sectorBlk" disabled>
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
                <input type="radio" value="{{$complexity->aCoursecomplexityMasterID}}" id="{{$complexity->tCourseComplexity}}" name="bie" <?php if($course->nCourseComplexityID == $complexity->aCoursecomplexityMasterID){ echo "checked"; } ?> disabled>
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
                <select  name="categories" onchange="getInterest(this.value)" disabled>


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
                <select class="dropdow" name="jobRoles" id="Interest" disabled>
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
        </div>
      </div>
   
	
  <div class="takshaInfo">
			
			  
            <h3>Training Institute Info</h3>
            <div class="col-md-6">
              <div class="fields">
                <label for="title"> Training Institute Name</label>
				 <input type="text" value="<?php if( isset($institute->tInstituteName) ){ echo $institute->tInstituteName; } ?>" id="subTitle" name="subTitle"  disabled />
              </div>
              <div class="fields">
                <label for="subTitle">Training Institute Contact Full Name</label>
                <input type="text" value="<?php if( isset($institute->tInstituteName) ){ echo $institute->tUsrFName.' '.$institute->tUsrLName; } ?>" id="subTitle" name="subTitle" disabled />
              </div>
            </div>	
            <div class="col-md-6">
              <div class="fields">
                <label for="title">   Training Institute Contact Email</label>
				 <input type="text" value="<?php if( isset($institute->tUsrEmail) ){ echo $institute->tUsrEmail; } ?>" id="subTitle" name="subTitle" disabled />
              </div>
              <div class="fields">
                <label for="subTitle">  Training Institute Mobile Number</label>
                <input type="text" value="<?php if( isset($institute->tUsrMobileNumber) ){ echo $institute->tUsrMobileNumber; } ?>" id="subTitle" name="subTitle" disabled />
              </div>
            </div>
			<?php
			if( isset($institute->aInstituteID) ) {
				$aff = DB::table('tbltakinstituteaffiliation')
					->join('tblaffiliationstatusmaster', 'tbltakinstituteaffiliation.naffiliationstatus', '=', 'tblaffiliationstatusmaster.aaffiliationstatusid')
					->join('tblcontract', 'tbltakinstituteaffiliation.ncontractid', '=', 'tblcontract.aContractID')
					->where('tbltakinstituteaffiliation.nInstituteid', $institute->aInstituteID)
                                        ->orderBy('tbltakinstituteaffiliation.atakaffiliationid','DESC')
					->first();
			}
			
			?>
            <div class="col-md-6">
              <div class="fields">
                <label for="title">   Contract Type</label>
				  <input type="text" value="<?php if( isset($aff->tContractName) ){ echo $aff->tContractName; } ?>"  disabled  />
              </div>
              <div class="fields">
                <label for="subTitle"> Status</label>
				  <input type="text" value="<?php if( isset($aff->tAffiliationStatus) ){ echo $aff->tAffiliationStatus; } ?>"  disabled  />
              </div>
            </div>
            <div class="col-md-6">
              <div class="fields">
                <label for="title">      Valid Until</label>
				  <input type="text" value="<?php if( isset($aff->denddate) ){ echo date("d-m-Y", strtotime($aff->denddate)); } ?>"  disabled  />
              </div>
            </div>	
		 
	
        </div>  
  <!--div class="takshaInfo">
			
			  
            <h3>Institute Affiliation</h3>
            <div class="col-md-12">
              <table class="table">
				<tr>	
					<td></td>
				</tr>
			  </table>
            </div>	
           
		 
	
        </div-->  
		
		<div class="takshaInfo">
			<form action="/appove-course" method="post" >
			   <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <h3>Approve</h3>
            			  
            <div class="col-md-12">
              <div class="fields radioRow">
                <p>Approved</p>				
				
				
                <label for="yes">Yes
                <input type="radio" value="3" id="yes" name="approved" <?php if( $course->nCourseStatusID == 3){ echo "checked"; } ?> required>
                <input type="hidden" value="{{$course->aCourseMasterID}}"  name="course_id" >
                </label>
				
                <label for="No">No
                <input type="radio" value="5" id="No" name="approved" <?php if( $course->nCourseStatusID == 5){ echo "checked"; } ?> required>
                </label>
				
              </div>
            </div>
			
			  
		 
            <!--<h3>Course Summary</h3>-->
            <div class="col-md-12">
              <div class="fields">
                <label for="summary">Comments</label>
                <textarea maxlength="250" id="summary" rows="5" cols="5" name="comments" required></textarea>
              </div>
            </div>
           
	
            
            <div class="col-md-12">
              <div class="fields"> <p id="resmsg"></p>  <p id="LoadingImag"></p> </div>
            </div>
            <div class="col-md-12">
              <div class="fields submitFields">
                <input class="blueBtn" type="submit" name="save" alt="Save" value="Submit"/>
  <a href="/course-listing" class="goBackBtn">CANCEL</a>
              </div>
            </div>
			</form>
        </div>
      </div>
    </div> 
	
  </div>
  
  
  <!---->
 
  <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

@endsection
@section('page_script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/assets/js/course.js"></script>
@endsection

