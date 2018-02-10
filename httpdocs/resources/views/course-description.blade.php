@extends('layouts.master')
@section('title', 'Course Description')
@section('content')
<?php $course = $course[0]; ?>
<?php
    $user_and_ins = App::make("App\Http\Controllers\CourseController")->getUserAndInstituteInfo($course->nUsrID);	
    $fac = App::make("App\Http\Controllers\CourseController")->getInsFacilities($course->nUsrID);						
    $trainer = App::make("App\Http\Controllers\AccountController")->getTrainerInfo($course->ntrainer_usrid);
    $edu_info = DB::table('tblusereduinfo')
        ->join('tblinstitutemaster', 'tblusereduinfo.nInstitutionMasterID', '=', 'tblinstitutemaster.aInstituteID')
        ->join('tbldegreemaster', 'tblusereduinfo.nDegreeid', '=', 'tbldegreemaster.aDegreeID')
        ->where('tblusereduinfo.nUsrID', $course->ntrainer_usrid)
        ->get();
    $tblusrinstskillprof = DB::table('tblusrinstskillprof')
        ->where('nusrid', $course->ntrainer_usrid)
        ->get();
    $user_lang = DB::table('tbluserlang')
        ->join('tbllanguagemaster', 'tbluserlang.nlangid', '=', 'tbllanguagemaster.aCourseLangOptionID')
        ->where('tbluserlang.nuserid', $course->ntrainer_usrid)
        ->get();
    $sector = DB::table('tblsectormaster')
        ->where('aSectorID', $course->nSectorID)
        ->first();
    if($course->nCourseCategoryID){
        $category = DB::table('tblcourseaspintcategory')
            ->where('aAspIntCatID', $course->nCourseCategoryID)
            ->first();
    } else {
        $category = '';
    }
    
    // Program Details
    $program = DB::table('tblprogramme')
            ->where('aProgramid', $course->nProgramid)
            ->first();

?>

@include('course/sector_horizontal')

