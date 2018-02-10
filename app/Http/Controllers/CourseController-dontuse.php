<?php 

namespace App\Http\Controllers;

use Auth;
use URL;
use Hash;
use Request;
use Redirect;
use Validator;
use Input;
use DB;
use Session;
use Route;

use Cookie;
use Mail;
use App\Models\Interest as Interest;
use App\Models\Course as Course;
use Illuminate\Pagination\Paginator;
use App\Models\Coursecategory;
use App\Models\CourseSector;
use App\Models\Batch;
use App\Models\Asinpirationinterests;
use App\Models\Rating;
use Response;

class CourseController extends Controller {
	
	public function __construct()
	{
		
	}
	public function getCategoryByURL($id_url){
			$url = DB::table('tblcourseaspintcategory')
							->where('id_url', $id_url)->first();
			return $url;
	}

	public function getCategoryNameByURL($url_name){
		$data = DB::table('tblcourseaspintcategory')
					->join('tbltakshashila_url','tbltakshashila_url.id_url','=','tblcourseaspintcategory.id_url')
					->where('tbltakshashila_url.url_name','like','%'.$url_name.'%')->first();							
		return $data;
	}


	public function getUserAndInstituteInfo($userid){
			$user_ins = DB::table('tblusermaster')
						->leftJoin('tblinstitutemaster', 'tblusermaster.ausrid', '=', 'tblinstitutemaster.nInstituteMgrIncharge')
						->where('tblusermaster.ausrid', $userid)->first();
			return $user_ins;
	}
	public function getInsFacilities($userid){
			$facilities = DB::table('tblinstitutefacilities')
						->join('tbltrainingfacilities', 'tblinstitutefacilities.nFacilityID', '=', 'tbltrainingfacilities.atrainingfacilityid')
					->where('tblinstitutefacilities.nUserId', $userid)->limit(4)->get();
					
			return $facilities;
	}
	public function displayCatalog() {
		$requests = Request::all();
		if( isset($_GET['t']) && $_GET['t'] == 'workshop-courses' ){
			$array = array(4);
			Session::put('filters.duration', $array);
			Session::forget('filters.type');
			Session::forget('filters.mode');
		}
		if( isset($_GET['t']) && $_GET['t'] == 'short-term-courses' ){
			$array = array(3);
			Session::put('filters.duration', $array);
		Session::forget('filters.type');
			Session::forget('filters.mode');
		}
		if( isset($_GET['t']) && ( $_GET['t'] == '1' || $_GET['t'] == '2' ) ){
			$array = array($_GET['t']);
			Session::put('filters.type', $array);
			Session::forget('filters.duration');
			Session::forget('filters.mode');
		}
		if( isset($_GET['m']) && ( $_GET['m'] == '2' ) ){
			$array = array(2);
			Session::put('filters.mode', $array);
				Session::forget('filters.duration');
			Session::forget('filters.type');
		}
			//$cat = $this->getCategoryByURL(Request::route()->getName());

			$cat = $this->getCategoryNameByURL(Request::route()->getPath());

		if( isset($_GET['s']) || isset($cat->aAspIntCatID) ){
			Session::forget('filters.mode');
			Session::forget('filters.duration');
			Session::forget('filters.type');
		}
		if( isset($_GET['location']) && isset($_GET['keyword']) ){
			Session::forget('filters.mode');
			Session::forget('filters.duration');
			Session::forget('filters.type');
		}
		//$filters = Session::all(); print_r($filters);die;
	
		
		if(isset($cat->aAspIntCatID)): $id_category = $cat->aAspIntCatID; else: $id_category = ''; endif;
		
		if(isset($_GET['location'])): $location = $_GET['location']; else: $location = ''; endif;
		if(isset($_GET['keyword'])): $keyword = $_GET['keyword']; else: $keyword = ''; endif;
		if(isset($_GET['s'])): $sector_id = $_GET['s']; else: $sector_id = ''; endif;
		$googleLocation = $this->getGoolgeLatLong($location);
		$batch = $this->getCourses($googleLocation, $keyword, $id_category, $sector_id); 
                
                // Sectors
                $sectors = CourseSector::all();
                
                // Category
                if(isset($requests['s'])){
                    $category = Coursecategory::where('nSectorid' ,'=' ,$requests['s'])->get();
                } else {
                    $category = '';
                }                
                
                $data = array(
                    'batch' => $batch,
                    'sectors' => $sectors,
                    'categories' => $category
                );
		return view('course-catalogue')->with($data);
	}


	public function getGoolgeLatLong($location){
    
	    if(!empty($location)){
	        
	        $formattedAddr = str_replace(' ','+',$location);
	        
	        $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
	        $output = json_decode($geocodeFromAddr);
	        
	        $data['latitude']  = $output->results[0]->geometry->location->lat; 
	        $data['longitude'] = $output->results[0]->geometry->location->lng;
	        
	        if(!empty($data)){
	            return $data;
	        }else{
	            return false;
	        }
	    }else{
	        return false;   
	    }
	}


