@extends('layouts.master')
@section('title', 'Batch List')
@section('content')
@include('layouts/banner')					
	<div class="container">
		<div class="row">
		
			<div class="manageWrapper tableListTemp">
                   
                    	<!---->
                        <div class="col-md-12"> 
                        <div class="row">
                         <form action="" method="">
                         
                         	<div class="col-md-6">
                                <div class="tsSearch" style="display:none">
                                    <label for="sCourse">Search Your Course Batches</label> 
                                    <input type="search" placeholder="Search Your Course Batches" value="" id="sCourse" name="sCourse" />
                                    <input type="submit" placeholder="" value="Submit" id="submit" name="submit" />
                                </div>
                            </div>
							<div class="col-md-6" style="padding-bottom:20px">
                            	<div class="sortList">
                                
                                
                               	<span>List by:</span>
                               
                               <label for="sortL">Category</label>
                                <select class="dropdown" name="sortL" onchange="getBatchByStatus(<?php echo $course->aCourseMasterID; ?>, this.value); return false">
								<?php 
								$batch_status = DB::table('tblbatchstatus')->get();
								?>
                                    <option value="">Select</option>
                                  @foreach( $batch_status as $key=>$value )
									<option value="{{$value->abatchstatusid}}" 
									<?php if(isset($_GET['status']) && $_GET['status'] == $value->abatchstatusid){ echo "selected"; }?>
									>{{$value->tbatchstatus}}</option>
								  @endforeach
                                   
                                </select>      
                          
                              
                                
                                </div>
                              
                            </div>   
                            
                         
                                               
                        		</form>
                                
                       
                        </div>
                        
                               
                        </div>
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ URL::to('/')}}">Home</a></li>
                                <li><a href="/course-listing" title="">Manage Listing</a></li>
                                <li>Batches - <?php echo $course->tCoursetitle; ?></li>
                            </ol>
                                
                        	
                        </div>
					
					<div class="col-md-12">
                  			
                            
                         <div class="registerBar">
                           <h2>Data List </h2>
                        </div>
                      
                         
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="dataList">
                            <tr>
                                <th width="14%">Batch Name</th>
                            	<th width="10%">Created Date</th>
                                <th width="14%">Course Title</th>
                                <th width="10%">Batch Start Date</th>
                                <th width="10%">Batch End Date</th>                                
                                <th width="6%">Price</th>
                                <th width="10%">No of People Enrolled</th>
                                <th width="12%">Programme Name</th>
                                <th width="8%">Batch Status</th>
                                <th width="6%">Action</th>
                               
                            </tr>
							<?php foreach( $batch as $key=>$value ){ ?>
                             <tr>
                              
                                <td><?php echo $value->tTrainingBatchName; ?></td>
                                <td><?php echo date("d-m-Y", strtotime($value->dCourseCreatedAt)); ?></td>
                                <td><?php echo $value->tCoursetitle; ?></td>
                                <td><?php echo $value->dTrainingBatchStDate; ?></td>
                                <td><?php echo $value->dTrainingBatchEndDate; ?></td>
                                <td><?php if( $value->tBatchEnrolmentFees > 0 ) : ?>Rs. <?php echo $value->tBatchEnrolmentFees; ?><?php endif; ?> </td>
                                <td></td>
                               
                                 <td><?php echo $value->tprogramname; ?></td>
                                 <td><?php echo $value->tbatchstatus; ?></td>
                                <td>
                                    <!--modified for demo starts
								<?php if($value->nbatchstatus == 1) :?>
								<a href="#" onclick="closeBatch(<?php echo $value->aTrainingBatchMasterID; ?>); return false">Close Batch</a>
								<?php endif; ?>
								
							 modified for demo ends-->
							 <p><a href="#" onclick="EnrollForm(<?php echo $value->aTrainingBatchMasterID; ?>); return false">Enroll</a></p>
							 
							 
								</td>
                            </tr>
							<?php } ?>
                            </table>
                            <a href="/export-batchlist/<?php echo $course->aCourseMasterID; ?>" class="downloadBtn">Download File</a>

                        
                        
                    </div>
                        <!---->
                    
                    
                    </div>
		</div>
	</div>
	 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
	 
	 <!-- Modal -->
    <div id="enquire-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
         
          <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center primary-color">Enrollment Information</h4>
          </div>
          <div class="modal-body">
            <!--TEST S-->
                    <div role="tabpanel" class="tab-pane" id="referNew">                        
                        <form method="" action="" id="ReferForm" class="form-horizontal">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
						 <input type="hidden" name="nBatchid" class="nBatchid"  value="">
                            
                            <div class="col-sm-12">
                                
                                <div class="col-sm-6">
                                 
                                     <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="ufName" id="" value="" placeholder="Candidate First Name" />
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="ulName" id="" value="" placeholder="Candidate Last Name" />
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="father_name" id="" value="" placeholder="Father's Name"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="email" id="" value="" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <!--<label for="tCourseComment">Residential Address</label-->
                                    <textarea id="tCourseComment" name="address" cols="5" rows="5" placeholder="Residential Address" class="tCourseComment form-control" maxlength="250"></textarea>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" maxlength="12"  name="aadhar" id="" value="" placeholder="Aadhaar Number"/>
                                </div>
                            </div>
                            
                                 
                             </div>
                                
                                <div class="col-sm-6">
                                 
                                  <div class="form-group">
                               <div class="col-sm-12">
                                    <input type="text" class="form-control datepicker" name="dob" id="" value="" placeholder="Date of birth (dd/mm/yy)" />
                                </div>
                            </div>
