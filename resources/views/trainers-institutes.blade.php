@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')
			@include('layouts/banner')
			
			<div class="container gapTopBottom">
				<div class="row">
					<div class="col-md-6 no-padding">
                    	<div class="findCourseBox">
                        	<div class="alignMiddle">
                                <h2>Reach out to the Millions of Students</h2>
                                <p>willing to learn. Need help in reaching to Student community?</p>
                                <p>We are here to help.</p>
                                <a class="howWorks" href="#howWorks">Find out how</a>
								 <p><a class="howWorks" href="{{ URL::to('/contact_us')}}">Request Demo</a></p>
                            </div>
                        </div>
					</div>
                    <div class="col-md-6 no-padding">
                    	<div class="findCourseBox lightGreen">
                        	<div class="alignMiddle">
                            	<h2>Ready to start a Training Batch?</h2>
								
								<form method="" action="/course-batch-creation">
                                    <label for="createCourse">Start by entering the course title:</label>
                                    <input type="text" name="createCourse" id="createCourse" value="" placeholder="Start by entering the course title:">
                                    <br>
                                    <input type="submit" name="createSubmit" id="createSubmit" value="Create Course">
                                </form>
                               
								
                            </div>
                        </div>
					</div>
					
				</div>
			</div>
           		<a id="howWorks" name="howWorks"></a>
            <section class="howItWorks">
            	<div class="container">
                    <div class="row">
                        <h2 class="primary-color">How it works?</h2>
                    </div>
                    <br>
                	<div class="row">
                    	
                         <div class="col-md-2 box">
                         <img src="/assets/images/one.png">
                            <h3>Signup</h3>
                            <p>Signup as Training Institute</p></div>
                         <div class="col-md-2 box">
                         	<img src="/assets/images/two.png">
                            <h3>Manage</h3>
                            <p>Publish Program, courses and Schedule Batches</p>
                          </div>
                         <div class="col-md-2 box">
                         	
                             	<img src="/assets/images/three.png">
                                <h3>Marketplace</h3>
                                <p>Training information available in Local language. Students are counselled by local community through Portal/App</p>
                             
                         </div>
                         <div class="col-md-2 box"><img src="/assets/images/four.png">
                            <h3>Interact</h3>
                            <p>Track Community activities, assign Targets and convert Leads</p></div>
                           <div class="col-md-2 box"><img src="/assets/images/five.png">
                                <h3>Monitor</h3>
                                <p>Monitor the Progress using Real time Dashboards</p>
                          </div>
                    
                    </div>
                </div>
            </section>
            
            <section class="marketPlace">
                <div class="container">
                    <div class="row">                        
                        <h2 class="primary-color">Unique Market Place Solution</h2>
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-4">
                        	<div class="detailContainer">
                             <img width="" class="mobIcon" src="/assets/images/mobilize-icon.png">
                                <h3>Mobilize</h3>
                                <p>Easily mobiize students to your Training batches across your institutes real time.</p>
                                <p>BuddhiJeevi will enable information made available in Local language and Video playback's for student to easily understand the benefits offerred.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="detailContainer">
                        <img src="/assets/images/standout-icon.png">
                        	<h3>Community Engagement</h3>
                            <p>BuddhiJeevi have community workers affiliated with us. The Community workers are trained to counsel the students to your program's</p>
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="detailContainer">
                        <img src="/assets/images/control-icon.png">
                        <h3>Control</h3>
                            <p>Address the issues such as Drop-out's, meeting Training Targets and monitoring progress. We will have all these convered for you</p>

    <a class="manageBtn" href="/course-listing">Manage List</a>
</div>
                        
                    
                        </div>                                                
                        
                          
                        
                    </div>
                </div>            
            </section>
			
			
           
		
		
@endsection
