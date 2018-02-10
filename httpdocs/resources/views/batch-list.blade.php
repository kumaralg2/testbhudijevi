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
								<?php if($value->nbatchstatus == 1) :?>
								<a href="#" onclick="closeBatch(<?php echo $value->aTrainingBatchMasterID; ?>); return false">Close Batch</a>
								<?php endif; ?>
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
@endsection
@section('page_script')
<script>
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
</script> 
@endsection

