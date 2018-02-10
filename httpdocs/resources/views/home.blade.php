@extends('layouts.master', array('container_class'=>'body-section'))
@section('title', 'Home Page')
@section('content')

<div class="container-fluid course-search">
    <div class="row">            
        <div class="col-md-8 text-center col-md-offset-2">
            <div class="row">
                <div class="col-md-12">
                    <h1>Get ready for a better future, now</h1>
                    <p class="text-center">We hand pick the Best Institutes and Instructors closer to your location, who are Passionate and prepare you for the future of your choice.</p>
                </div>
            </div>
            <div class="row search-form">                                
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-11 col-md-offset-1">
                            <div class="row no-gutter">                                    
                                <form action="{{URL::route('CourseList')}}" method="get" name="search_course" id="search_course">
                                    <div class="col-md-4 col-sm-5">
                                      <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker icon-large"></i></div>
                                        <input type="text" class="form-control input-lg" placeholder="Location" name="location" id="location_search" value="<?php if(Session::has('search_location')){ echo Session::get('search_location');} ?>"/>
                                      </div>
                                    </div>
                                    <div class="col-md-7 col-sm-6">
                                      <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-search icon-large"></i></div>
                                        <input type="text" class="form-control input-lg" placeholder="Search for course" id="keyword" name="keyword" value="<?php if(Session::has('search_keyword')){ echo Session::get('search_keyword');} ?>">
                                      </div>
                                    </div>
                                    <div class="col-md-1 col-sm-1">
                                        <div class="input-group">                                             
                                            <button type="submit" class="btn btn-default input-lg no-border-radius" >
                                                <i class="fa fa-arrow-right icon-large"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 text-center col-md-offset-2">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <i class="fa fa-book color-white" aria-hidden="true"></i>
                            <p class="text-center">Best Curriculum and Content</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <i class="fa fa-user color-white" aria-hidden="true"></i>
                            <p class="text-center">Trainers with real world Experience</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <i class="fa fa-briefcase color-white" aria-hidden="true"></i>
                            <p class="text-center">Placement Services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- body contents -->
