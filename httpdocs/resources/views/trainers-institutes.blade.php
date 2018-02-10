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
                                <p>willing to learn. Ready to start a Training/Tuition Batch?</p>
                                <p>We are here to help.</p>
                                <a class="howWorks" href="#howWorks">Find out how</a>
                            </div>
                        </div>
					</div>
                    <div class="col-md-6 no-padding">
                    	<div class="findCourseBox lightGreen">
                        	<div class="alignMiddle">
                            	<h2>Ready to start a Training/Tuition Batch?</h2>
								
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
                            <h3>Ideate</h3>
                            <p>Transform from an Innovator to an Instructor</p></div>
                         <div class="col-md-2 box">
                         	<img src="/assets/images/two.png">
                            <h3>Publish</h3>
                            <p>Schedule and publish your own batch online</p>
                          </div>
                         <div class="col-md-2 box">
                         	
                             	<img src="/assets/images/three.png">
                                <h3>Teach</h3>
                                <p>Reach and Teach to Millions of Students</p>
                             
                         </div>
                         <div class="col-md-2 box"><img src="/assets/images/four.png">
                            <h3>Interact</h3>
                            <p>Discuss and clarify doubts real time</p></div>
                           <div class="col-md-2 box"><img src="/assets/images/five.png">
                                <h3>Grow</h3>
                                <p>Receive positive Feedback and grow in the community</p>
                          </div>
                    
                    </div>
                </div>
            </section>
            
            <section class="marketPlace">
                <div class="container">
                    <div class="row">                        
                        <h2 class="primary-color">The Right Market Place</h2>
                    </div>
                    <br>
                    <div class="row">
                        
                        <div class="col-md-4">
                        	<div class="detailContainer">
                             <img width="" class="mobIcon" src="/assets/images/mobilize-icon.png">
                                <h3>Mobilize</h3>
                                <p>Easily mobiize students to your Training batches across your institutes real time.</p>
                                <p>BuddhiJeevi will handle all the Payment processing for all Online payments made by the Students.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="detailContainer">
                        <img src="/assets/images/standout-icon.png">
                        	<h3>Stand out</h3>
                            <p>Stand out from the competition by creating a niche space for yourself. Colloborate and communicatae and inturn earn

feedback and trust from students to grow with in the community. BuddhiJeevi will help you in achieving your goals</p>
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                        <div class="detailContainer">
                        <img src="/assets/images/control-icon.png">
                        <h3>Control</h3>
                            <p>We will enable you to build the right content. BuddhiJeevi will work with you in automating

process, and be a partner in providing value through out the lifecycle.</p>

    <a class="manageBtn" href="/course-listing">Manage List</a>
</div>
                        
                    
                        </div>                                                
                        
                          
                        
                    </div>
                </div>            
            </section>
			
			
           
		
		
@endsection
