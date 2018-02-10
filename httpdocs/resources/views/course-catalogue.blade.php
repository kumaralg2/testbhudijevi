@extends('layouts.master', array('container_class'=>'mtop10'))
@section('title', 'Course Catalogue')
@section('content')
<!-- section 1 ends-->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/right-sidebar-filter')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 parent-category-row">
                    <div class="row">            
                        @foreach( $sectors as $sector )
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <a <?php if($sector->aSectorID == Request::get('sector_id')){ echo 'class="active"';} ?> href="{{ action('CourseController@courseList', array('sector_id'=> $sector->aSectorID))}}">
                                <img src="{{asset('assets/images/Sector_'.$sector->tSectorCode.'.png')}}" alt=""> {{$sector->tSectorName}}
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if($categories)
                <div class="col-md-12 child1-category-row white-bg">                        
                    <ul>            
                        @foreach( $categories as $category )
                        <li><a <?php if($category->aAspIntCatID == Request::get('category_id')){ echo 'class="active"';} ?> href="{{ action('CourseController@courseList', array('sector_id'=>Request::get('sector_id'),'category_id'=> $category->aAspIntCatID))}}">{{$category->tAspIntCategory}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="col-md-12 white-bg">
                    <ol class="breadcrumb">
                        <?php echo $breadcrumbs; ?>
                      </ol>
                </div>
                <div class="col-md-12 body-section" id="AllCoursesAndP">
                    @include('includes/all-courses')
                </div>
            </div>
        </div>
        
    </div>
</div>
<?php 
    if (Auth::check()){
    	$user_id = Auth::user()->ausrid;
    }else{
    	$user_id = '';
    }
    if(isset($_GET['search_keyword'])){
    	$search_keyword = $_GET['search_keyword'];
    }else{
    	$search_keyword = '';
    }
    if(isset($_GET['location'])){
    	$location = $_GET['location'];
    }else{
    	$location = '';
    }
    $result = DB::table('tbltakshashila_search_tracker')->insert([
    		'id_user'	=> $user_id,
    		'ip_address' => Request::getClientIp(),
    		'id_location' => $location,
    		'search_keyword' => $search_keyword,
    		'page_url' => $_SERVER['REQUEST_URI'],
    		'created_at' => date('Y-m-d H:i:s')
    	]);	
    
    ?>
@endsection
@section('page_script')
<script>
    $(document).ready(function(){
        $("input[type=checkbox]").click(function(){
    		//var formData = $("form#SideBarFilter").serialize(); course_catalogue_search
    
    		var formData = $("form#SideBarFilter, #course_catalogue_search").serializeArray();
    		console.log(formData);
    			//$('p#LoadingImag').html('<img src="/assets/images/ajax-loader.gif">');
    			$.ajax({
    				url: '/store-filter',
    				type: 'POST',
    				data: formData,
    				success: function (data) {
    					$('#AllCoursesAndP').html(data);
    					
    				}
    			});       
        });
    });
    
    function initAutocomplete() {
          
      var location = document.getElementById('location_search');
      var option =  {
                      types : [ '(regions)' ],
                      componentRestrictions : {country : "IN"}
                    };
      new google.maps.places.Autocomplete(location,option);      
    }      
        
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo env('GOOGLE_PLACE_SEARCH_KEY'); ?>&libraries=places&callback=initAutocomplete" async defer></script>
@endsection