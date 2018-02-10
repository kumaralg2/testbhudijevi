<!-- Flash Message -->
@if(Session::has('message'))
<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> {{ Session::get('message') }}.
</div>
@endif

@if($total > 0)
	<?php if(isset($page) && $page == 'profile' ) { ?>
<?php }else{ ?>
<h3>All courses and programs <small class="primary-color"><b> ({{ $total }} Courses)</b></small></h3>
<?php } ?>
<!-- Course section starts -->    
@foreach( $batch as $key=>$value )
<div class="panel panel-default course-panel">
	
    <a  href="/course-description/{{$value->aTrainingBatchMasterID}}/?location={{Input::get('location')}}&keyword={{Input::get('keyword')}}">

        <div class="panel-body">
            <div class="row">
                <div class="col-md-5 col-sm-8 col-xs-7 course-category">
                    <b>{{$value->tCoursetitle}} </b>
                </div>
                <div class="col-md-3">                    
                    <?php
                        $rating_info = DB::table('tbl_rating')
                                ->select(['nCourseID', DB::raw("IFNULL(count(tbl_rating.rating),0) as count"),
                                    DB::raw("IFNULL(sum(tbl_rating.rating),0) as total")
                                ])
                                ->where('nCourseID',$value->nCourseMasterid)->first();
                        if($rating_info->count){                                    
                            $average = $rating_info->total/$rating_info->count;
                        } else {
                            $average = 0;
                        }
                    ?>
                    <?php 
                        for($i=1; $i<=5; $i++){
                            if($i <= $average) {
                                $class = 'fa-star';
                            } else {
                                $class = 'fa-star-o';
                            }
                            echo '<i class="fa '.$class.' star" aria-hidden="true"></i>';
                        }
                    ?>
                    <span> 
                        @if($rating_info->count)
                        {{$rating_info->count}} Ratings
                        @else
                        0 Ratings
                        @endif
                    </span>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-5 text-right">
                    <p><b>Enrollment Ends : </b> <b class="red-text"><?php echo date("d-m-Y", strtotime($value->dEnrolmentExpDate)); ?></b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="course-title">
                        {{$value->tCoursesubtitle}}
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-4">
                            <?php 
                                if( !empty($value->tImageFileName) ){ ?>
                                    <img class="img-responsive" src="{{asset('/assets/images/'.$value->tImageFileName)}}" />
                            <?php } else { ?>
                                   <img src="https://dummyimage.com/180x126?text=Buddhijeevi.com" /> 
                            <?php } ?>
                        </div>
                        <div class="col-md-3 col-sm-8 col-xs-8">
                            <?php
                                if($value->tBatchEnrolmentFees > 0) {
                                    if($value->ndiscount >0){                                                
                                            $discountedAmount = ($value->ndiscount / 100) * $value->tBatchEnrolmentFees;
                                            $netAmount = number_format($value->tBatchEnrolmentFees - $discountedAmount, 2);
                                            echo " <dt class='primary-color'>INR ".$netAmount."</dt>";
                                            echo "<dd><del>INR ".number_format($value->tBatchEnrolmentFees,2)."</del> ($value->ndiscount% Off)</dd>";
                                    }else{
                                            echo " <dt class='primary-color'>INR ".number_format($value->tBatchEnrolmentFees,2)."</dt>";
                                    }										  				
                                }else {										  				
                                    echo "<dt class='primary-color'> Free Course </dt>";
                                }
                            ?>
                            <?php
                                $instuteDetailsObj = DB::table('tblinstitutemaster')					
                                    ->where('tblinstitutemaster.aInstituteID', $value->nInstituteID)
                                    ->get();
                                $instuteDetailsArray = json_decode(json_encode($instuteDetailsObj), True);
                                $user_and_ins = App::make("App\Http\Controllers\CourseController")->getUserAndInstituteInfo($value->nUsrID);
                            ?>
                            <br>
                            <dl>
                                <dt><b>{{$instuteDetailsArray[0]['tInstituteName']}}</b></dt>
                                <dd><?php if(isset($user_and_ins->tGoogleInsLoc)){ echo $user_and_ins->tGoogleInsLoc; }else{ echo $user_and_ins->tGoogleLoc;} ?></dd>                                    
                            </dl>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 course-details">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <b>Verifications</b>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <p><i class="fa fa-check-circle tab-space green" aria-hidden="true"></i> Course <i class="fa fa-check-circle tab-space green" aria-hidden="true"></i> Institute <i class="fa fa-check-circle tab-space green" aria-hidden="true"></i> Trainer</p>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                    $fac = App::make("App\Http\Controllers\CourseController")->getInsFacilities($value->nUsrID);									
                                ?>
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <b>Facilities</b>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <p>
                                    @foreach( $fac as $facilities)
                                    {{$facilities->tfacilityname}},
                                    @endforeach
                                     ... more</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <b>Program</b>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <p><b class="color-black">{{$value->tprogramname}}</b><small> (*Eligibility criteria will be applicable)</small></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <b>Mode</b>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9">                                    
                                    <p class="primary-color"><b>{{$value->tCourseModetype}}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>    
@endforeach
@else 
<?php if(isset($page) && $page == 'profile' ) { ?>
<h4 class="primary-color text-center">Sorry !! No course found.</h4>
<?php }else{ ?>
<h4 class="primary-color text-center">Sorry !! No course found for your selection. Kindly reset your selection.</h4>
<?php } ?>
@endif
{{--!! $batch->appends($_GET)->render() !!--}}