	public function courseDescription($batchid) {
            $course = $this->getCourses('', '', '', '', $batchid);
            if(!$course){
                Session::flash('message', 'Either enrollment for this batch has been closed (or) batch not exists.'); 
                Session::flash('alert-class', 'alert-danger');
                return redirect('course/list');
            }
            
            $batch_info = DB::table('tbltrainingbatchmaster')
                    ->where('aTrainingBatchMasterID','=',$batchid)
                    ->first();
            
            $ratings = DB::table('tbl_rating')
                    ->join('tblusermaster', 'tbl_rating.nusrid', '=', 'tblusermaster.ausrid')
                    ->where('nCourseID','=',$batch_info->nCourseMasterid)->limit(3)->get();
            return view('course-description')->with('course', $course)->with('ratings',$ratings);
	}
	public function getCourses( $location = array(), $keyword='', $id_category='', $sector_id='', $batchid = '') {
            //$batch =  new Course; 
          
            $requests = Request::all();

            $batch = DB::table('tblcoursecataloguemaster');

            if($location){
                $batch = $batch->selectRaw('*, (6371 * acos( cos( radians('.$location['latitude'].') ) * cos( radians( tblinstitutemaster.lat ) ) * cos( radians( tblinstitutemaster.lng ) - radians('.$location['longitude'].') ) + sin( radians('.$location['latitude'].') ) * sin( radians( tblinstitutemaster.lat ) ) ) ) AS distance');
            }
            
            $batch  = $batch->join('tbltrainingbatchmaster', 'tblcoursecataloguemaster.aCourseMasterID', '=', 'tbltrainingbatchmaster.nCourseMasterid')			
                        ->join('tblbatchstatus', 'tbltrainingbatchmaster.nbatchstatus', '=', 'tblbatchstatus.abatchstatusid')		
                        ->join('tblusermaster', 'tblcoursecataloguemaster.nUsrID', '=', 'tblusermaster.ausrid')		
                        ->join('tblcoursemodemaster', 'tbltrainingbatchmaster.nCourseModeID', '=', 'tblcoursemodemaster.aCourseModeID')
                        ->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
                        ->leftJoin('tblprogramme', 'tbltrainingbatchmaster.nProgramid', '=', 'tblprogramme.aProgramid')		
                        ->leftJoin('tblinstitutemaster', 'tblcoursecataloguemaster.nInstituteID', '=', 'tblinstitutemaster.aInstituteID')		
                        ->where('tblcoursecataloguemaster.nCourseStatusID', 3)
                        ->where('tbltrainingbatchmaster.nbatchstatus', 1)
                        ->where('tbltrainingbatchmaster.dEnrolmentExpDate', '>=', date("Y-m-d"));
            /*if( $location != '' ){
                    $batch = $batch->where('tblusermaster.tGoogleLoc','LIKE', '%'.$location.'%');
                    $batch = $batch->orWhere('tblinstitutemaster.tGoogleInsLoc','LIKE', '%'.$location.'%');
            }*/
            if( $keyword != '' ){
//                    $batch = $batch->where('tblcoursecataloguemaster.tCoursetitle','LIKE', '%'.$keyword.'%');
//                    $batch = $batch->orWhere('tblcoursecataloguemaster.tCoursesubtitle','LIKE', '%'.$keyword.'%');
                $batch = $batch->where(function($query){
                        if(isset($requests['keyword'])){
                            Session::put('search_keyword', $requests['keyword']);
                            $keyword = $requests['keyword'];
                        } elseif(Session::has('search_keyword')){
                            $keyword = Session::get('search_keyword');
                        } else{
                            $keyword = '';
                        }
                        $query->where('tblcoursecataloguemaster.tCoursetitle','LIKE', '%'.$keyword.'%')
                                ->orWhere('tblcoursecataloguemaster.tCoursesubtitle','LIKE', '%'.$keyword.'%');     
                    });
            }
            if( $id_category != '' ){
                    $batch = $batch->where('tblcoursecataloguemaster.nCourseCategoryID', $id_category);
            }
            if( $sector_id != '' ){
                    $batch = $batch->where('tblcoursecataloguemaster.nSectorID', $sector_id);
            }
            if( $batchid != '' ){
                    $batch = $batch->where('tbltrainingbatchmaster.aTrainingBatchMasterID', $batchid);
            }
            
            // Filter by aspiration interest
            if(isset($requests['interest_id'])): $interest_id = $requests['interest_id']; else: $interest_id = ''; endif;
            if( $interest_id != '' ){
                    $batch = $batch->where('tblcoursecataloguemaster.njobroleid', $interest_id);
            }
            
            $filters = Session::all();
            if(isset($filters['filters']['type'])){
                    $batch = $batch->whereIn('tbltrainingbatchmaster.ntype', $filters['filters']['type']);
            }
            if(isset($filters['filters']['mode'])){
                    $batch = $batch->whereIn('tbltrainingbatchmaster.nCourseModeID', $filters['filters']['mode']);
            }
            if(isset($filters['filters']['duration'])){
                if (in_array(3, $filters['filters']['duration']))
                  {
                        $batch = $batch->whereBetween('tbltrainingbatchmaster.nTotalBatchDuration', [7, 180]);
                  }
                if (in_array(4, $filters['filters']['duration']))
                  {
                        $batch = $batch->where('tbltrainingbatchmaster.nTotalBatchDuration', '<=', 5);
                  }

            }
            if($location){
                $batch = $batch->having('distance', '<=', 5);
            }
            /*$batch = $batch->paginate(5); 
            $batch->setPath('/course-catalogue/');*/
            $batch->orderBy('tbltrainingbatchmaster.dEnrolmentExpDate');
            return $batch->get();
	}
	public function displayCourses($storeFilterParams = array()) {
            $requests = Request::all();
            if(isset($requests['location'])): $location = $requests['location']; else: $location = ''; endif;
            if(isset($requests['keyword'])): $keyword = $requests['keyword']; else: $keyword = ''; endif;
            if(isset($requests['sector_id'])): $sector_id = $requests['sector_id']; else: $sector_id = ''; endif;        
            if(isset($requests['category_id'])): $id_category = $requests['category_id']; else: $id_category = ''; endif;
            if(isset($requests['interest_id'])): $interest_id = $requests['interest_id']; else: $interest_id = ''; endif;

            if($storeFilterParams){
                $location = $storeFilterParams['location'] ? $storeFilterParams['location'] : '';
                $keyword  = $storeFilterParams['keyword'] ? $storeFilterParams['keyword'] : '';
            }

            $googleLocation = $this->getGoolgeLatLong($location);
            $batch = $this->getCourses($googleLocation, $keyword, $id_category, $sector_id);

            // Sectors
            $sectors = CourseSector::all();

            // Category
            if(isset($requests['sector_id'])){
                $category = Coursecategory::where('nSectorid' ,'=' ,$requests['sector_id'])->get();
            } else {
                $category = '';
            }

            // Aspiration Interests / Job
            if(isset($requests['category_id'])){
                $interests = Asinpirationinterests::where('naspintcatid' ,'=' ,$requests['category_id'])->get();
            } else {
                $interests = '';
            }

            $breadcrumb = $this->createBreadcrumb(array('sector'=>$sector_id,'category'=>$id_category,'interest'=>$interest_id));

            $data = array(
                'batch' => $batch,
                'sectors' => $sectors,
                'categories' => $category,
                'interests' => $interests,
                'requests' => $requests,
                'breadcrumbs' => $breadcrumb,
                'total' => count($batch)
            );
        
            return view('includes/all-courses')->with($data);		
	}	
	public function storeFilter() {

            $data = Input::all();
            unset($data['_token']);
            Session::put('filters', $data); 		
            echo $this->displayCourses($data);
	}	
	public function getLocation() {
		$district = Input::get('district');
		$location = DB::table('tbllocationmaster')
							->where('tDistrict', $district)
							->groupby('tLocation')->get();
		$loc_html = '';
		foreach($location as $loc){
			$loc_html .= '<option value="'.$loc->aLocationID.'">'.$loc->tLocation.'</option>';
		}
		 return $loc_html;
		
	}
	public function getInterest() {
		$id_category = Input::get('id_category');
		$interests = DB::table('tblaspirationinterests')
							->where('naspintcatid', $id_category)->get();

		if(!$interests){
			return '<option value="">--No Jobs Available--</option>';
		}

		$html = '';
		$html .= '<option value="">Select</option>';
		foreach($interests as $int){
			$html .= '<option value="'.$int->aAspIntID.'">'.$int->tAspirationinterest.'</option>';
			//$html .= '<li><a data-dk-dropdown-value="'.$int->aAspIntID.'">'.$int->tAspirationinterest.'</a></li>';
		}
		 return $html;
		
	}
	public function getTrainingIns($user_id) {
		
            $ins = DB::table('tblinstitutemaster')
                    ->where('nInstituteMgrIncharge', $user_id)->first();		
             return $ins;
		
	}
	public function getAff($institute_id) {
            $response = array();
            $aff = DB::table('tbltakinstituteaffiliation')
                                    ->join('tblaffiliationstatusmaster', 'tbltakinstituteaffiliation.naffiliationstatus', '=', 'tblaffiliationstatusmaster.aaffiliationstatusid')
                                    ->join('tblcontract', 'tbltakinstituteaffiliation.ncontractid', '=', 'tblcontract.aContractID')
                                    ->where('tbltakinstituteaffiliation.nInstituteid', $institute_id)
                                    ->where('tbltakinstituteaffiliation.dstartdate','<=' ,date("Y-m-d"))
                                    ->where('tbltakinstituteaffiliation.denddate','>=' ,date("Y-m-d"))
                                    ->first();					
            if( isset($aff->nMaxBatch) ){
                            $batch = DB::table('tbltrainingbatchmaster')
                                    //->join('tblaffiliationstatusmaster', 'tbltakinstituteaffiliation.naffiliationstatus', '=', 'tblaffiliationstatusmaster.aaffiliationstatusid')
                                    //->join('tblcontract', 'tbltakinstituteaffiliation.ncontractid', '=', 'tblcontract.aContractID')
                                    ->where('nInstituteID', $institute_id)
                                     ->whereBetween('dCourseCreatedAt', array($aff->dstartdate, $aff->denddate))->get();
                            if( count($batch) < $aff->nMaxBatch ){
                                    $response['status'] = 'success';
                                    $response['total_batch'] = $aff->nMaxBatch;
                                    $response['created_batch'] = count($batch);
                            }else{
                                            $response['status'] = 'failed';
                                            $response['msg'] = 'You have elapsed the Maximum limit of Batches for the current subscription expiring on date '.date("d-m-Y", strtotime($aff->denddate)).'. Please contact your Account Executive. Thank you.';
                            }

            }else{
                $aff = DB::table('tbltakinstituteaffiliation')
                                ->join('tblaffiliationstatusmaster', 'tbltakinstituteaffiliation.naffiliationstatus', '=', 'tblaffiliationstatusmaster.aaffiliationstatusid')
                                ->join('tblcontract', 'tbltakinstituteaffiliation.ncontractid', '=', 'tblcontract.aContractID')
                                ->where('tbltakinstituteaffiliation.nInstituteid', $institute_id)
                                //->where('tbltakinstituteaffiliation.dstartdate','<=' ,date("Y-m-d"))
                                //->where('tbltakinstituteaffiliation.denddate','>=' ,date("Y-m-d"))
                                ->first();
                if(isset($aff->nMaxBatch)){
                    $response['status'] = 'failed';
                    $response['msg'] = 'Your subscription is Expired. Please contact your Account Executive. Thank you.';
                    Session::flash('message', 'Your subscription is Expired. Please contact your Account Executive. Thank you.'); 
                    Session::flash('alert-class', 'alert-danger');
                    //return redirect('CoursListing');
//                    return redirect()->action(
//                        'CourseController@courseListing', ['id' => 1]
//                    );
                } else {
                    $response['status'] = 'failed';
                    $response['msg'] = 'Kindly subscribe to one of subscription plans to Schedule a Training Batch. Please contact your Account Executive. Thank you.';
                    Session::flash('message', 'Kindly subscribe to one of subscription plans to Schedule a Training Batch. Please contact your Account Executive. Thank you.'); 
                    Session::flash('alert-class', 'alert-danger');
                    //return redirect('CoursListing');
                }                    
            }
            return $response;		
	}
        
