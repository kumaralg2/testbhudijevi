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
						<h3>Sector Master <span class="pull-right" > <a style="color:#fff" href="{{URL::route('sectormaster')}}">Sector List</a>  | <a style="color:#fff" href="{{URL::route('addsectormaster')}}">Add New Sector</a></span> </h3></h3>
						<div class="col-md-12">
                            <?php if( Session::has('message') ){ ?>
							<div class="alert alert-<?php echo Session::get('status'); ?>">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								<strong></strong> <?php echo Session::get('message'); ?>.
							</div>						
							<?php } ?>						
							<table class="table">
							  <tr>
							     <th>Sector Id</th>
								<th>SectorName</th>
								<th>Sector Code</th>
								<th>Sortorder</th>
								<th>Status</th>
								<th>Action</th>
							  </tr>
							 <?php for($i=0;$i<count($sector_master);$i++) {  ?>
							  <tr>
							    <td><?php echo $sector_master[$i]->aSectorID; ?></td>
								<td><?php echo $sector_master[$i]->tSectorName; ?></td>
								<td><?php echo $sector_master[$i]->tSectorCode; ?></td>
								<td><?php echo $sector_master[$i]->nSortorder; ?></td>
								<td><?php echo $sector_master[$i]->status; ?></td>
								<td><a href="{{URL('/admin/sector/edit')}}/<?php echo $sector_master[$i]->aSectorID; ?>">Edit</a>| 
								<a onclick="return confirm('Are you sure to delete <?php echo  $sector_master[$i]->tSectorName; ?> ?')" href="{{URL('/admin/sector/delete')}}/<?php echo $sector_master[$i]->aSectorID; ?>">Delete</a></td>
							  </tr>
							 <?php } ?>
							  </table>
							  <?php echo $sector_master->render(); ?>
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

