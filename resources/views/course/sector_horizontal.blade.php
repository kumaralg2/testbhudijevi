<?php
    $sectors = DB::table('tblsectormaster')->get();
?>
<div class="container-fluid">
    <div class="row">
      <div class="container">
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
      </div>
    </div>
  </div>