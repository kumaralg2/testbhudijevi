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
						<h3>sector Master <span class="pull-right" > <a style="color:#fff" href="{{URL::route('sectormaster')}}">Sector List</a>  | <a style="color:#fff" href="{{URL::route('addsectormaster')}}">Add New Sector</a></span> </h3>
						<div class="col-md-12">	
							<?php if( Session::has('message') ){ ?>
							<div class="alert alert-<?php echo Session::get('status'); ?>">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<strong></strong> <?php echo Session::get('message'); ?>.
							</div>						
							<?php } ?>						
							<form method="POST" action="{{ url('admin/sector/update') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="aSectorID" value="<?php echo $sector_master->aSectorID; ?>">
							  <div class="form-group">
							  <label for="text">Sector Name:</label>
							  <input type="text" class="form-control" id="text" value="<?php echo $sector_master->tSectorName; ?>" placeholder="Enter sector" name="tSectorName">
							</div>		
							  <div class="form-group">
							  <label for="text">Sector Code:</label>
							  <input type="text" class="form-control" id="text" value="<?php echo $sector_master->tSectorCode; ?>" placeholder="Enter sorting number ( Optional )" name="tSectorCode">
							</div>	
							<div class="form-group">
							  <label for="text">Sortorder:</label>
							  <input type="text" class="form-control" id="text" value="<?php echo $sector_master->nSortorder; ?>" placeholder="Enter sorting number ( Optional )" name="nSortorder">
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