<div class="container-fluid bg-primary-color course-highlight">
    <div class="row">
        <div class="container">
            <div class="col-md-7">
                <p class="course-title-big">{{$course->tCoursetitle}}</p>
                <p>{{$course->tCoursesubtitle}}</p>
                <?php
                    $instuteDetailsObj = DB::table('tblinstitutemaster')					
                    ->where('tblinstitutemaster.aInstituteID', $course->nInstituteID)
                    ->get();
                    $instuteDetailsArray = json_decode(json_encode($instuteDetailsObj), True);
                ?>
                <p><?php echo $instuteDetailsArray[0]['tInstituteName'].', '; ?><small> <?php if(isset($user_and_ins->tGoogleInsLoc)){ echo $user_and_ins->tGoogleInsLoc; }else{ echo $user_and_ins->tGoogleLoc;} ?></small></p>
                <?php
                    $rating_info = DB::table('tbl_rating')
                                ->select(['nCourseID', DB::raw("IFNULL(count(tbl_rating.rating),0) as count"),
                                    DB::raw("IFNULL(sum(tbl_rating.rating),0) as total")
                                ])
                                ->where('nCourseID',$course->nCourseMasterid)->first();
                    if($rating_info->count){                                    
                        $average_rating = $rating_info->total/$rating_info->count;
                    } else {
                        $average_rating = 0;
                    }
                ?>
                <div class="star-rating sizex">
                    <?php 
                        for($i=1; $i<=5; $i++){
                            if($i <= $average_rating) {
                                $class = 'fa-star';
                            } else {
                                $class = 'fa-star-o';
                            }
                            echo '<i class="fa '.$class.' star" aria-hidden="true"></i>';
                        }
                    ?>
                    <span> 
                        
                    </span>
                </div>
                <p>
                    @if($rating_info->count)
                        {{$rating_info->count}} Ratings
                    @else
                        0 Ratings
                    @endif
                </p>
                <ul class="list-inline soc-icon-big">
                  <li><a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    <li><a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href=""><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if($course->tBatchEnrolmentFees > 0) {
                            if($course->ndiscount >0){
                                echo '<p class="price-big"><del>INR '.number_format($course->tBatchEnrolmentFees,2)."/-</del></p>";
                                $discountedAmount =  ($course->ndiscount / 100) * $course->tBatchEnrolmentFees;				  					
                                $netAmount = number_format($course->tBatchEnrolmentFees - $discountedAmount, 2);
                                echo '<p class="price-big">'.$netAmount.' /-</p>';
                                echo '<p>('.$course->ndiscount.'% - Early Bird Discount)</p>';
                            }else{
                                echo '<p class="price-big">INR'.number_format($course->tBatchEnrolmentFees,2).' /- </p>';	
                            }										  				
                        } else {									  				
                            echo '<p class="price-big">Free Course</p>';
                        }
                        ?>
                    </div>
                    <div class="col-md-6">
                        <p class="enroll-button-default enroll-active"><a href="" data-toggle="modal" data-target="#enquire-modal">Enroll Now</a></p>
                        <p class="enroll-button-default"><a href="" data-toggle="modal" data-target="#enquire-modal">Enquire</a></p>
                    </div>
                </div>
                @if(isset($program))
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Programme :</strong> {{$program->tprogramname}}
                            <?php if($program->tprogramURL) { ?>
                                <small><a id="yellow-text" href="{{$program->tprogramURL}}" target="new">( Eligibility Criteria and Benefits )</a></small>
                            <?php } ?> 
                        </p>
                        <p><a href="#" data-toggle="modal" data-target="#programCert"><small>Program Certificate</small></a></p>
                        
                        <!-- Program certification Modal -->
                        <div id="programCert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="programCertLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <h4 class="modal-title text-center primary-color" id="programCertLabel">Sample Program Certificate</h4>
                                    </div>
                                    <div class="modal-body">
                                      <img class="img-responsive" src="/assets/images/certificate_sample.jpg" />
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="container container-body">
    <div class="row">
        
        <div class="col-md-12 mbot20">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/course/list">All Courses</a></li>
                <?php
                    if($sector){
                        echo '<li><a href="/course/list?sector_id='.$sector->aSectorID.'">'.$sector->tSectorName.'</a></li>';
                    }
                ?>                
                <?php
                    if($category && $sector){
                        echo '<li><a href="/course/list?sector_id='.$sector->aSectorID.'&category_id='.$category->aAspIntCatID.'">'.$category->tAspIntCategory.'</a></li>';
                    }
                ?>
                <li>{{$course->tCoursetitle}}</li>                      
            </ol>
        </div>
        <div class="col-md-12">
            <ul class="list-inline course-detail-page">
                <li><a href="#course-overview" class="info-active">Course Details</a></li>
                <li><a href="#ratings">Ratings</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="course-overview" id="course-overview">
                <h3 class="course-section-title">Overview</h3>
                <?php echo $course->tCoursedescription; ?>
            </div>
            
            <!-- Ratings -->
            <div id="ratings">                            
                <h3 class="course-section-title">Ratings</h3>
                <div class="row">
                    
                @if($ratings)
                @foreach($ratings as $rating)
                <div class="col-md-6">
                    <div class="media white-bg rating-container mb26"> 
                        <div class="media-left"> 
                            <a href="#"> 
                                @if($rating->pImageFileName)
                                    <img class="img-circle" width="66" height="66" src="/assets/images/{{$rating->pImageFileName}}"/>
                                @else
                                    <img class="img-circle" src="https://dummyimage.com/66x66/7a7a7a/fff&text=+">
                                @endif
                                
                            </a> 
                        </div> 
                        <div class="media-body"> 
                            <p>
                                <b> {{$rating->tUsrFName}}  {{$rating->tUsrLName}}</b>
                                <?php 
                                    for($i=1; $i<=5; $i++){
                                        if($i <= $rating->rating) {
                                            $class = 'fa-star';
                                        } else {
                                            $class = 'fa-star-o';
                                        }
                                        echo '<i class="fa '.$class.' star" aria-hidden="true"></i>';
                                    }
                                ?>
                                <br> <small><?php echo date("F j, Y, g:i a", strtotime($rating->created_at)); ?></small>
                            </p> 
                            <p class="rating-comment">{{ str_limit($rating->ratingSummary, $limit = 64, $end = '...') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                    <div class="col-md-12">                        
                        <p>No rating added yet !!</p>
                    </div>
                @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success"  data-toggle="modal" data-target="#ratingModal">Write Feedback</button>                                                
                        <!-- Rating Modal -->
                        <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModal">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title text-center primary-color" id="ratingModal">Leave your feedback</h4>
                              </div>
                              <div class="modal-body">
                                  <form class="form-horizontal" id="formRating" >
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="nCourseID" id="token" value="{{ $course->nCourseMasterid }}">
                                        <div class="form-group">
                                          <label for="inputrating" class="col-sm-3 control-label">Your Rating</label>
                                          <div class="col-sm-8">
                                              <select class="form-control" name="rating" id="inputrating">
                                                  <option value="">Select Your Option</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>                                                  
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="inputRatingComment" class="col-sm-3 control-label">Feedback</label>
                                          <div class="col-sm-8">
                                              <textarea name="ratingComment" class="form-control"></textarea>
                                          </div>
                                        </div>
                                        <div class=""form-group">
                                             <div class="col-sm-offset-3 col-sm-9">
                                                <p class="enquireResponseMsg"></p>
                                                <p id="LoadingImag"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-2">
                                              <button type="submit" class="btn btn-success">Submit</button>
                                            </div>                                            
                                        </div>
                                    </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Instructor Right Panel -->
        <div class="col-md-5">
            <h3>Instructor</h3>
            <div class="media"> 
                <div class="media-left"> 
                    <a href="#"> 
                        <?php if(isset($trainer->pImageFileName)){ ?>
                        <img width="64" height="64" src="/assets/images/{{$trainer->pImageFileName}}" class="media-object" />
                        <?php } else { ?>
                            <img alt="64x64" class="media-object" data-src="holder.js/64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTk2NTU3YzJiZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1OTY1NTdjMmJkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 64px; height: 64px;"> 
                        <?php } ?>                      
                    </a> 
                </div> 
                <div class="media-body"> 
                    <p>
                        <a href="" class="red-text"> {{$trainer->tUsrFName}} {{$trainer->tUsrLName}}</a> <br>
                    </p>
                </div>
                <p>
                    {{$trainer->uProfileWriteup}}
                </p>
                <br>
                <table class="table instructor-table">
                    <tbody> 
                        <tr>   
                            <td>Mode</td> 
                            <td class="text-left">{{$course->tCourseModetype}}</td> 
                        </tr> 
                        <tr>   
                            <td>Facilities</td> 
                            <td class="text-left">
                                @foreach( $fac as $facilities)
                                    {{$facilities->tfacilityname}},
                                @endforeach
                            </td> 
                        </tr> 
                        <tr>
                            <td>Duration</td> 
                            <td class="text-left">{{$course->nTotalBatchDuration}} Days</td> 
                        </tr>  
                        <tr>
                            <td>Course Level</td> 
                            <td class="text-left">{{$course->tCourseComplexity}}</td> 
                        </tr> 
                        <tr>
                            <td>Batch Start Date</td> 
                            <td class="text-left"><?php echo date("d-m-Y", strtotime($course->dTrainingBatchStDate)); ?></td> 
                        </tr> 
                        <tr>
                            <td>Batch End Date</td> 
                            <td class="text-left"><?php echo date("d-m-Y", strtotime($course->dTrainingBatchEndDate)); ?></td> 
                        </tr> 
                        <tr>
                            <td><b>Enrollment Ends </b></td> 
                            <td class="text-left red-text"><b><?php echo date("d-m-Y", strtotime($course->dEnrolmentExpDate)); ?></b></td> 
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

    </div>


    </div>

<!-- Modal -->
    <div id="enquire-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center primary-color">Enroll (or) Enquire</h4>
          </div>
          <div class="modal-body">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">Pay Now</a></li>
                  <li role="presentation"><a href="#enroll" aria-controls="enroll" role="tab" data-toggle="tab">Enquire</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="pay">
                        <form action="" method="" id="enrole">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="nBatchid" id="token" value="{{ $course->aTrainingBatchMasterID }}">
                            <input type="hidden" name="cRadio" id="callBack" value="Pay Now">
                            <div class="table-responsive">   
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th width="25%" class="first">Course</th>
                                            <th width="25%">Quantity</th>
                                            <th width="25%">&nbsp;</th>
                                            <th width="25%">Price</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        if($course->tBatchEnrolmentFees > 0) {
                                            $enrollmentFee = number_format($course->tBatchEnrolmentFees,2);	
                                            $netAmount = number_format($course->tBatchEnrolmentFees,2);	
                                            if($course->ndiscount >0){		  					
                                                    $discountedAmount =  ($course->ndiscount / 100) * $course->tBatchEnrolmentFees;				  					
                                                    $netAmount = number_format($course->tBatchEnrolmentFees - $discountedAmount, 2);
                                            }										  				
                                        }else {	
                                            echo "Free Course";
                                        }
                                        ?>
                                    <tbody>
                                    <tr>
                                        <td class="first">{{$course->tCoursetitle}}</td>
                                        <td>1</td>
                                        <td>&nbsp;</td>
                                        <td>Rs {{ (!empty($enrollmentFee) ? $enrollmentFee : 'Free' ) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="first">*Includes service Tax as applicable</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="first">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>Gross Amount</td>
                                        <td>Rs {{ (!empty($enrollmentFee) ? $enrollmentFee : 'Free' ) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="first">Course discount code:</td>
                                        @if($course->tdiscountcuponcode)
                                        <td>Coupon <span class="coupon-code">{{$course->tdiscountcuponcode}}</span> already applied</td>
                                        @else
                                            <td><input type="text" placeholder="Discount Code"value="" id="" name="" /></td>
                                        @endif                              
                                        
                                        <td>Discount Amount</td>
                                        <td>Rs {{ (!empty($discountedAmount) ? $discountedAmount : '0.00' ) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="first">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>Net Amount</td>
                                        <td>Rs {{ (!empty($netAmount) ? $netAmount : ' ' ) }}</td>
                                        <!--<td><a href="#" class="proceedBtn">Proceed to pay</a></td>-->					
                                    </tr>
                                    <tr>
                                        <td>Leave Comment:</td>
                                        <td colspan="3">				
                                            <textarea name="tCourseComment" cols="55" rows="6" class="tCourseComment" maxlength="250"></textarea>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>						
                                            <input type="submit" value="Submit" alt="Save" name="save" class="greenBtn">
                                        </td>
                                        <td colspan="3">
                                            <div class="col-md-12">
                                                <p id="LoadingImag"></p>
                                                <p class="enroleResponseMsg"></p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><b>Note</b>: Clicking on Submit button only means your interest in Enrolment, and NOT successful process of your Payment . We will send you a separate payment link on to your registered Email, or a representative will get in touch with you. Thank you!</td>
                                    </tr>
                                    </tbody>
                                </table>  
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="enroll">                        
                        <form method="" action="" id="Enquire" class="form-horizontal">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="nBatchid" id="token" value="{{ $course->aTrainingBatchMasterID }}">
                            <br>
                            <div class="form-group">                                                     
                                <div class="col-sm-6 col-sm-offset-1">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="radio" name="cRadio" id="appointment" value="Schedule an appointment"> <label for="appointment"> Schedule an appointment</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="radio" name="cRadio" id="ccallBack" value="Request Callback"><label for="ccallBack"> Request Callback</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <input type="text" class="form-control" name="cMobile" id="cMobile" value="{{Auth::user()->tUsrMobileNumber}}" placeholder="Mobile Number" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <input type="text" class="form-control" name="cDate" id="cDate" value="" placeholder="Date" type="date"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <input type="text" class="form-control timepicker" name="cTime" id="cTime" value="" placeholder="Time" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <label for="tCourseComment">Leave comment</label>
                                    <textarea id="tCourseComment" name="tCourseComment" cols="5" rows="5" class="tCourseComment form-control" maxlength="250"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-1">
                                <p id="LoadingImag"></p>
                                <p class="enquireResponseMsg"></p>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <input type="submit" value="Submit" alt="Save" name="save" class="greenBtn">
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $("#AddComment").validate({
    	rules: {
    		tCourseComment : 'required',		
    	},
    	messages: {
    	},
    	submitHandler: function(form) {
    		var formData = $("form#AddComment").serialize();
                var loader = "{{asset('assets/images/ajax-loader.gif')}}";
    		$('p#LoadingImag').html('<img src="'+loader+'">');
    		$.ajax({
    			url: '/account/add-comment',
    			type: 'POST',
    			data: formData,
    			dataType: "json",
    			success: function (data) {
    				$('p#LoadingImag').html('');
    				if(data.status == 'success'){
    					$('.tCourseComment').val('');
    					$('.ResponseMsg').html(data.msg)
    				}else{
    					$('.ResponseMsg').html(data.msg)
    				}
    				
    			}
    		});
    	},
    });
    
    
    
    $("#enrole").validate({
    	rules: {
    		tCourseComment:{
    			required: true,
    		},
    	},
    	messages: {
    		tCourseComment :  "Please enter a comment ",
    	},
    	submitHandler: function(form) {
    		var formData = $("form#enrole").serialize();
                var loader = "{{asset('assets/images/ajax-loader.gif')}}";
    		$('p#LoadingImag').html('<img src="'+loader+'">');
    		$.ajax({
    			url: '/account/add-enrole',
    			type: 'POST',
    			data: formData,
    			dataType: "json",
    			success: function (data) {
    				$('p#LoadingImag').html('');
    				if(data.status == 'success'){
                                    document.getElementById('enrole').reset();
                                    $('.enroleResponseMsg').html(data.msg)
    				}else{
                                    $('.enroleResponseMsg').html(data.msg)
    				}
    				
    			}
    		});
    	},
    });
    
    
    
    
    $.validator.addMethod("time", function(value, element) {  
    	return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(value);  
    }, "Please enter a valid time.");
    
    
    $("#Enquire").validate({
    	rules: {
    		cRadio: 'required',
    		cDate:{required: true, date: true},
    		cMobile: {
    			required: true,
    			minlength: 10,
    			number: true,
    		},								
    		cTime: {
    			required: "true time",
    			
    		},	
    		tCourseComment:{
    			required: true,
    		},
    	},
    	messages: {
    	  cRadio: "Please select an option ",
    	  cTime: "Please enter valid time",
    	  cMobile: "Please enter valid mobile number",
    	  cDate: "Please enter a valid date",
    	  tCourseComment :  "Please enter a comment ",
    	  
    	},
    	submitHandler: function(form) {
    		var formData = $("form#Enquire").serialize()
                var loader = "{{asset('assets/images/ajax-loader.gif')}}";
    		$('p#LoadingImag').html('<img src="'+loader+'">');
    		$.ajax({
    			url: '/account/add-enquire',
    			type: 'POST',
    			data: formData,
    			dataType: "json",
    			success: function (data) {
    				$('p#LoadingImag').html('');
    				if(data.status == 'success'){
    					document.getElementById('Enquire').reset();
    					$('.enquireResponseMsg').html(data.msg)
    				}else{
    					$('.enquireResponseMsg').html(data.msg)
    				}
    				
    			}
    		});
    	},
    });

    $("#formRating").validate({
    	rules: {
            rating: 'required',
            ratingComment: 'required'
    	},
    	messages: {
            rating: "Please select an option ",
            ratingComment: "Please enter valid feedback"	  
    	},
    	submitHandler: function(form) {
            var formData = $("form#formRating").serialize();
            var loader = "{{asset('assets/images/ajax-loader.gif')}}";
            $('p#LoadingImag').html('<img src="'+loader+'">');
            $.ajax({
                url: '/course/add-rating',
                type: 'POST',
                data: formData,
                dataType: "json",
                success: function (data) {
                    $('p#LoadingImag').html('');
                    if(data.status == 'success'){
                        document.getElementById('formRating').reset();
                        $('.enquireResponseMsg').html('<p class="primary-color">'+data.message+'</p>');
                    }else{
                        $('.enquireResponseMsg').html('<p class="red-text">'+data.message+'</p>');
                    }
                }
            });
    	},
    });
$('#enquire a').click(function (e) {
  $(this).tab('show')
})

$(function() {
    $("#cDate").datepicker({
        dateFormat: 'yy/mm/dd',
        minDate : 0
    });
    $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        minTime: '10',
        maxTime: '6:00pm',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});

</script>
@endsection