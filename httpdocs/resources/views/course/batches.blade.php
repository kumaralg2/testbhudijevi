<div class="row">
    <div class="col-md-12 parent-category-row">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <a href="">
                    <img src="{{asset('assets/images/it-grey-icon.png')}}" alt=""> <b> Information Technology</b>
                </a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <a href="">
                    <img src="{{asset('assets/images/ps-grey-icon.png')}}" alt=""> Professional Courses
                </a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <a href="">
                    <img src="{{asset('assets/images/sme-grey-icon.png')}}" alt=""> SME Courses
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-12 child1-category-row white-bg">                        
        <ul>
            <li><a href="" class="active">Software Programing</a></li>
            <li><a href="">Storage and Backup</a></li>
            <li><a href="">Operating System</a></li>
        </ul>
    </div>

    <div class="col-md-12 white-bg">
        <ol class="breadcrumb">
            <li><a href="#">Information Technology</a></li>
            <li><a href="#">Software Programming</a></li>
            <li class="primary-color">Optic Fibres</li>
          </ol>
    </div>
    
    <div class="col-md-12 body-section">
        <h3>All courses and programs <small class="primary-color"><b> (<?php echo $count; ?> Courses)</b></small></h3>
    
        <!-- Course section starts -->    
        @foreach($batches as $batch)
        <div class="panel panel-default course-panel">
            <a  href="/course-description/{{$batch->aTrainingBatchMasterID}}">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-6 course-category"><b>{{$batch->course->tCoursetitle}}</b></div>
                        <div class="col-md-2 col-sm-2 col-xs-3 col-md-push-7 col-sm-push-7 col-xs-push-3 primary-color text-center"><b>Beginner</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="course-title">
                                <?php 
                                    $str = strip_tags($batch->course->tCoursedescription);
                                    echo substr($str,0,250);
                                ?>....
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-4">
                                    <?php 
                                        if( !empty($batch->course->tImageFileName) ){ ?>
                                            <img class="img-responsive" src="{{asset('/assets/images/'.$batch->course->tImageFileName)}}" />
                                    <?php } ?>
                                </div>
                                <div class="col-md-3 col-sm-8 col-xs-8">
                                    <?php
                                        if($batch->tBatchEnrolmentFees > 0) {
                                            if($batch->ndiscount >0){                                                
                                                    $discountedAmount = ($batch->ndiscount / 100) * $batch->tBatchEnrolmentFees;
                                                    $netAmount = number_format($batch->tBatchEnrolmentFees - $discountedAmount, 2);
                                                    echo " <dt class='primary-color'>INR ".$netAmount."</dt>";
                                                    echo "<dd><del>INR ".number_format($batch->tBatchEnrolmentFees,2)."</del> ($batch->ndiscount% Off)</dd>";
                                            }else{
                                                    echo " <dt class='primary-color'>INR ".number_format($batch->tBatchEnrolmentFees,2)."</dt>";
                                            }										  				
                                        }else {										  				
                                            echo "<dt class='primary-color'> Free Course </dt>";
                                        }
                                    ?>
                                    <br>
                                    <dl>
                                        <dt><b>{{$batch->course->instituite->tInstituteName}}</b></dt>
                                        <dd><?php if(isset($batch->course->instituite->tGoogleInsLoc)){ echo $batch->course->instituite->tGoogleInsLoc; }else{ echo $batch->course->instituite->tGoogleLoc;} ?></dd>                                    
                                    </dl>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 course-details">                                                
                                    <div class="row">
                                        <div class="col-md-5 col-sm-5 col-xs-5 text-left">
                                            <i class="fa fa-star-o star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o star" aria-hidden="true"></i>
                                            <i class="fa fa-star-o star" aria-hidden="true"></i>
                                            <span> 0 Ratings</span>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-7 text-right">
                                            <p><b>Enrollment Ends : </b> <b class="red-text"><?php echo date("d-m-Y", strtotime($batch->dEnrolmentExpDate)); ?></b></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <b>Program</b>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <p><b>{{$batch->tprogramname}}</b></p>
                                        </div>
                                    </div>
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
                                            $fac = App::make("App\Http\Controllers\CourseController")->getInsFacilities($batch->course->nUsrID);									
                                        ?>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <b>Facilities</b>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <p>
                                            @foreach( $fac as $facilities)
                                                {{$facilities->tfacilityname}}, 
                                            @endforeach
                                            </p>
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
        <?php echo $batches->render(); ?>
    </div>
</div>
{{--!! $batch->appends($_GET)->render() !!--}}