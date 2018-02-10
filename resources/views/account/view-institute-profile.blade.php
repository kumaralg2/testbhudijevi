@extends('layouts.master')
@section('title', 'Trainer Profile Page')
@section('content')
<script>
				$('.container-fluid').addClass('body-spc-aligned');
				$('.container-fluid').removeClass('body-section');
			</script>
<div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <!-- Profile Sidebar -->
                        <div class="col-md-12">
                            <iframe src="https://maps.google.com/maps?q=<?php echo $institute->lat; ?>,<?php echo $institute->lng; ?>&hl=es;z=14&amp;output=embed" width="345" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-12 txt-container  white-bg">
                            <div class="text-center">
                                <p>
                                    <b  class="primary-color"><?php echo $institute->tInstituteName; ?></b>
                                    <br>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <span>  Ratings</span>
                                </p>
                                <br>
                                <table class="table table-condensed txt-container table-tr-border">  
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="fa fa-home"></i></th>
                                            <td class=" text-left"><?php echo $institute->tGoogleInsLoc; ?></td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class=""><i class="fa fa-clock-o"></i></th> 
                                            <td class=" text-left"><?php if(!empty($institute->office_open_time)) { echo date("h:i A", strtotime($institute->office_open_time)); ?> - <?php echo date("h:i A", strtotime($institute->office_close_time)); } ?></td>
                                        </tr> 
                                        <tr>
                                            <th scope="row" class=""><i class="fa fa-phone"></i></th> 
                                            <td class=" text-left"><?php echo $institute->tInstitutePhoneNumber; ?></td>  
                                        </tr> 
                                        <tr>
                                            <th scope="row" ><i class="fa fa-users"></i></th> 
                                            <td class=" text-left"><?php echo $institute->trained_students_count; ?> Students Trained</td>  
                                        </tr>
                                    </tbody> 
                                </table>
                                <ul class="list-inline profile-icon">
                                    <li>
                                        <a href="<?php echo $institute->tInstituteFacebookAdd; ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $institute->tInstituteLinkedInAdd; ?>" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-12" style="display:none">
                            <h5 class="sidebar-title"><b>Send a message</b></h5>
                        </div>
                        <div class="col-md-12 txt-container white-bg" style="display:none">
                            <form>  
                                <div class="form-group">  
                                    <textarea class="form-control" rows="4" id="exampleInputPassword1" placeholder="Type your message here"></textarea> 
                                </div>
                                <button type="submit" class="btn btn-success full-width">Submit</button> 
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 txt-container white-bg">
                                <img width="700" src="<?php echo $institute->institute_banner_image; ?>" />                                             
                                <br>
                                <br>
                                <p><?php echo $institute->uProfileWriteup; ?></p> <br>
                                <h4>Expertise</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-condensed txt-container table-tr-border">  
                                            <tbody>
                                               <?php foreach($tblusrinstskillprof as $key_skill=>$value_skill){ ?>
                                                <tr>
                                                    <td><?php echo $value_skill->tSkillDescription; ?></td>
                                                </tr>
											<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>                             
                                </div>
                                <br>
                                <h4>Facilties</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">                                
                                        <ul class="facilities-list">
											<?php foreach( $tblinstitutefacilities as $key_faci=>$value_faci ): ?>
										  <li>
                                                <i class="fa fa-check-circle"></i>
                                                <a href=""><?php echo $value_faci->tfacilityname; ?></a>
                                            </li>   
										<?php endforeach; ?>											
                                           
                                        </ul>
                                    </div>
                                </div>
                                <br>
                                <h4>Affiliates</h4>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">                                
                                        <table class="table table-condensed txt-container table-tr-border">  
                                            <tbody>
											<?php foreach($tblusraffiliates as $key_affi=>$value_affi){ ?>
                                                <tr>
                                                    <td><?php echo $value_affi->name; ?></td>
                                                </tr>
											<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>

                                <!-- Forthcoming Training Batches Block -->
 <h4>Courses</h4>
                                <br>                           
							   <div class="col-md-12 body-section" id="AllCoursesAndP">
								@include('includes/all-courses')
							</div>
                            </div>  
                        </div> 
                        <div class="row" style="display:none"> 
                            <div id="ratings">                      
                                <h3 class="course-section-title">Ratings</h3>
                                <div class="col-md-6">
                                    <div class="media white-bg rating-container mb26"> 
                                        <div class="media-left"> 
                                            <a href="#"> 
                                                <img src="assets/img/rating-pic1.png">
                                            </a> 
                                        </div> 
                                        <div class="media-body"> 
                                            <p>
                                                <b> Bharat Parimi</b> &nbsp;
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o star" aria-hidden="true"></i>
                                                <br> Yesterday
                                            </p> 
                                            <p>Very good in general. Explanations were clear</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media white-bg rating-container mb26"> 
                                        <div class="media-left"> 
                                            <a href="#"> 
                                                <img src="assets/img/rating-pic2.png">
                                            </a> 
                                        </div> 
                                        <div class="media-body"> 
                                            <p>
                                                <b> Chandan Das</b> &nbsp;
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o star" aria-hidden="true"></i>
                                                <br> Yesterday
                                            </p> 
                                            <p>Very good in general. Explanations were clear</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="media white-bg rating-container mb26"> 
                                        <div class="media-left"> 
                                            <a href="#"> 
                                                <img src="assets/img/rating-pic3.png">
                                            </a> 
                                        </div> 
                                        <div class="media-body"> 
                                            <p>
                                                <b> Abhishek Mishra</b> &nbsp;
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o star" aria-hidden="true"></i>
                                                <br> Yesterday
                                            </p> 
                                            <p>Very good in general. Explanations were clear</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
@endsection