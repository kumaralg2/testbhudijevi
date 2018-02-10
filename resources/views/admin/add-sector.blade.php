@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')

<div class="row"> 
	<div class="container-fluid bg-primary-color course-highlight">
		<div class="row">
			<div class="container">
				<div class="col-md-7">
					<p class="course-title-big">Settings</p>            
				</div>            
			</div>
		</div>
	</div>
	<div class="container-fluid cbc profileTemp">
		<div class="row">
			<div class="container">
				<ol class="breadcrumb">
					<li><a href="http://bhudhijeevi">Home</a></li>
					<li class="active">Settings</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="container">
				<div class="col-md-3"> 
					@include('includes/admin-menu')					
				</div>
				<div class="col-md-9">
					<div class="takshaInfo">
					<ul class="">
						<li style="display: block;" class="dashboardtab profileList">
						<h3>sector Master <span class="pull-right" > <a style="color:#fff" href="{{URL::route('sectormaster')}}">Sector List</a> | <a style="color:#fff" href="{{URL::route('addsectormaster')}}">Add New sector</a></span> </h3>
						<div class="col-md-12">						
							<form>
							  <div class="form-group">
							  <label for="text">Degree:</label>
							  <input type="text" class="form-control" id="text" placeholder="Enter sector" name="text">
							</div>		
							  <div class="form-group">
							  <label for="text">Sort:</label>
							  <input type="text" class="form-control" id="text" placeholder="Enter sorting number ( Optional )" name="text">
							</div>								  						 
								   <button type="submit" class="btn btn-default">Submit</button>
							</form>
						</div>
						
							 
						</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('page_script')
@endsection

