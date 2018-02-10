@extends('layouts.master')
@section('title', 'Trainer Profile Page')
@section('content')
			<script>
				$('.container-fluid').addClass('body-spc-aligned');
				$('.container-fluid').removeClass('body-section');
			</script>
            <div class="container ">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <!-- Profile Sidebar -->
                        <div class="col-md-12 txt-container  white-bg">
                            <div class="text-center">
                                <img src="/assets/images/<?php echo $tblusermaster->pImageFileName; ?>" />
                                <br>
                                <br>
                                <p>
                                    <b  class="primary-color"><?php echo $tblusermaster->tUsrFName; ?> <?php echo $tblusermaster->tUsrLName; ?></b>
                                    <br>
                                    <b><?php if( isset($tbluserworkexp[0]->tUsrWorkExpDesignation) ) { echo $tbluserworkexp[0]->tUsrWorkExpDesignation . ' at '. $tbluserworkexp[0]->tUsrExpInstitution; } ?></b>
                                    <br>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <i class="fa fa-star star" aria-hidden="true"></i>
                                    <span>  Ratings</span>
                                </p>
                                <br>
                                <p><?php //echo $tblusermaster->uProfileWriteup; ?></p>
                                <br>
                                <table class="table table-condensed txt-container table-tr-border">  
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="fa fa-graduation-cap"></i></th>
                                            <td class=" text-left"><?php if(isset($education->tDegree)){ echo $education->tDegree . ' from ' .$education->tInstituteName; } ?>  </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class=""><i class="fa fa-clock-o"></i></th> 
                                            <td class=" text-left"><?php echo $tblusermaster->trained_hours; ?> Hours</td>
                                        </tr> 
                                        <tr>
                                            <th scope="row" class=""><i class="fa fa-user"></i></th> 
                                            <td class=" text-left"><?php echo $tblusermaster->trained_student_count; ?> Students</td>  
                                        </tr> 
                                        <tr>
                                            <th scope="row"><i class="fa fa-trophy"></i></th> 
                                            <td class=" text-left">
											<?php foreach( $tbl_user_certification as $uc_key=>$uk_value ){
												echo $uk_value->certification_name . '<br>';
											}?>
											</td>  
                                        </tr>
                                    </tbody> 
                                </table>
                                <ul class="list-inline profile-icon">
                                    <li>
                                        <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa fa-linkedin" aria-hidden="true"></i></a>
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
                        <div class="col-md-12" style="display:none">
                            <h5 class="sidebar-title"><b>Recent Ratings</b></h5>
                            <div class="row">
                                <div class="col-md-12 white-bg txt-container mb10">
                                    <div class="media"> 
                                        <div class="media-left"> 
                                            <a href="#"> 
                                                <img src="{{asset('assets/img/rating-pic1.png')}}" />
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
                                <div class="col-md-12 white-bg txt-container mb10">
                                    <div class="media"> 
                                        <div class="media-left"> 
                                            <a href="#"> 
											 <img src="{{asset('assets/img/rating-pic2.png')}}" />
                                            </a> 
                                        </div> 
                                        <div class="media-body"> 
                                            <p>
                                                <b>Chandan das</b> &nbsp;
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star star" aria-hidden="true"></i>
                                                <i class="fa fa-star-o star" aria-hidden="true"></i>
                                                <br> 7 Days ago
                                            </p> 
                                            <p>Very good in general. Explanations were clear</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 white-bg txt-container mb10">
                                    <div class="media"> 
                                        <div class="media-left"> 
                                            <a href="#"> 
                                                <img src="{{asset('assets/img/rating-pic3.png')}}" />
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
                                            </p> 
                                            <p>Very good in general. Explanations were clear</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="primary-color"><b>View All</b></p>
                        </div>
                    </div>
                    <div class="col-md-8 white-bg txt-container">
                        <h4>About</h4>
                        <table class="table table-condensed txt-container table-tr-border">  
                            <tbody>
                                <tr>
                                    <th scope="row"><b>Name </b></th>
                                    <td class=" text-left"><?php echo $tblusermaster->tUsrFName; ?> <?php echo $tblusermaster->tUsrLName; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class=""><b>Role</b></th> 
                                    <td class=" text-left"><?php if( $tblusermaster->nUsrRoleID == 1003 ){ echo "Trainer"; }else if($tblusermaster->nUsrRoleID==1004){ echo "Student"; } ?></td>
                                </tr> 
                                <tr>
                                    <th scope="row" class=""><b>Skill Sets</b></th> 
                                    <td class=" text-left"><?php echo $skillsets; ?></td>  
                                </tr> 
                                <tr>
                                    <th scope="row"><b>Experience</b></th> 
                                    <td class=" text-left"><?php echo $exp_count; ?></td>  
                                </tr>
                                <tr>
                                    <th scope="row"><b>Languages</b></th> 
                                    <td class=" text-left"><?php echo $languagesets; ?></td>  
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <p><?php echo $tblusermaster->uProfileWriteup; ?></p>
                        <br>
                        <h4>Work Experience</h4>
                        <table class="table table-condensed txt-container table-tr-border">  
                            <tbody>
								<?php foreach( $tbluserworkexp as $we_key=>$we_value ) { ?>
                                <tr>
                                    <td class=" text-left"><?php echo $we_value->tUsrWorkExpDesignation; ?> at <?php echo $we_value->tUsrExpInstitution; ?> from <?php echo date("F Y", strtotime($we_value->tUsrExpFrom)); ?>  <?php if(date("Y", strtotime($we_value->tUsrExpTo)) == 1970 ) { }else{ echo 'to '. date("F Y", strtotime($we_value->tUsrExpTo));} ?> </td>
                                </tr>
								<?php } ?>  
                            </tbody>
                        </table>
                        <br>
                        <h4>Certifications</h4>
                        <table class="table table-condensed txt-container table-tr-border">  
                            <tbody>
							<?php foreach( $tbl_user_certification as $uc_key=>$uk_value ){ ?>
												
											
                                <tr>
                                    <td class=" text-left"><?php echo $uk_value->certification_name; ?></td>
                                </tr>
								<?php }?>
                            </tbody>
                        </table>
                        <br>
                        <?php if( !isset($studprofile) ){ ?>
                        <!-- Forthcoming Training Batches Block -->
                        <h4>Forthcoming Training Batches</h4>
                        <div class="col-md-12 body-section" id="AllCoursesAndP">
							@include('includes/all-courses')
						</div>
						
                        <hr>
						<?php } ?>
                    </div>
                </div>
            </div>
			
@endsection