<div class="container body-spc-aligned">
    <div class="row">
        <div class="col-md-12 content-section">
            <div class="row head-section">
                <div class="col-md-12">
                    <h3 class="section-title"><i class="fa fa-users primary-color"></i>Buddhijeevi for Students</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <p class="primary-color our-aim">Our aim is to make your choice of selecting a Course easy and effective. So, whichever course you choose , be assured that it brings you closer to your intended goal.</p>
                </div>
                <div class="col-md-5">
                    <p>We provide open access to all types of Trainings by providing maximum transparency for you to make informed choices. You will get a consolidated view of everything about that Course. Best of all, we will try and locate a Training very closer to your location.</p>
                    <p>Our aim is to ensure any Training course you pick is delivered in an effective and efficient way.</p>
                    <div class="row text-center icon-group-block">
                        <div class="col-md-4 col-sm-4 col-xs-4">   
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <p>Course Curriculum</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4"> 
                            <i class="fa fa-user-circle-o"></i>
                            <p>Trainer Profile</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">   
                            <i class="fa fa-briefcase"></i>
                            <p>Job Information</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12 content-section">
            <div class="row head-section">
                <div class="col-md-3 col-sm-6">
                    <h4 class="pull-left">Popular Categories</h4>
                    <a class="pull-right primary-color ptop9" title="Courses" href="{{ URL::route('CourseList') }}">View all</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="course/list/?sector_id=1001">
                        <div class="category-block">
                            <img src="{{asset('assets/images/information-technology-icon.png')}}" />
                            <h5><strong>Information Technology</strong></h5>
                            <p>Courses tailored to prepare students for IT world</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="course/list/?sector_id=1002">
                        <div class="category-block">
                            <img src="{{asset('assets/images/professionalstudies-icon.png')}}" />
                            <h5><strong>Professional Studies</strong></h5>
                            <p>Provide the best coaching for professional exams</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="course/list/?sector_id=1003">
                        <div class="category-block">
                            <img src="{{asset('assets/images/smecourses-icon.png')}}" />
                            <h5><strong>SME Courses</strong></h5>
                            <p>Versatile learning solutions for the workforce</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row head-section">
                <div class="col-md-12">
                    <h3 class="section-title"><i class="fa fa-university primary-color"></i>Buddhijeevi for Institutes</h3>
                </div>
            </div>
            <div class="row content-section">
                <div class="col-md-5">
                    <h2><b>We will enable you reach your true potential</b></h2>
                    <br>
                    <p>We stand hand-in-hand to enable you to be successful through this journey. Our platform is carefully designed to enable you to showcase your legacy and strengths, from personalized micro Institute page to On-demand qualified Trainers. Completely automated Training schedules and lots of other features will enable Student to easily locate you as a preferred Institute of their choice.</p>
                    <blockquote class="primary-color">
                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                        We found the Platform to be very interactive and Precise. Overall, it’s an innovative idea to bring Trainers and Trainees together
                        <small class="primary-color text-right">Industry Academic Association</small>
                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                    </blockquote>                        
                    <p class="btn btn-success"><a class="color-white" href="{{ URL::route('TrainersInstitutes') }}">Learn More</a></p>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <img class="img-responsive" src="{{asset('assets/images/institute-graphic.jpg')}}" alt="Instituite Search"/>
                    <div class="row text-center icon-group-block">
                        <div class="col-md-4 col-sm-4 col-xs-4">   
                            <i class="fa fa fa-file-o" aria-hidden="true"></i>
                            <p>Micro Website</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4"> 
                            <i class="fa fa-table"></i>
                            <p>Class Schedule</p>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4">   
                            <i class="fa fa-user"></i>
                            <p>On Demand Trainers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">  
            <div class="row content-section">
                    <div class="col-md-6">
                        <div class="row head-section">
                            <div class="col-md-12">
                                <h3 class="section-title"><i class="fa fa-user primary-color"></i>Buddhijeevi for Trainers</h3>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12 marb30">
                            <div class="row">
                                <div class="col-md-12">   
                                    <h2><b>We will help you focus on what you do best and nothing else - Teach</b></h2>
                                    <br>
                                    <p>We truly believe Trainers are the key to the world transformation. That is why we place you at the Pivot point of our offerings by providing a world of facilities and reach through Technology. Our aim is to provide you flexibility and opportunity to Teach anywhere/anytime and only focus on your passion to “Teach”.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row text-center icon-group-block">
                                <div class="col-md-4 col-sm-4 col-xs-4">   
                                    <i class="fa fa-user-circle-o"></i>
                                    <p>Build your Profile</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4"> 
                                    <i class="fa fa-laptop"></i>
                                    <p>Showcase your passion for teaching</p>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">   
                                    <i class="fa fa-users"></i>
                                    <p>Stay connected with Student Community</p>
                                </div>
                            </div>
                        </div>
                        <p class="btn btn-success"><a color="color-white" href="{{ URL::route('TrainersInstitutes') }}">Learn More</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row head-section">
                            <div class="col-md-12">
                                    <h3 class="section-title"><i class="fa fa-comments primary-color"></i>Testimonials</h3>
                            </div>
                    </div>

                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#quote-carousel" data-slide-to="0" class="">
                                <img class="img-responsive " src="assets/images/quote2.png" alt="">
                            </li>
                            <li data-target="#quote-carousel" data-slide-to="1" class="">
                                <img class="img-responsive" src="assets/images/quote1.png" alt="">
                            </li>
                            <li data-target="#quote-carousel" data-slide-to="2" class="active">
                                <img class="img-responsive" src="assets/images/quote3.png" alt="">
                            </li>
                        </ol>

                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner text-center">
                            <!-- Quote 1 -->
                            <div class="item">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="primary-color">
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                                We found the Platform to be very interactive and Precise. Overall, it’s an innovative idea to bring Trainers and Trainees together
                                                <small class="primary-color text-right">Industry Academic Association</small>
                                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                                            </p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- Quote 2 -->
                            <div class="item">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="primary-color">
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                                This platform which you made to connect all students and teachers is awesome. I really impressed by it. I would definitely recommend my students and colleagues.
                                                <small class="primary-color text-right">Rajendra M - Trainer/Instuctor</small>
                                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                                            </p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <!-- Quote 3 -->
                            <div class="item active">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="primary-color">
                                                <i class="fa fa-quote-left" aria-hidden="true"></i>
                                                More likely, this platform provides the appropriate way for a youth searching for a proper carrier way.
                                                <small class="primary-color text-right">Priyanshu Singh - Student</small>
                                                <i class="fa fa-quote-right" aria-hidden="true"></i>
                                            </p>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                        </div>
                    </div>                                             
                </div>
            </div>
        </div>        
    </div>