	public function getTrainer() {
		$data = Input::all();
		$trainer = DB::table('tblusermaster')
							->where('tUsrEmail', $data['email'])->where('nUsrRoleID', 1003)->first();
		$user = DB::table('tblusermaster')
							->where('tUsrEmail', $data['email'])->first();
		$response = array();
		if( $trainer != NULL ){
			$response['trainer_userid'] = $trainer->ausrid;
			$response['trainer_fname'] = $trainer->tUsrFName;
			$response['trainer_lname'] = $trainer->tUsrLName;
			$response['msg'] = '';
		}elseif($user != NULL){
			$response['trainer_userid'] = '';
			$response['msg'] = '<span style="color:red">Email id already registered with different role.</span>';
		}else{
			DB::table('tblusermaster')->insert([
				'tUsrEmail' 		=> $data['email'],
				'nUsrRoleID' 		=> 1003,
				'tUsrFName' 	=> $data['fname'],
				'tUsrLName' 		=> $data['lname'],
				'dUsrcreateddt' 		=> date('Y-m-d H:i:s'),
				'password' 		=> Hash::make('Csjl42@8'),
				'status' 		=> 1
			]);	
			$response['trainer_userid'] = DB::getPdo()->lastInsertId();
			$response['msg'] = '<span style="color:green">You have entered a New Trainer Email address. An Email is sent with the default password. Kindly request the Trainer to validate and register his/her profile. Thank You</span>';	
		}	
		return $response;
		
	}	
	public function courseListing() {
		if( isset($_GET['keyword']) && !empty($_GET['keyword']) ){
				$search_keyword = $_GET['keyword'];
			}else{
				$search_keyword = '';
			}
		
		if( Auth::user()->nUsrRoleID == 1001 ){
			if( isset($_GET['status']) && !empty($_GET['status']) ){
                            $batch = DB::table('tblcoursecataloguemaster')
                                    ->join('tblsectormaster', 'tblcoursecataloguemaster.nSectorID', '=', 'tblsectormaster.aSectorID')
                                    ->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
                                    ->join('tblcoursestatus', 'tblcoursecataloguemaster.nCourseStatusID', '=', 'tblcoursestatus.aCourseStatusID')
                                    ->where('tblcoursecataloguemaster.nCourseStatusID', $_GET['status'])
                                    ->where('tblcoursecataloguemaster.tCoursetitle', 'LIKE', '%'.$search_keyword.'%')
                                    ->orderBy('tblcoursecataloguemaster.aCourseMasterID','DESC')
                                    ->get();
			}else{
                            $batch = DB::table('tblcoursecataloguemaster')
                                    ->join('tblsectormaster', 'tblcoursecataloguemaster.nSectorID', '=', 'tblsectormaster.aSectorID')
                                    ->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
                                    ->join('tblcoursestatus', 'tblcoursecataloguemaster.nCourseStatusID', '=', 'tblcoursestatus.aCourseStatusID')
                                    ->where('tblcoursecataloguemaster.tCoursetitle', 'LIKE', '%'.$search_keyword.'%')
                                    ->orderBy('tblcoursecataloguemaster.aCourseMasterID','DESC')
                                    ->get();
			}
		
			 return view('course-listing')->with('batch', $batch);
		die;	
		}
		if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
			
                    if( isset($_GET['status']) && !empty($_GET['status']) ){
                        $batch = DB::table('tblcoursecataloguemaster')
                                    ->join('tblsectormaster', 'tblcoursecataloguemaster.nSectorID', '=', 'tblsectormaster.aSectorID')
                                    //->join('tblcoursemodemaster', 'tbltrainingbatchmaster.nCourseModeID', '=', 'tblcoursemodemaster.aCourseModeID')
                                    ->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
                                    ->join('tblcoursestatus', 'tblcoursecataloguemaster.nCourseStatusID', '=', 'tblcoursestatus.aCourseStatusID')
                                    ->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
                                    ->where('tblcoursecataloguemaster.nCourseStatusID', $_GET['status'])
                                    ->where('tblcoursecataloguemaster.tCoursetitle', 'LIKE', '%'.$search_keyword.'%')
                                    ->orderBy('tblcoursecataloguemaster.aCourseMasterID','DESC')
                                    ->get();
                    }else{
                        $batch = DB::table('tblcoursecataloguemaster')
                                    ->join('tblsectormaster', 'tblcoursecataloguemaster.nSectorID', '=', 'tblsectormaster.aSectorID')
                                    //->join('tblcoursemodemaster', 'tbltrainingbatchmaster.nCourseModeID', '=', 'tblcoursemodemaster.aCourseModeID')
                                    ->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
                                    ->join('tblcoursestatus', 'tblcoursecataloguemaster.nCourseStatusID', '=', 'tblcoursestatus.aCourseStatusID')
                                    ->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
                                    ->where('tblcoursecataloguemaster.tCoursetitle', 'LIKE', '%'.$search_keyword.'%')
                                    ->orderBy('tblcoursecataloguemaster.aCourseMasterID','DESC')
                                    ->get();
                    }

                    return view('course-listing')->with('batch', $batch);
		}		
	}
	public function closeBatch() {
		
		$data = Input::all();
		
			$result = DB::table('tbltrainingbatchmaster')->where('aTrainingBatchMasterID', $data["batch_id"])->update([
						'nbatchstatus'	=> 2
					]);	
		$response["status"] = 'success';
		print_r(json_encode($response)); 
			
	}
	public function publishCourse() {
		
		$data = Input::all(); 
		
		$result = DB::table('tblcoursecataloguemaster')->where('aCourseMasterID', $data["course_id"])->update([
						'nCourseStatusID'	=> 2
					]);	
		DB::table('tblpublishcourse')->insert([
						'nCourseid'	=> $data["course_id"],
						'nCoursestatusid'	=> 2,
						'tComments'	=> '',
						'nuserid'	=> Auth::user()->ausrid,
						'dpublishcoursedatetime'	=> date("Y-m-d H:i:s")
					]);
		if($result){
				$response["status"] = 'success';
		}else{
			$response["status"] = 'failed';
		}
		
	
		print_r(json_encode($response)); 
			
	}
	public function approveCourse() {
		
		$data = Input::all(); 
		
		$result = DB::table('tblcoursecataloguemaster')->where('aCourseMasterID', $data["course_id"])->update([
						'nCourseStatusID'	=> $data['approved'],
						'nStatusComment'	=> $data['comments']
					]);	
		DB::table('tblpublishcourse')->insert([
						'nCourseid'	=> $data["course_id"],
						'nCoursestatusid'	=> $data['approved'],
						'tComments'	=> $data['comments'],
						'nuserid'	=> Auth::user()->ausrid,
						'dpublishcoursedatetime'	=> date("Y-m-d H:i:s")
					]);	
		return redirect('course-listing?status=2');
			
	}	
	
	public function closeCourse() {
		
		$data = Input::all(); 
		
		$result = DB::table('tblcoursecataloguemaster')->where('aCourseMasterID', $data["course_id"])->update([
						'nCourseStatusID'	=> 4
					]);	
			DB::table('tblpublishcourse')->insert([
						'nCourseid'	=> $data["course_id"],
						'nCoursestatusid'	=> 4,
						'tComments'	=> '',
						'nuserid'	=> Auth::user()->ausrid,
						'dpublishcoursedatetime'	=> date("Y-m-d H:i:s")
					]);
		if($result){
                    DB::table('tbltrainingbatchmaster')->where('nCourseMasterid', $data["course_id"])->update([
                        'nbatchstatus'	=> 2
                    ]);                    
                    $response["status"] = 'success';
		}else{
			$response["status"] = 'failed';
		}
		
	
		print_r(json_encode($response)); 
			
	}
	public function batchList($id_course) {
		if( Auth::user()->nUsrRoleID == 1001 ){
			$batch = DB::table('tblcoursecataloguemaster')
						->join('tbltrainingbatchmaster', 'tblcoursecataloguemaster.aCourseMasterID', '=', 'tbltrainingbatchmaster.nCourseMasterid')			
						->join('tblbatchstatus', 'tbltrainingbatchmaster.nbatchstatus', '=', 'tblbatchstatus.abatchstatusid')			
						->leftJoin('tblprogramme', 'tbltrainingbatchmaster.nProgramid', '=', 'tblprogramme.aProgramid')	
						->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
						->get(); 
						$course = DB::table('tblcoursecataloguemaster')->where('aCourseMasterID',  $id_course)->first();
						 return view('batch-list')->with('batch', $batch)->with('course', $course);
		}else if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
			if( isset($_GET['status']) && !empty($_GET['status']) ){
				$batch = DB::table('tblcoursecataloguemaster')
						->join('tbltrainingbatchmaster', 'tblcoursecataloguemaster.aCourseMasterID', '=', 'tbltrainingbatchmaster.nCourseMasterid')			
						->join('tblbatchstatus', 'tbltrainingbatchmaster.nbatchstatus', '=', 'tblbatchstatus.abatchstatusid')			
						->leftJoin('tblprogramme', 'tbltrainingbatchmaster.nProgramid', '=', 'tblprogramme.aProgramid')			
						->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
						->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
						->where('tbltrainingbatchmaster.nbatchstatus', $_GET['status'])
						->get(); 
			}else{
				$batch = DB::table('tblcoursecataloguemaster')
						->join('tbltrainingbatchmaster', 'tblcoursecataloguemaster.aCourseMasterID', '=', 'tbltrainingbatchmaster.nCourseMasterid')			
						->join('tblbatchstatus', 'tbltrainingbatchmaster.nbatchstatus', '=', 'tblbatchstatus.abatchstatusid')			
						->leftJoin('tblprogramme', 'tbltrainingbatchmaster.nProgramid', '=', 'tblprogramme.aProgramid')			
						->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
						->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
						->get(); 
			}
			
			$course = DB::table('tblcoursecataloguemaster')->where('aCourseMasterID',  $id_course)->first();
			$institute = $this->getTrainingIns(Auth::user()->ausrid); 
		//print_r($institute);die;
			 return view('batch-list')->with('batch', $batch)->with('institute', $institute)->with('course', $course);
		}		
	}	
	public function exportBatchList($id_course) { 
		
			if( isset($_GET['status']) && !empty($_GET['status']) ){
				$batch = DB::table('tblcoursecataloguemaster')
						->join('tbltrainingbatchmaster', 'tblcoursecataloguemaster.aCourseMasterID', '=', 'tbltrainingbatchmaster.nCourseMasterid')			
						->join('tblbatchstatus', 'tbltrainingbatchmaster.nbatchstatus', '=', 'tblbatchstatus.abatchstatusid')			
						->leftJoin('tblprogramme', 'tbltrainingbatchmaster.nProgramid', '=', 'tblprogramme.aProgramid')			
						->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
						->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
						->where('tbltrainingbatchmaster.nbatchstatus', $_GET['status'])
						->get(); 
			}else{
				$batch = DB::table('tblcoursecataloguemaster')
						->join('tbltrainingbatchmaster', 'tblcoursecataloguemaster.aCourseMasterID', '=', 'tbltrainingbatchmaster.nCourseMasterid')			
						->join('tblbatchstatus', 'tbltrainingbatchmaster.nbatchstatus', '=', 'tblbatchstatus.abatchstatusid')			
						->leftJoin('tblprogramme', 'tbltrainingbatchmaster.nProgramid', '=', 'tblprogramme.aProgramid')			
						->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
						->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
						->get(); 
			}
			$data = array();			
			foreach( $batch as $key=>$value ){
				$row = array();
				$row['Batch_Number'] = $value->aTrainingBatchMasterID;
				$row['Batch_Name'] = $value->tTrainingBatchName;
				$row['Course_Title'] = $value->tCoursetitle;
				$row['Batch_Start_Date'] = $value->dTrainingBatchStDate;
				$row['Batch_End_Date'] = $value->dTrainingBatchEndDate;
				$row['Fees'] = $value->tBatchEnrolmentFees;
				$row['Program_Name'] = $value->tprogramname;
				$row['Batch_Status'] = $value->tbatchstatus;
				$data[] = $row;
			}
			

		function cleanData(&$str)
		{
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
		}

		// file name for download
		$filename = "website_data_" . date('Ymd') . ".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");

		$flag = false; 
		foreach($data as $row) { 
		if(!$flag) {
	
		echo implode("\t", array_keys($row)) . "\n";
		$flag = true;
		}echo implode("\t", array_values($row)) . "\n";
		//array_walk($row, 'cleanData');
		//echo implode("\t", array_values($row)) . "\n";		
		}
	exit;
	}	
	public function uploadImage(){
            $response = array();
            $input = Request::input();
            if(!empty($_FILES) && $input['image_type']){
                $image_data = getimagesize($_FILES['file']['tmp_name']);
                if($image_data['mime'] == 'image/jpeg' || $image_data['mime'] == 'image/png'){
                    if($input['image_type'] == 'course' && ($image_data[0] < 810 || $image_data['1'] < 562)){
                        $response['status'] = 'failed';
                        $response['msg'] = 'Please upload an image whose width equal or more then 810px  and height equals or more then 562px for a better view';
                    } elseif($input['image_type'] == 'profile' && $image_data['0'] < 150 && $image_data['1'] < 150 && $image_data['0'] > 1500 && $image_data['1'] > 1500){
                        $response['status'] = 'failed';
                        $response['msg'] = 'Image resolution should be more than 150 X 150';
                    } else {
                        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                        $filename = time().'.'.$ext;
                        $filepath = $_SERVER["DOCUMENT_ROOT"].'/assets/images/'.$filename;
                        move_uploaded_file($_FILES["file"]["tmp_name"], $filepath);
                        $response['status'] = 'success';
                        $response['img'] = '<img src="/assets/images/'.$filename.'">';
                        $response['filename'] = $filename;
                    } 
                } else {
                    $response['status'] = 'failed'; 
                    $response['msg'] = 'Uploaded file is not a valid image';
                }                
            }else{
                $response['status'] = 'failed';         
                $response['msg'] = 'Uploaded file is not a valid image';        
            }
            
            print_r(json_encode($response));
	}
	public function courseBatchCreation() {
		if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
			$institute = $this->getTrainingIns(Auth::user()->ausrid); 
			$user = DB::table('tblusermaster')
							->where('ausrid', Auth::user()->ausrid)->first(); 
			 return view('course-batch-creation')->with('institute', $institute)->with('user', $user);
		}		
	}		
	public function editCourse($id_course) { 
		if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
			//$institute = $this->getTrainingIns(Auth::user()->ausrid); 
			$user = DB::table('tblusermaster')
							->where('ausrid', Auth::user()->ausrid)->first(); 
			$course = DB::table('tblcoursecataloguemaster')
					->join('tblsectormaster', 'tblcoursecataloguemaster.nSectorID', '=', 'tblsectormaster.aSectorID')
					->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
					->join('tblcoursestatus', 'tblcoursecataloguemaster.nCourseStatusID', '=', 'tblcoursestatus.aCourseStatusID')
					->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
					->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
					->first();
				
			 return view('edit-course')->with('user', $user)->with('course', $course);
		}		
	}		
	public function courseApproval($id_course) { 
		if( ( Auth::user()->nUsrRoleID == 1001 ) ){
			$course = DB::table('tblcoursecataloguemaster')
					->join('tblsectormaster', 'tblcoursecataloguemaster.nSectorID', '=', 'tblsectormaster.aSectorID')
					->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
					->join('tblcoursestatus', 'tblcoursecataloguemaster.nCourseStatusID', '=', 'tblcoursestatus.aCourseStatusID')
					->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
					->first();
			$institute = array(); //print_r($course);die;
			if( isset( $course->nInstituteID ) ){
					$institute = DB::table('tblinstitutemaster')
					->join('tblusermaster', 'tblinstitutemaster.nInstituteMgrIncharge', '=', 'tblusermaster.ausrid')
					->where('tblinstitutemaster.aInstituteID', $course->nInstituteID)
					->first();
				
			}
			 return view('course-approval')->with('course', $course)->with('institute', $institute);
		}		
	}
	public function scheduleNewBatch($id_course) {
		
		if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
			 $institute = $this->getTrainingIns(Auth::user()->ausrid); 
			 if(isset($institute->aInstituteID)){
				 $response = $this->getAff( $institute->aInstituteID );//print_r($response);die;
				 if($response['status'] == 'failed'){
                                    return redirect()->route('CoursListing');
				 }
			 }
			// $user = DB::table('tblusermaster')
							// ->where('ausrid', Auth::user()->ausrid)->first(); 
			// $batch = DB::table('tbltrainingbatchmaster')
						// ->join('tblcoursecataloguemaster', 'tbltrainingbatchmaster.nCourseMasterid', '=', 'tblcoursecataloguemaster.aCourseMasterID')
						// ->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
						// ->where('tbltrainingbatchmaster.aTrainingBatchMasterID', $id_batch)
						// ->first(); 
			$user = DB::table('tblusermaster')
							->where('ausrid', Auth::user()->ausrid)->first(); 
			$course = DB::table('tblcoursecataloguemaster')
					->join('tblsectormaster', 'tblcoursecataloguemaster.nSectorID', '=', 'tblsectormaster.aSectorID')
					->join('tblcoursecomplexitymaster', 'tblcoursecataloguemaster.nCourseComplexityID', '=', 'tblcoursecomplexitymaster.aCoursecomplexityMasterID')
					->join('tblcoursestatus', 'tblcoursecataloguemaster.nCourseStatusID', '=', 'tblcoursestatus.aCourseStatusID')
					->where('tblcoursecataloguemaster.nUsrID', Auth::user()->ausrid)
					->where('tblcoursecataloguemaster.aCourseMasterID', $id_course)
					->first();
			
                        $programs = DB::table('tblprogramme')->get();
                        
			return view('schedule-new-batch')
				 ->with('user', $user)->with('course', $course)->with('institute', $institute)->with('programs',$programs);
		}		
	}
	public function getGoverningBody() {
		$data = Input::all();  
		$response = array();
		$program = DB::table('tblprogramme')
                                ->where('aProgramid', $data["program_id"])->first(); 
		if(isset($program->ngoverningbodyid) && !empty($program->ngoverningbodyid)){
			$ins = DB::table('tblinstitutemaster')
							->where('aInstituteID', $program->ngoverningbodyid)
							->where('bGoverningbody', 1)
							->first(); 
			if( isset($ins->tInstituteName) ) {
				$response['govBody'] = $ins->tInstituteName;
				$response['insType'] = $ins->nInstituteTypeID;
				$response['status'] = 'success';
			}
			
		}
		print_r(json_encode($response));	
			
	}
	public function editCourseConfirm() {
		$data = Input::all();  
		if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
			$result = DB::table('tblcoursecataloguemaster')->where('nUsrID', Auth::user()->ausrid)->where('aCourseMasterID', $data["aCourseMasterID"])->update([
					'tCoursetitle'	=> $data["title"],
					'tCoursesubtitle'	=> $data["subTitle"],
					'tCoursedescription'	=> $data["summary"],
					'nSectorID'	=> $data["sectorBlk"],
					'nCourseLangOptionID' 	  	=> $data["takshaLang"],
					'nCourseComplexityID' =>$data["bie"],
					'nCourseCategoryID' 		=> $data["categories"],
				//	'nCourseModeID' => $data["mode"],
					'njobroleid' 		=> $data["jobRoles"],
				'tImageFileName' 		=> $data["image_filename"]
				]);
					if($result){
			//$batch_id = DB::getPdo()->lastInsertId();
			$response['status'] = 'success';
			//$response['id_batch'] = (int)$batch_id;
			$response['msg'] = '<span style="color:green">Course updated Successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">There is no changes to update</span>';
		}
		print_r(json_encode($response));
		}		
	}
	public function trainersInstitutesListing() {
		//if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
                    return view('trainers-institutes');
                    ///return redirect('account/profile');
		//}		
	}
	public function createCourse() {
		$data = Input::all(); 
		$institute = $this->getTrainingIns($data["user_id"]); 
		if(isset($institute->aInstituteID)){
			$aInstituteID = $institute->aInstituteID;
		}else{
			$aInstituteID = NULL;
		}
		$youtube_link = $data["youtube_link"];
		$youtube = explode('=', $youtube_link);
		$youtube_id = '';
		if(!empty($youtube[count($youtube)-1])){
			$youtube_id = $youtube[count($youtube)-1];
		}
		$result = DB::table('tblcoursecataloguemaster')->insert([
					'tCoursetitle'	=> $data["title"],
					'tCoursesubtitle'	=> $data["subTitle"],
					'tCoursedescription'	=> $data["summary"],
					'nSectorID'	=> $data["sectorBlk"],
					'nCourseLangOptionID' 	  	=> $data["takshaLang"],
					'nCourseComplexityID' =>$data["bie"],
					'nCourseCategoryID' 		=> $data["categories"],
					'nUsrID' 		=> $data["user_id"],
					'nInstituteID' 		=> $aInstituteID,
					'njobroleid' 		=> $data["jobRoles"],
				'tImageFileName' 		=> $data["image_filename"],
				'tYouTubeLink' 		=> $youtube_id,
				'dCourseCreatedAt' 		=> date('Y-m-d H:i:s')
				]);
				$course_id = 	DB::getPdo()->lastInsertId();	
			DB::table('tblpublishcourse')->insert([
						'nCourseid'	=> $course_id,
						'nCoursestatusid'	=> 1,
						'tComments'	=> '',
						'nuserid'	=> Auth::user()->ausrid,
						'dpublishcoursedatetime'	=> date("Y-m-d H:i:s")
					]);
					
		// $id = DB::getPdo()->lastInsertId();
		// $year1 = date('Y', strtotime($data["BatchStartDate"]));
		// $year2 = date('Y', strtotime($data["BatchEndDate"]));

		// $month1 = date('m', strtotime($data["BatchStartDate"]));
		// $month2 = date('m', strtotime($data["BatchEndDate"])); 
		// $diff = (($year2 - $year1) * 12) + ($month2 - $month1); 
		// $result1 = DB::table('tbltrainingbatchmaster')->insert([
					// 'tTrainingBatchName'	=> 'TakBatch '.$data["title"].' '.$data["BatchStartDate"],
					// 'dTrainingBatchStDate'	=> date("Y-m-d", time($data["BatchStartDate"])),
					// 'dTrainingBatchEndDate'	=> date("Y-m-d", time($data["BatchEndDate"])),
					// 'dEnrolmentExpDate'	=> date("Y-m-d", time($data["ExpirationDate"])),
					// 'nTotalBatchDuration' 	  	=> $diff,
					// 'nCourseMasterid' => $id,
					// 'nInstituteID' 		=> $aInstituteID,
					// 'tBatchEnrolmentFees' => $data["amount"],
					// 'tdiscountcuponcode' 		=> $data["ccode"],
					// 'ndiscount' 		=> $data["discount"],
					// 'nProgramid' 		=> $data["types"],
					// 'nbatchstatus' 		=> 1
				// ]);	
		if($result){
			//$batch_id = DB::getPdo()->lastInsertId();
			$response['status'] = 'success';
			//$response['id_batch'] = (int)$batch_id;
			$response['msg'] = '<span style="color:green">Course created Successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Something Went Wrong. Please try later</span>';
		}
		print_r(json_encode($response));
	}
	public function createBatch() {
		$data = Input::all(); 
		$institute = $this->getTrainingIns(Auth::user()->ausrid); 
		if(isset($institute->aInstituteID)){
			$aInstituteID = $institute->aInstituteID;		
		} elseif(isset($data['insID'])){
                    $aInstituteID = $data['insID'];
                } else{
                    $aInstituteID = NULL;
		}
		$id_tblprogramme = 0;
		if( !empty($data["programmename"]) && empty($data["insType"]) && empty($data["govBody"]) ){
			 DB::table('tblprogramme')->insert([
						'tprogramname'	=> $data["programmename"]
					]);	
					$id_tblprogramme = DB::getPdo()->lastInsertId();	
		}
			if( !empty($data["programmename"]) && !empty($data["insType"]) && !empty($data["govBody"]) ){
				
				$gbody = DB::table('tblinstitutemaster')
							->where('tInstituteName', $data["govBody"])->first(); 
				if(isset($gbody->aInstituteID)){
					$ngoverningbodyid = $gbody->aInstituteID;
				}else{
					 DB::table('tblinstitutemaster')->insert([
						'tInstituteName'	=> $data["govBody"],
						'nInstituteTypeID'	=> $data['insType'],
						'bGoverningbody'	=> 1
					]);	
					$ngoverningbodyid = DB::getPdo()->lastInsertId();	
				}
				
				
				$program = DB::table('tblprogramme')
							->where('tprogramname', $data["programmename"])->first(); 
				if(isset($program->aProgramid)){
					$id_tblprogramme = $program->aProgramid;	
				}else{
					 DB::table('tblprogramme')->insert([
						'tprogramname'	=> $data["programmename"],
						'ngoverningbodyid'	=> $ngoverningbodyid
					]);	
				$id_tblprogramme = DB::getPdo()->lastInsertId();	
				}
				
			}
		// $id = DB::getPdo()->lastInsertId();
		$year1 = date('Y', strtotime($data["BatchStartDate"]));
		$year2 = date('Y', strtotime($data["BatchEndDate"]));

		$month1 = date('m', strtotime($data["BatchStartDate"]));
		$month2 = date('m', strtotime($data["BatchEndDate"])); 
		
		$day1 = date('d', strtotime($data["BatchStartDate"]));
		$day2 = date('d', strtotime($data["BatchEndDate"])); 
		
		$diff = (( $year2 - $year1 ) * 12) + ( $month2 - $month1 ) + ( $day2 - $day1 ); 
		$lastrow =  DB::table('tbltrainingbatchmaster')->orderBy('aTrainingBatchMasterID', 'DESC')->first();
		
		$batchname = 'Batch-'.$data['tSectorName'].'-'.$data["ctitle"];
		
		if(empty($data["amount"])){
			$amount = 0;
		}else{
			$amount = $data["amount"];
		}
		if(empty($data["ccode"])){
			$ccode = NULL;
		}else{
			$ccode = $data["ccode"];
		}
		if(empty($data["discount"])){
			$discount = 0;
		}else{
			$discount = $data["discount"];
		}
                
                if($data["types"] == 1){
                    $data["nProgramid"] = NULL;
                }
                
		$result = DB::table('tbltrainingbatchmaster')->insert([
					'tTrainingBatchName'	=> $batchname,
					'dTrainingBatchStDate'	=> date("Y-m-d", strtotime($data["BatchStartDate"])),
					'dTrainingBatchEndDate'	=> date("Y-m-d", strtotime($data["BatchEndDate"])),
					'dEnrolmentExpDate'	=> date("Y-m-d", strtotime($data["ExpirationDate"])),
					'nTotalBatchDuration' 	=> $diff,
					'nCourseMasterid' => $data["aCourseMasterID"],
					'nCourseModeID' => $data["mode"],
					'nInstituteID' 		=> $aInstituteID,
					'tBatchEnrolmentFees' => $amount,
					'tdiscountcuponcode' 		=> $ccode,
					'ndiscount' 		=> $discount,
					'nProgramid' 		=> $data["nProgramid"],
					'nbatchstatus' 		=> 1,
					'ntype' 		=> $data["types"],
					'dCourseCreatedAt' 		=> date("Y-m-d H:i:s"),
					'ntrainer_usrid' 		=> $data["trainer_userid"]
				]);	
	
		if($result){
			//$batch_id = DB::getPdo()->lastInsertId();
			$response['status'] = 'success';
			$response['course_id'] = (int) $data["aCourseMasterID"];
			$response['msg'] = '<span style="color:green">Batch created Successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Something Went Wrong. Please try later</span>';
		}
		print_r(json_encode($response));
	}	


	public function getCategory(){
		$id_sector = Input::get("id_sector");
		$categories = DB::table('tblcourseaspintcategory')
						->where('nSectorid', $id_sector)
						->where('status',1)
						->orderby('orders')
						->get();
		$html = '';
		if($categories){
			$html .= '<option value="">Select</option>';
			foreach($categories as $cat){
			$html .= '<option value="'.$cat->aAspIntCatID.'">'.$cat->tAspIntCategory.'</option>';
			}
		}else{
			$html .= '<option value="">--No Categories Available--</option>';
		}

		return $html;
	}
        
    public function courseList(){
        $requests = Request::all();
        
        if(isset($requests['location'])){
            Session::put('search_location', $requests['location']);
            $location = $requests['location'];
        } elseif(Session::has('search_location')) {
            $location = Session::get('search_location');
        } else {
            $location = '';
        }
        
        if(isset($requests['keyword'])){
            Session::put('search_keyword', $requests['keyword']);
            $keyword = $requests['keyword'];
        } elseif(Session::has('search_keyword')){
            $keyword = Session::get('search_keyword');
        } else{
            $keyword = '';
        }
        
        //if(isset($requests['location'])):  $location = Session::get('search_location'); else: $location = ''; endif;
        //if(isset($requests['keyword'])): Session::put('search_keyword', $requests['keyword']); $keyword = Session::get('search_keyword'); else: $keyword = ''; endif;
        if(isset($requests['sector_id'])): $sector_id = $requests['sector_id']; else: $sector_id = ''; endif;        
        if(isset($requests['category_id'])): $id_category = $requests['category_id']; else: $id_category = ''; endif;
        if(isset($requests['interest_id'])): $interest_id = $requests['interest_id']; else: $interest_id = ''; endif;
        $googleLocation = $this->getGoolgeLatLong($location);
        $batch = $this->getCourses($googleLocation, $keyword, $id_category, $sector_id);

        // Sectors
        $sectors = CourseSector::all();

        // Category
        if(isset($requests['sector_id'])){
            $category = Coursecategory::where('nSectorid' ,'=' ,$requests['sector_id'])->get();
        } else {
            $category = '';
        }
        
        // Aspiration Interests / Job
        if(isset($requests['category_id'])){
            $interests = Asinpirationinterests::where('naspintcatid' ,'=' ,$requests['category_id'])->get();
        } else {
            $interests = '';
        }
        
        $breadcrumb = $this->createBreadcrumb(array('sector'=>$sector_id,'category'=>$id_category,'interest'=>$interest_id));

        $data = array(
            'batch' => $batch,
            'sectors' => $sectors,
            'categories' => $category,
            'interests' => $interests,
            'requests' => $requests,
            'breadcrumbs' => $breadcrumb,
            'total' => count($batch)
        );
        return view('course-catalogue')->with($data);
    }
    
    
    public function createBreadcrumb($links){
        $html = '<li><a href="/">Home</a></li>';
        if($links['sector']){
            $html .= '<li><a href="/course/list">Courses</a></li>';
        } else {
            $html .= '<li>Courses</li>';
        }
        
        foreach($links as $key => $value) {
            if($key == 'sector' && $value) {
                $sector = CourseSector::find($value);
                $html .= '<li>'.$sector->tSectorName.'</li>';
            }
            
            if($key == 'category' && $value) {
                $category = Coursecategory::find($value);
                $html .= '<li>'.$category->tAspIntCategory.'</li>';
            }
            
            if($key == 'interest' && $value) {
                $interest = Asinpirationinterests::find($value);
                $html .= '<li class="primary-color">'.$interest->tAspirationinterest.'</li>';
            }
        }
        return $html;
    }
    
    public function isTrainerExists(){
        $requests = $data = Input::all();
        if($requests['email']){
            
            $trainer = DB::table('tblusermaster')->where('tblusermaster.tUsrEmail', $requests['email'])->first();
            
            if($trainer){
                $trainer_affiliation = DB::table('tbltakinstituteaffiliation')
                    ->where('nTrainerID', $trainer->ausrid)
                    ->first(); 
                if(isset($trainer_affiliation->naffiliationstatus) && $trainer_affiliation->naffiliationstatus === 1){
                    echo 'true';
                } else if(isset($trainer_affiliation->naffiliationstatus) && $trainer_affiliation->naffiliationstatus === 2){
                    echo json_encode('The input trainer is not verified by Buddhijeevi. Please contact Buddhijeevi support');
                } else {
                    echo json_encode('The input trainer is not verified by Buddhijeevi. Please contact Buddhijeevi support');
                }                
            } else {
                echo json_encode('Provided email does not belongs to any trainer');
            }
            
//            if($active_trainer){
//                echo 'true';
//            } else if($expired_trainer && !$active_trainer){
//                echo json_encode('Provided trainer is under admin approval');
//            } else {
//                echo json_encode('Provided email does not belong to any trainer');
//            }       
        }
    }
    
    public function getTrainerInfo() {
        $data = Input::all();
        $trainer = DB::table('tblusermaster')->where('tUsrEmail', $data['email'])->where('nUsrRoleID', 1003)->first();
        $response = array();
        if( $trainer != NULL ){
            $response['trainer_userid'] = $trainer->ausrid;
            $response['trainer_fname'] = $trainer->tUsrFName;
            $response['trainer_lname'] = $trainer->tUsrLName;			
        }
        print_r(json_encode($response));
    }
    
    public function addRating() {
        $data = Input::all();  
        $response = array();
        $existing_rating = DB::table('tbl_rating')
            ->where('nusrid', Auth::user()->ausrid)
            ->where('nCourseID', $data['nCourseID'])
            ->first(); 
        
        if(!isset($existing_rating)){
            DB::table('tbl_rating')->insert([
                'nusrid'           => Auth::user()->ausrid,
                'rating'            => $data['rating'],
                'nCourseID'          => $data['nCourseID'],
                'ratingSummary'     => $data['ratingComment']
            ]);
            if( DB::getPdo()->lastInsertId() ) {
                $response['message'] = "Feedback added successfully";
                $response['status'] = 'success';
            }
        } elseif(isset($existing_rating)) {
            $response['message'] = "Sorry !! You already gave feedback to this course !!";
            $response['status'] = 'failed';
        }
        print_r(json_encode($response));
    } 


