<?php 

namespace App\Http\Controllers;

use Auth;
use Hash;
use Request;
use Redirect;
use Validator;
use Input;
use DB;
use Session;
use Cookie;
use Mail;

class AdminController extends Controller {
	
	public function __construct()
	{
		if(Auth::user()->nUsrRoleID !=1001){
			echo 'You don\'t have permission to view this page';die;
		}
	}	
	public function index() { 
		echo "test";
		
	}		
	public function affiliateRegistration()
	{
		$data = Input::all();
		$data['role'] = 1006;
		$response = app('App\Http\Controllers\AccountController')->userRegistration($data); 
		// if($response['status'] == 'success'){
			// $result = DB::table('tblinstitutemaster')->insert([
						// 'tInstituteName'	=> $data["iName"],
						// 'nInstituteMgrIncharge'	=> $response["user_id"],
						// 'nInstituteTypeID'	=> $data["nInstituteTypeID"]
					// ]);	
		// }
		print_r(json_encode($response)); 
	}
	public function affiliateUserAdd() { 
	
		return view('admin/affiliate_user_add');
		
       
	}

	
	
	
	
	public function latestActivity() { 
	
		$latest_activity = DB::table('tblcoursecataloguemaster')->get();
        return view('admin/latest-activity')->with('latest_activity', $latest_activity);
	}
	
	public function usersLoginHistory() { 
	$login_history = DB::table('tbltakshashila_login_history')
			->Join('tblusermaster', 'tbltakshashila_login_history.id_user', '=', 'tblusermaster.ausrid')->orderBy('id_login_history', 'desc')
			->paginate(10); 
		//$login_history = DB::table('tbltakshashila_login_history')
		//->paginate(10);
		//print_r($login_history);die;
		return view('admin/login-history')->with('login_history', $login_history);

	}
	public function usersList() { 
	
		$name = DB::table('tblusermaster')
			->Join('tbluserrolemaster', 'tblusermaster.nUsrRoleID', '=', 'tbluserrolemaster.aUsrRoleID')
			->paginate(10); 
		return view('admin/users-list')->with('name', $name);

	}
	public function instituteList() { 
		$institute_list = DB::table('tblinstitutemaster')
		->leftJoin('tblusermaster', 'tblinstitutemaster.nInstituteMgrIncharge', '=', 'tblusermaster.ausrid')
		->paginate(10);
		return view('admin/institute-list')->with('institute_list', $institute_list);

	}
	
	public function courseList() { 
	
		$course_list = DB::table('tblcoursecataloguemaster')->paginate(10);
        return view('admin/course-list')->with('course_list', $course_list);
	}
	
	public function degreeMaster() { 
		$degree_master = DB::table('tbldegreemaster')->where('status','!=','Deleted')->paginate(10);
		return view('admin/degree/list-degree')->with('degree_master', $degree_master);

	}

	public function addDegreeMaster() { 
		
			$add_degree_master = DB::table('tbldegreemaster')->get();
			return view('admin/degree/add-degree')->with('add_degree_master', $add_degree_master);

	}   
	public function editDegreeMaster( $id ) { 
		
			$degree_master = DB::table('tbldegreemaster')->where('aDegreeID',$id)->first();
			return view('admin/degree/edit-degree')->with('degree_master', $degree_master);

	}   
	public function deleteDegreeMaster( $id ) { 
		
			$affected = DB::table('tbldegreemaster')->where('aDegreeID',$id)->update(array('status'=>'Deleted'));		
			if( $affected ){
				Session::flash('status', 'success');
				Session::flash('message', 'Deleted Successfully');
			}else{
				Session::flash('status', 'warning');
				Session::flash('message', 'Unable to delete');
			}			
			return Redirect::route('degreeMaster');

	} 
	public function gradeMaster() { 
		$grade_master = DB::table('tblgrademaster')->get();
		return view('admin/grade-master')->with('grade_master', $grade_master);

	}
    public function sectorMaster() { 
		$sector_master = DB::table('tblsectormaster')
							->where('status','!=','Deleted')
							->paginate(10);
		return view('admin/sector-master')->with('sector_master', $sector_master);

	}  
	public function addSectorMaster() { 
		
			$add_sector_master = DB::table('tblsectormaster')->get();
			return view('admin/add-sector')->with('add_sector_master', $add_sector_master);

	}
	public function sectorMasterUpdate(){
		 $requests = Request::all();	 
		 $affected = DB::table('tblsectormaster')
			->where('aSectorID', $requests['aSectorID'])
			->update(['tSectorName'=>$requests['tSectorName'],'tSectorCode'=>$requests['tSectorCode'],'nSortorder'=>$requests['nSortorder']]);
		if( $affected ){
			Session::flash('status', 'success');
			Session::flash('message', 'Updated successfully');
		}else{
			Session::flash('status', 'warning');
			Session::flash('message', 'Updation failed');
		}		
		return Redirect('/admin/sector/edit/'.$requests['aSectorID']);
						
	}
   public function editSectorMaster( $id ) { 
		
			$sector_master = DB::table('tblsectormaster')->where('aSectorID',$id)->first();
			return view('admin/edit-sector')->with('sector_master', $sector_master);

	}   	
	public function deleteSectorMaster( $id ) { 
		
			$affected = DB::table('tblsectormaster')->where('aSectorID',$id)->update(array('status'=>'Deleted'));		
			if( $affected ){
				Session::flash('status', 'success');
				Session::flash('message', 'Deleted Successfully');
			}else{
				Session::flash('status', 'warning');
				Session::flash('message', 'Unable to delete');
			}			
			return Redirect::route('sectormaster');

	} 
	
	
		
	}
