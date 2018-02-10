<nav class="navbar">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('/') }}">
              <img src="{{asset('assets/images/logo.png')}}" alt="Buddhijeevi" />
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check()) 
                    @if( Auth::user()->nUsrRoleID == 1002 || Auth::user()->nUsrRoleID == 1003 )
                        <li {{{ (Request::is('course-listing') ? 'class=active' : '') }}}>
                            <a title="Courses" href="{{URL::route('CoursListing')}}">Manage Listing</a>
                        </li>
                        <li {{{ (Request::is('course-batch-creation') ? 'class=active' : '') }}}>
                            <a title="Courses" href="{{URL::route('CourseBatchCreation')}}">Create Course </a>
                        </li>
                @endif				
                @if( Auth::user()->nUsrRoleID == 1004 ) 
                        <li {{{ (Request::is('course/list') ? 'class=active' : '') }}}>
                            <a title="Courses" href="{{ URL::route('CourseList') }}">Courses</a>
                        </li>
                @endif
                @if( Auth::user()->nUsrRoleID == 1001 )
                        <li>
                            <a title="Courses" href="{{URL::route('CoursListing')}}">Manage Listing</a>
                        </li>
                    @endif
                @else
<!--                    <li>
                        <a title="Courses" href="{{ URL::route('TrainersInstitutes') }}">Start Your Class</a>
                    </li>-->
                    <li {{{ (Request::is('course/list') ? 'class=active' : '') }}}>
                        <a title="Courses" href="{{ URL::route('CourseList') }}">Courses</a>
                    </li>
                @endif
                
                @if(Auth::check()) 
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->tUsrFName}} {{Auth::user()->tUsrLName}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                 <a href="{{URL::route('UserProfile')}}">User Profile</a>
                            </li>
                            <li>
                                <a href="{{URL::to('account/logout')}}">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(Auth::check()) 				
                @else
                    <li {{{ (Request::is('account/login') ? 'class=active' : '') }}}>
                        <a title="Login" href="{{ URL::route('UserLogin') }}">Login / Sign Up</a>
                    </li>
                @endif          
            </ul>
            <!-- Header Course Search Block -->
            @if((Route::currentRouteName() == 'CourseList') || (Route::currentRouteName() == 'coursedes') || (Route::currentRouteName() == 'UserProfile')) 
            <form data="{{Route::currentRouteName()}}" method="get" action="/course/list/" name="course_catalogue_search" id="course_catalogue_search" class="navbar-form navbar-left head-search-section">
                <div class="input-group head-input">
                    <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                    <input type="text" class="form-control" name="location" id="location_search" placeholder="Location" value="<?php if(Session::has('search_location')){ echo Session::get('search_location');} ?>" kl_virtual_keyboard_secure_input="on">
                </div>
                <div class="input-group head-input">
                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
                    <input type="text" class="form-control" name="keyword" id="search" placeholder="Search" value="<?php if(Session::has('search_keyword')){ echo Session::get('search_keyword');} ?>" kl_virtual_keyboard_secure_input="on">
                </div>
                <div class="input-group">
                    <div class="">
                        <button type="submit" class="btn btn-default no-border-radius">
                            <i class="fa fa-arrow-right icon-large"></i>
                        </button>
                    </div>                    
                </div>
            </form>
            @endif 
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>