public function referCandidate() {
		
		$response = array();
		$data = Input::all();
		$data['role'] = 1004;
		$data['password'] = str_random(8);
		$response = app('App\Http\Controllers\AccountController')->userRegistration($data);
		
		if( isset($response['status']) && $response['status'] == 'success' ){
			 DB::table('tblstudentreferral')->insert([
                'nreferralusrid'           => Auth::user()->ausrid,
                'nStudentID'            => $response['user_id']
            ]);
			if(!empty($data['aadhar'])){
				DB::table('tbluserinstidinfo')->insert([
                'nUsrID'           => $response['user_id'],
                'tIDValue'            => $data['aadhar'],
                'nIDMaster'            => 2
            ]);
			}
			
				
			DB::table('tblusermaster')->where('ausrid', $response['user_id'])->update([
						'tUsrFather-GuardianFName'	=> $data['father_name'],
						'tUsrBldName_StName_Add1'	=> $data['address'],
						'tUsrDoB'	=> date("Y-m-d", strtotime($data['dob'])),
						'tUsrgender'	=> $data['gender'],
						'nCaste'	=> $data['caste']
					]);	
			
		$result = DB::table('tblstudentcourseenquiry')
		->insert(array(
		'nUserid' => $response['user_id'],
		'nReferredby' => Auth::user()->ausrid,
		'created_at' =>date("Y-m-d H:i:s"),
		 'nMobileNumber' => $data["phone"],
		'nScheduleDate' => NULL,
		'nScheduleTime' => NULL,
		// 'nScheduleDate' => date("Y-m-d", strtotime($data["cDate"])),
		// 'nScheduleTime' => date("H:i:s", strtotime($data["cTime"])),
		'nBatchid' => $data["nBatchid"],
		'tEnquiryType' => 'Community Referral',
		'tEnquiryComment' => ''
		));		
		
		
		
			$response['msg'] = 'Success';
		}		
		print_r(json_encode($response)); die;
		
		
        
    }
