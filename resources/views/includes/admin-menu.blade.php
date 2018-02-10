<div class="subCategoriesBlk studentProfile">			
	<h2>Activity</h2>	
	<ul>
		<li><a href="{{URL::route('latestactivity')}}">Latest Activity</a><span>Site activity & reports</span></li>
		<li><a href="{{URL::route('usersList_login_historys')}}">Login History</a><span>Login activity</span></li>
	</ul>		
	<h2>Admin</h2>	
	<ul>
		<li><a href="{{URL::route('usersList')}}">Users List</a><span>List of users like Student,Trainer,Institute Manager,Admin  </span></li>
		<li><a href="{{URL::route('institute-lists')}}">Institute List</a><span>List of Training Institue</span></li>
		<li><a href="{{URL::route('courseList')}}">Course List</a><span>List of Courses </span></li>
	</ul>	
	<h2>Master</h2>	
	<ul>
		<li><a href="{{URL::route('degreeMaster')}}">Degree</a><span>  </span></li>
		<li><a href="{{URL::route('grademaster')}}">Grade</a><span>  </span></li>
		<li><a href="{{URL::route('sectormaster')}}">Sector</a><span>  </span></li>
	</ul>
</div>