</div>

<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection
@section('page_script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<style>
    .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
    background: #fff none repeat scroll 0 0;
    color:#767676;
    }
</style>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    (function( $ ) {
      $.widget( "custom.combobox", {
        _create: function() {
          this.wrapper = $( "<span>" )
            .addClass( "custom-combobox" )
            .insertAfter( this.element );
    
          this.element.hide();
          this._createAutocomplete();
          this._createShowAllButton();
        },
    
        _createAutocomplete: function() {
          var selected = this.element.children( ":selected" ),
            value = selected.val() ? selected.text() : "";
    
          this.input = $( "<input>" )
            .appendTo( this.wrapper )
            .val( value )
            .attr( "title", "" )
            .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
            .autocomplete({
              delay: 0,
              minLength: 0,
              source: $.proxy( this, "_source" )
            })
            .tooltip({
              tooltipClass: "ui-state-highlight"
            });
    
          this._on( this.input, {
            autocompleteselect: function( event, ui ) {
              ui.item.option.selected = true;
              this._trigger( "select", event, {
                item: ui.item.option
              });
            },
    
            autocompletechange: "_removeIfInvalid"
          });
        },
    
        _createShowAllButton: function() {
          var input = this.input,
            wasOpen = false;
    
          $( "<a>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "Show All Items" )
            .tooltip()
            .appendTo( this.wrapper )
            .button({
              icons: {
                primary: "ui-icon-triangle-1-s"
              },
              text: false
            })
            .removeClass( "ui-corner-all" )
            .addClass( "custom-combobox-toggle ui-corner-right" )
            .mousedown(function() {
              wasOpen = input.autocomplete( "widget" ).is( ":visible" );
            })
            .click(function() {
              input.focus();
    
              // Close if already visible
              if ( wasOpen ) {
                return;
              }
    
              // Pass empty string as value to search for, displaying all results
              input.autocomplete( "search", "" );
            });
        },
    
        _source: function( request, response ) {
          var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
          response( this.element.children( "option" ).map(function() {
            var text = $( this ).text();
            if ( this.value && ( !request.term || matcher.test(text) ) )
              return {
                label: text,
                value: text,
                option: this
              };
          }) );
        },
    
        _removeIfInvalid: function( event, ui ) {
    
          // Selected an item, nothing to do
          if ( ui.item ) {
            return;
          }
    
          // Search for a match (case-insensitive)
          var value = this.input.val(),
            valueLowerCase = value.toLowerCase(),
            valid = false;
          this.element.children( "option" ).each(function() {
            if ( $( this ).text().toLowerCase() === valueLowerCase ) {
              this.selected = valid = true;
              return false;
            }
          });
    
          // Found a match, nothing to do
          if ( valid ) {
            return;
          }
    
          // Remove invalid value
          this.input
            .val( "" )
            .attr( "title", value + " didn't match any item" )
            .tooltip( "open" );
          this.element.val( "" );
          this._delay(function() {
            this.input.tooltip( "close" ).attr( "title", "" );
          }, 2500 );
          this.input.autocomplete( "instance" ).term = "";
        },
    
        _destroy: function() {
          this.wrapper.remove();
          this.element.show();
        }
      });
    })( jQuery );
    
    
      
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