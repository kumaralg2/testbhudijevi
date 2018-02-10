@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')
@include('layouts/banner')					
<div class="container">
    <div class="row">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/')}}">Home</a></li>
                <li class="active">Manage Listing</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-left">Manage Listing</h3>
            <br>
            <div class="col-md-5 col-md-offset-1">
                <form action="" method="get">
                    <div class="tsSearch">
                        <label for="sCourse">Search Your Courses</label> 
                        <input type="search" placeholder="Search Your Courses" value="<?php if(isset($_GET['keyword'])){ echo $_GET['keyword']; } ?>" id="sCourse" name="keyword" />
                        <button type="submit" id="submit" class="btn btn-default input-lg no-border-radius" ">
                            <i class="fa fa-arrow-right icon-large"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="sortList">
                    <span>List by:</span>
                    <label for="sortL">Category</label>
                    <select class="dropdown" name="sortL" onchange="getCourseByStatus(this.value); return false">
                        <?php 
                            $course_status = DB::table('tblcoursestatus')->get();
                            ?>
                        <option value="">Select</option>
                        @foreach( $course_status as $key=>$value )
                        <option value="{{$value->aCourseStatusID}}" 
                            <?php if(isset($_GET['status']) && $_GET['status'] == $value->aCourseStatusID){ echo "selected"; }?>
                            >{{$value->tCourseStatus}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        @if(Session::has('message'))
        <div class="col-md-12">
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>            
        </div>
        @endif
        
        <div class="col-md-12">
            <div class="mListCol">
                @foreach($batch as $key=>$value)  
                <div class="col-md-4">
                    <div class="listTS" <?php if(!empty($value->tImageFileName)){ ?>style="background:url('/assets/images/<?php echo $value->tImageFileName;  ?>') <?php } ?>">
                        <div class="boxDetails">
                            <p>{{$value->aCourseMasterID}} {{$value->tCoursetitle}} <br> 
                                <?php 
                                    if( $value->nCourseStatusID == 5 && !empty($value->nStatusComment) ){
                                    	echo '<strong> Comments: </strong>'.$value->nStatusComment;
                                    }
                                    ?>
                            </p>
                            <p><span>Sector Name</span>  <span>{{$value->tSectorName}} <span></span></span></p>
                            <p><span>Complexity Level</span> <span>{{$value->tCourseComplexity}}</span>  </p>
                            <p><span>Created Date</span>  <span>{{$value->dCourseCreatedAt}}</span> </p>
                            <p><span>Status</span>  <span>{{$value->tCourseStatus}}</span> </p>
                            @if( Auth::user()->nUsrRoleID == 1001 )
                            <p class="text-center">
                                <input type="submit" onclick="window.location.href='/batch-list/{{$value->aCourseMasterID}}'" value="View Batches">
                                <input type="submit" onclick="window.location.href='/course-approval/{{$value->aCourseMasterID}}'" value="Admin">											
                                <input type="submit" onclick="closeCourse({{$value->aCourseMasterID}}, '{{$value->tCoursetitle}}'); return false" value="Close">
                            </p>
                            @else
                            <p class="text-center">
                                <input type="submit" onclick="window.location.href='/schedule-new-batch/{{$value->aCourseMasterID}}'" value="Schedule Batch" @if( $value->aCourseStatusID != 3) {{'disabled'}} @endif>
                                @if( $value->aCourseStatusID == 3 || $value->aCourseStatusID == 4 ) 
                                <input type="submit" onclick="window.location.href='/batch-list/{{$value->aCourseMasterID}}'" value="View Batches">
                                @else
                                <input type="submit" onclick="window.location.href='/batch-list/{{$value->aCourseMasterID}}'" value="View Batches" disabled>
                                @endif
                            </p>
                            <p class="text-center">
                                @if( $value->aCourseStatusID == 1 || $value->aCourseStatusID == 4 || $value->aCourseStatusID == 5 ) 
                                <input type="submit" onclick="publishCourse({{$value->aCourseMasterID}}, '{{$value->tCoursetitle}}'); return false" value="Publish">
                                @else
                                <input type="submit"  value="Publish" disabled>
                                @endif
                                @if( $value->aCourseStatusID == 1 || $value->aCourseStatusID == 5 ) 
                                <input type="submit" onclick="window.location.href='/edit-course/{{$value->aCourseMasterID}}'" value="Edit">
                                @else
                                <input type="submit"  value="Edit" disabled>
                                @endif
                                <input type="submit" onclick="closeCourse({{$value->aCourseMasterID}}, '{{$value->tCoursetitle}}'); return false" value="Close">
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@section('page_script')
<script>
    function getCourseByStatus(status){
    	window.location.href='/course-listing/?status='+status;
    }
    function publishCourse(course_id, course_title) {
       
        var r = confirm("Are you sure to publish "+course_title+" ?");
        if (r == true) {
    		var token = $('#token').val(); 
          $.ajax({
    				url: '/publish-course',
    				type: 'POST',
    				data: "_token="+token+"&course_id="+course_id,
    				dataType: "json",
    				success: function (data) {
    					
    					if(data.status == 'success'){
    						alert(' You have submitted this Course for Approval. Please allow us 48 Hours to get back to you with the Status. You may schedule the Batch post Approval');
    						location.reload();
    					}
    					
    				}
    			});
        } 
    }
    function closeCourse(course_id, course_title) {
       
        var r = confirm("Closing the Course will render all the Active Batches listed for the students to a closed state, and not visible. Do you wish to proceed?");
        if (r == true) {
    		var token = $('#token').val(); 
          $.ajax({
    				url: '/close-course',
    				type: 'POST',
    				data: "_token="+token+"&course_id="+course_id,
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