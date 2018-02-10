<div class="catalog-filters">
    <h4 class="green-border">
        <i class="fa fa-filter" aria-hidden="true"></i>&nbsp;
        Filters
    </h4>
    @if($interests)
    <br>
        <div class="navbar-default" role="navigation">
            <div class="sidebar-nav">
                <ul class="nav in" id="side-menu">
                    @foreach( $interests as $interest )
                    <li><a href="{{ action('CourseController@courseList', array('sector_id'=>Request::get('sector_id'),'category_id'=> Request::get('category_id'),'interest_id'=> $interest->aAspIntID))}}">{{$interest->tAspirationinterest}}</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <br>
    @endif
    <form id="SideBarFilter">
        <div class="filter-block">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h5 class="green-border">Type</h5>
            <?php
                $type = DB::table('tblcoursetypemaster')->get(); 	
                $filters = Session::all();
            ?>            
            @foreach($type as $type)
                <div class="checkbox"> 
                    <?php
                        $checked_info = ''; 
                        if(isset($filters['filters']['type'])){  
                            foreach( $filters['filters']['type'] as $key=>$value ){	 
                                    if( $value == $type->aCoursetypeMasterID ){
                                            $checked_info = 'checked';
                                    }
                            }
                        }
                        ?>
                    <label><input type="checkbox" name="type[]" value="{{$type->aCoursetypeMasterID}}" {{$checked_info}}> &nbsp; {{$type->tCoursetype}}</label> 
                </div>
            @endforeach
        </div>
        <div class="filter-block">
            <h5 class="green-border">Mode</h5>
            <?php
                $mode = DB::table('tblcoursemodemaster')->get();
            ?>            
            @foreach($mode as $mode)
                <div class="checkbox"> 
                    <?php
                        $checked_info = ''; 				
                        if(isset($filters['filters']['mode'])){  
                            foreach( $filters['filters']['mode'] as $key=>$value ){	 
                                    if( $value == $mode->aCourseModeID ){
                                            $checked_info = 'checked';
                                    }
                            }
                        }
                        ?>
                    <label><input type="checkbox" name="mode[]"  value="{{$mode->aCourseModeID}}" {{$checked_info}}> &nbsp; {{$mode->tCourseModetype}}</label>                
                </div>
            @endforeach
        </div>
        <div class="filter-block">
            <h5 class="green-border">Duration</h5>            
            <?php
                $duration = DB::table('tblcoursedurationtype')->get();
            ?>
            @foreach($duration as $duration)
                <div class="checkbox">
                    <?php
                        $checked_info = ''; 				
                        if(isset($filters['filters']['duration'])){  
                            foreach( $filters['filters']['duration'] as $key=>$value ){	 
                                    if( $value == $duration->acoursedurationid ){
                                            $checked_info = 'checked';
                                    }
                            }
                        }
                        ?>
                    <label><input type="checkbox" name="duration[]" value="{{$duration->acoursedurationid}}" {{$checked_info}}> &nbsp; {{$duration->tCoursedurationtype}}</label>
                </div>
            @endforeach 
        </div>
    </form>
</div>