<?php
							 $tblusercastecategory = DB::table('tblusercastecategory')->get(); 
							?>
                            <div class="form-group">
                              <div class="col-sm-12">
                                  <select name="caste" class="form-control">
									<option value="0">Select</option>
									<?php foreach( $tblusercastecategory as $k => $v ) { ?>
									<option value="<?php echo $v->acastecategoryid; ?>"><?php echo $v->tcastename; ?></option>
									<?php } ?>
									</select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" maxlength="10" name="phone" id="" value="" placeholder="Mobile Number"/>
                                </div>
                            </div>
							 <div class="form-group">
							
                                <div class="col-sm-1">
                                    <input type="radio"  name="gender" id="" value="male" />
                                </div>
                                <div class="col-sm-3">
									<label>Male</label>
                                </div>								
                                <div class="col-sm-1">
                                    <input type="radio" name="gender" id="" value="female" />
                                </div>
								<div class="col-sm-3">
									<label>Female</label>
                                </div>
                            </div>
							  
                            
                            <div class="form-group" style="margin-bottom:5px;">
                                <div class="col-sm-12" style="border-top:1px dotted #333333; padding-top:6px;">
                                 Invoice Details
                                </div>
                            </div>
                            <?php
							 $tblstudentenrollment = DB::table('tblstudentenrollment')->get(); 
							?>
                             <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="invoice_no" id="" value="<?php echo count($tblstudentenrollment) +1; ?> " placeholder="Invoice No"/ disabled>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control datepicker" name="invoice_date" id="" value="" placeholder="Invoice Date"/>
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="invoice_amount" id="" value="" placeholder="Amount"/>
                                </div>
                            </div>
                                 
                             </div>
                                
                            </div>
                            
                             
                             
                             
                            
                           
                            
                            <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-1">
                                 <p id="LoadingImag"></p>
                                <p style="color:red" id="msg"></p>
                                <p class="enquireResponseMsg"></p>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-1">
                                    <input type="submit" value="Submit" alt="Save" name="save" class="greenBtn">
                                    
                                     <input type="submit" value="Print Invoice" alt="" name="" class="greenBtn" style="margin-left:5px;">
                                </div>
                               
                            </div>
                        </form>
                    </div>
                    <!--TEST E-->
            
              </div>
              </div>
         
         
      </div>
   </div>
	 
	 
@endsection
@section('page_script')

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
 $(function() {
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  });
function getBatchByStatus(courseid, status){
	window.location.href='/batch-list/'+courseid+'/?status='+status;
}
function closeBatch(batch_id) {
   
    var r = confirm("Closing the bactch will disable this bactch from studnet's view. Do you wish to proceed ?");
    if (r == true) {
		var token = $('#token').val(); 
      $.ajax({
				url: '/close-batch',
				type: 'POST',
				data: "_token="+token+"&batch_id="+batch_id,
				dataType: "json",
				success: function (data) {
					
					if(data.status == 'success'){
						
						location.reload();
					}
					
				}
			});
    } 
}
 $(function() {
$("#ReferForm").validate({
		rules: {
			ufName: 'required',
			//ulName: 'required',
			email: {
			required: true,
			email: true
			},								
			//father_name: 'required',
			//address: 'required',
			phone: {
			required: true,
			minlength: 10,
			number: true,
			},	
			aadhar: {
			required: false,
			minlength: 12,
			number: true,
			},	
			gender: 'required',	
			invoice_no: 'required',	
			invoice_amount: 'required',	
			invoice_date: 'required',	
			//caste: 'required',
			//dob: 'required'	
		},
		messages: {
		  // iName: "Please enter your Institute name",
		  // ufName: "Please enter your first name",
		  // ulName: "Please enter your last name",
		  // email: "Please enter valid email address",
		  // phone: "Please enter valid mobile number",
		  // password: "Please enter password minimum six digit",
		},
		submitHandler: function(form) {
			$('p#msg').html('');
			var formData = $("form#ReferForm").serialize()
			$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
			$.ajax({
				url: '/course/enroll-candidate',
				type: 'POST',
				data: formData,
				dataType: "json",
				success: function (data) {
					$('p#LoadingImag').html('');
					if(data.status == 'success'){
						//alert('Success');
						document.getElementById('ReferForm').reset();
						//$('#enquire-modal').modal('hide');
					}else{
						//$('p#msg').html(data.msg);
					}
					$('p#msg').html(data.msg);
					
				}
			});
		},
	});
	});
function EnrollForm(batch_id){ 
	$('#ReferForm .nBatchid').val(batch_id);
	$('#enquire-modal').modal();
	
	
}
</script> 
@endsection

