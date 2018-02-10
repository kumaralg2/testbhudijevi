@extends('layouts.master')
@section('title', 'Course Catalogue')
@section('content')
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<body>
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
						<h3>Grade Master</h3>
						<div class="col-md-12">	
					<script>$(document).ready(function() {
						$('#example').DataTable();
					} );</script>						
							<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							  <thead>
							  <tr>
							    <th>Grade Id</th>
								<th>Grade</th>
								<th>sort_order</th>
							  </tr>
							  </thead>
							  <tbody>
							 <?php for($i=0;$i<count($grade_master);$i++) {  ?>
							  <tr>
							    <td><?php echo $grade_master[$i]->aGradeid; ?></td>
								<td><?php echo $grade_master[$i]->tGrade; ?></td>
								<td><?php echo $grade_master[$i]->sort_order; ?></td>
								
								
							  </tr>
							 <?php } ?>
							 </tbody>
							  </table>
							 
						</div>
						
							 
						</li>
					</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
@endsection
@section('page_script')
@endsection