public function enrollCandidate() {
		
		$response = array();
		$data = Input::all();
		$user = DB::table('tblusermaster')
            ->where('tUsrEmail', $data['email'])
            ->get(); 
		if( count($user) == 0 ){
			$data['role'] = 1004;
			$data['password'] = str_random(8);
			$response = app('App\Http\Controllers\AccountController')->userRegistration($data);			
		}elseif(count($user) >=1 ){
			$response['status'] = 'success';
			$response['user_id'] = $user[0]->ausrid;
		}
		if(isset($response['user_id'])){
			$existing_data = DB::table('tblstudentenrollment')
            ->where('nstudentid', $response['user_id'])
            ->where('nbatchid', $data['nBatchid'])
            ->get(); 
			if( count($existing_data) >= 1){
				$response['status'] = 'failed';
				$response['msg'] = 'Failed. Duplicate entry for this student';
			}
		}
		
		if( isset($response['status']) && $response['status'] == 'success' ){
			 // DB::table('tblstudentreferral')->insert([
                // 'nreferralusrid'           => Auth::user()->ausrid,
                // 'nStudentID'            => $response['user_id']
            // ]);
			if(!empty($data['aadhar'])){
				DB::table('tbluserinstidinfo')->insert([
                'nUsrID'           => $response['user_id'],
                'tIDValue'            => $data['aadhar'],
                'nIDMaster'            => 2
            ]);
			}				
			DB::table('tblusermaster')->where('ausrid', $response['user_id'])->update([
						'tUsrFather-GuardianFName'	=> $data['father_name'],
						'tUsrBldName_StName_Add1'	=> $data['address'],
						'tUsrDoB'	=> date("Y-m-d", strtotime($data['dob'])),
						'tUsrgender'	=> $data['gender'],
						'nCaste'	=> $data['caste']
					]);	
				 $tblstudentenrollment = DB::table('tblstudentenrollment')->get(); 
			DB::table('tblstudentenrollment')->insert([
						'nstudentid'	=> $response['user_id'],
						'nbatchid'	=> $data['nBatchid'],
						'nenrolldate'	=> date("Y-m-d"),
						'tinvoicenumber'	=> count($tblstudentenrollment) + 1,
						'tinvoiceamount'	=> $data['invoice_amount'],
						'tinvoicedate'	=> date("Y-m-d", strtotime($data['invoice_date']))
					]);	
			
		// $result = DB::table('tblstudentcourseenquiry')
		// ->insert(array(
		// 'nUserid' => Auth::user()->ausrid,
		// 'created_at' =>date("Y-m-d H:i:s"),
		 // 'nMobileNumber' => $data["phone"],
		// 'nScheduleDate' => NULL,
		// 'nScheduleTime' => NULL,
		//// 'nScheduleDate' => date("Y-m-d", strtotime($data["cDate"])),
		//// 'nScheduleTime' => date("H:i:s", strtotime($data["cTime"])),
		// 'nBatchid' => $data["nBatchid"],
		// 'tEnquiryType' => 'Community Referral',
		// 'tEnquiryComment' => ''
		// ));		
		
		
		
			$response['msg'] = 'Success';
		}		
		print_r(json_encode($response)); die;
		
		
        
    }
}