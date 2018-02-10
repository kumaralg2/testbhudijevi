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

class AccountController extends Controller {
	
	public function __construct()
	{
		
	}	
	public function index() { 
		$user = DB::table('tblusermaster')
				->leftJoin('tblinstitutemaster', 'tblusermaster.ausrid', '=', 'tblinstitutemaster.nInstituteMgrIncharge')
				->where('tblusermaster.ausrid', Auth::user()->ausrid)->first();	
		return view('account.profile')->with('user', $user);
		
	}	
	public function editProfilePage()
	{
		$customer = DB::table('customer')->where('id_customer', Auth::user()->id_customer)->first();	
		return view('account.edit-profile')->with('customer', $customer);
	}
	public function getTrainerInfo($userid)
	{
		$user = DB::table('tblusermaster')->where('ausrid', $userid)->first();	
		return $user;
	}	
	public function editProfile()
	{
		$data = Input::all();
		$customer_info = DB::table('customer')
				->where('tUsrEmail', $data["email"])
				->where('id_customer', '!=', Auth::user()->id_customer)
				->first();
		if(count($customer_info) == NULL):
			$result = DB::table('customer')->where('id_customer', Auth::user()->id_customer)->update([
						'screen_name'	=> $data["name"],
						'tUsrEmail' 	  	=> $data["email"],
						'updated_at' => date('Y-m-d H:i:s')
					]);	
		if($result){
			return Redirect::route('EditProfile')
						->with('status',  'updated successfully')
						->withInput();
		}else{
			return Redirect::route('EditProfile')
						->with('errormsg',  'Something went wrong. Please contact admin')
						->withInput();
		}
		else:
			return Redirect::route('EditProfile')
						->with('errormsg',  'eMail already presented')
						->withInput();
		endif;
	}	
	public function UpdateProfile()
	{
		$data = Input::all(); 
		$response = array();
		$email_availability = DB::table('tblusermaster')->where('tUsrEmail', $data["tsEmail"])->where('ausrid', '!=', Auth::user()->ausrid)->first();
		$phone_availability = DB::table('tblusermaster')->where('tUsrMobileNumber', $data["mobile"])->where('ausrid', '!=', Auth::user()->ausrid)->first();
		$error_msg = '';
		if( count($phone_availability) > 0 ){
			$error_msg .= '<p><span style="color:red">Mobile number already Registered</span></p>';
		}
		if( count($email_availability) > 0 ){
			$error_msg .= '<p><span style="color:red">eMail already Registered</span></p>';
		}
		if( (count($phone_availability) > 0) || (count($email_availability) > 0) ){
			$response['status'] = 'failed';
			$response['msg'] = $error_msg;
			return $response;die;
		}
		if(isset($data["tsNewsLetter"])){
			$tsNewsLetter = 1;
		}else{
			$tsNewsLetter = 0;
		}
                
		$result = DB::table('tblusermaster')->where('ausrid', Auth::user()->ausrid)->update([
                            'tUsrFName'	=> $data["fName"],
                            'tUsrLName' 	  	=> $data["lName"],
                            'tUsrgender' 	  	=> $data["tsGender"],
                            'tUsrEmail' 	  	=> $data["tsEmail"],
                            'uProfileWriteup' 	=> $data["uProfileWriteup"],
                            'pImageFileName' 	=> $data["image_filename"],
                            'tUsrMobileNumber' 	  	=> $data["mobile"],
                            'nNewsLetterSubscription' 	  	=> $tsNewsLetter,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);	
		if($result){
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Basic information updated successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Something went wrong. Please contact admin</span>';
		}	
		print_r(json_encode($response));
	}	
	public function UpdateProfileAddress()
	{
		$data = Input::all();  
		$response = array();

		$googleData = $this->getLatLong($data['tGoogleLoc']);

		$result = DB::table('tblusermaster')->where('ausrid', Auth::user()->ausrid)->update([
				'tUsrBldName_StName_Add1'	=> $data["tsAddress1"],
				'tUsrAve_Blvd_Add2' 	  	=> $data["tsAddress2"],
				'tUsrLocation' 	  	=> $data["locationid"],
				'tUsrPinZipCode' 	  	=> $data["pincode"],
				'tGoogleLoc'		=> $data['tGoogleLoc'],
				'lat'	=> $googleData['latitude'],
				'lng'	=> $googleData['longitude'],					
				'updated_at' => date('Y-m-d H:i:s')
			]);	
		if($result){
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Address information updated successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Something went wrong. Please contact admin</span>';
		}	
		print_r(json_encode($response));
	}	


	public function changePassword()
	{
		$data = Input::all();
		$response = array();
		if (Hash::check($data["oldpassword"], Auth::user()->password)) {
			$customer = DB::table('tblusermaster')->where('ausrid', Auth::user()->ausrid)->update(array('password' => Hash::make($data["newpassword"])));				
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Password changed successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Current password is wrong</span>';
		}
		print_r(json_encode($response));
	}	
	public function addComment()
	{
		$data = Input::all();
		$response = array();
		$result = DB::table('tblcoursecomment')
		->insert(array('tCourseComment' => $data["tCourseComment"], 
		'nUserid' => Auth::user()->ausrid,
		'ncommenttime' =>date("Y-m-d H:i:s"),
		'nCourseCatalogueid' => $data["nCourseCatalogueid"],
		));				
		if ($result) {
		
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Comment added successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red"></span>';
		}
		print_r(json_encode($response));
	}
	public function addEnquire()
	{
		$data = Input::all(); 
		$response = array();
		$result = DB::table('tblstudentcourseenquiry')
		->insert(array(
		'nUserid' => Auth::user()->ausrid,
		'created_at' =>date("Y-m-d H:i:s"),
		'nMobileNumber' => $data["cMobile"],
		'nScheduleDate' => date("Y-m-d", strtotime($data["cDate"])),
		'nScheduleTime' => date("H:i:s", strtotime($data["cTime"])),
		'nBatchid' => $data["nBatchid"],
		'tEnquiryType' => $data["cRadio"],
		'tEnquiryComment' => $data['tCourseComment']
		));				
		if ($result) {
		
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Thanks for the appointment. A representative will get in touch with you. </span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red"></span>';
		}
		print_r(json_encode($response));
	}
	public function interested($batch_id)
	{		
		$response = array();
		$result = DB::table('tblstudentcourseenquiry')
		->insert(array(
		'nUserid' => Auth::user()->ausrid,
		'created_at' =>date("Y-m-d H:i:s"),
		'nMobileNumber' => Auth::user()->tUsrMobileNumber,
		'nScheduleDate' => date("Y-m-d 12:30:00", strtotime('+1 day')),
		'nScheduleTime' => date("Y-m-d 12:30:00", strtotime('+1 day')),
		'nBatchid' => $batch_id,
		'tEnquiryType' => 'Schedule an appointment',
		'tEnquiryComment' => 'Interested'
		));	
		
		if ($result) {
			return redirect('/course-description/'.$batch_id)->with('message',  'Thanks for the appointment. A representative will get in touch with you.');
		}else{
			return redirect('/course-description/'.$batch_id);
		}
		
	}

	public function addEnrole()
	{ 	
		$data = Input::all(); 
		$response = array();
		$result = DB::table('tblstudentcourseenquiry')
		->insert(array(
		'nUserid' => Auth::user()->ausrid,
		'created_at' =>date("Y-m-d H:i:s"),		
		'nBatchid' => $data["nBatchid"],
		'tEnquiryType' => $data["cRadio"],
		'tEnquiryComment' => $data['tCourseComment']
		));				
		if ($result) {
			 $tblstudentenrollment = DB::table('tblstudentenrollment')->get(); 
			DB::table('tblstudentenrollment')->insert([
						'nstudentid'	=> Auth::user()->ausrid,
						'nbatchid'	=> $data['nBatchid'],
						'nenrolldate'	=> date("Y-m-d"),
						'tinvoicenumber'	=> count($tblstudentenrollment) + 1,
						'tinvoiceamount'	=> $data['invoice_amount'],
						'tinvoicedate'	=> date("Y-m-d")
					]);	
					
		
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Thanks for interest and initiating the Payment. A representative will get in touch to brief you further on the Payment process.</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red"></span>';
		}
		print_r(json_encode($response));
	}



	public function updateTrainerInfo()
	{
		$result = array();
		$data = Input::all();  // print_r($data);die;
		$response = array();
		if( isset($data['tGoogleInsLoc']) ){
			$googleData = $this->getLatLong($data['tGoogleInsLoc']);


		$result = DB::table('tblinstitutemaster')->where('nInstituteMgrIncharge', Auth::user()->ausrid)->update([
				'tInstituteName'	=> $data["tiName"],
				'tInstituteStNameAdd1' 	  	=> $data["insAddress1"],
				'tInstituteAreaBlvdAdd' 	  	=> $data["insAddress2"],
				'tInstitutePINZipCode' 	  	=> $data["inspincode"],
				'tInstituteLoc' 	  	=> $data["inslocationid"],
				'lat'	=> $googleData['latitude'],
				'lng'	=> $googleData['longitude'],
				'tGoogleInsLoc'	=> $data['tGoogleInsLoc']

			]);	
		}
		if(isset($data['affiliates']) ){
			DB::table('tblUsrAffiliates')->where('user_id', Auth::user()->ausrid)->delete();
			$affiliates = explode(';', $data['affiliates']);
			foreach( $affiliates as $key_Cert=>$value_cert ){
				DB::table('tblUsrAffiliates')->insert([
					'name'	=> $value_cert,
					'user_id' 	  	=> Auth::user()->ausrid
				]);
			}
		}
		if(isset($data['uProfileWriteup']) ){
			DB::table('tblinstitutemaster')->where('nInstituteMgrIncharge', Auth::user()->ausrid)->update([
					'uProfileWriteup'	=> $data['uProfileWriteup'],
					'office_open_time'	=>date("H:i:s", strtotime(str_replace(' ','',$data['open_time']))),
					'office_close_time'	=> date("H:i:s", strtotime(str_replace(' ','',$data['close_time']))),
					'trained_students_count'	=> $data['trained_stud']
				]);
		} 
		if( Auth::user()->nUsrRoleID == 1003 ){
			DB::table('tblusermaster')->where('ausrid', Auth::user()->ausrid)->update([
					'service_open_time'	=> date("H:i:s", strtotime(str_replace(' ','',$data['open_time']))),
					'service_close_time'	=> date("H:i:s", strtotime(str_replace(' ','',$data['close_time']))),
					'trained_student_count'	=> $data['trained_stud']
				]);
		}
		//if($result){
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Updated successfully</span>';
		// }else{
			// $response['status'] = 'failed';
			// $response['msg'] = '<span style="color:red">Something went wrong. Please contact admin</span>';
		// }	
		print_r(json_encode($response));
	}

  public function filegetcontent( $url ){        
        
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
	  echo curl_error($ch);
	  echo "\n<br />";
	  $contents = '';
	} else {
	  curl_close($ch);
	}
	
	if (!is_string($contents) || !strlen($contents)) {
	echo "Failed to get contents.";
	$contents = '';
	}
	
	return $contents;
        }

	public function getLatLong($address){
    
	    if(!empty($address)){
	        
	        $formattedAddr = str_replace(' ','+',$address);
	        
	        $geocodeFromAddr = $this->filegetcontent('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false'); 
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


	public function updateUserId()
	{
		$data = Input::all();
		
		$validInputs = $this->validateIdentityTypes($data);
		//print_r($validInputs); die;

		if($validInputs){
			foreach($validInputs as $del_key=>$del_value){			
				if(($key = array_search($del_key, $data['id'])) !== false) {
 					unset($data['id'][$key]);
 					unset($data['val'][$key]);
				}
				
			}
		}

		$filter_data = array_filter($data['id']);

		$response = array();
		for( $i = 0; $i < count($filter_data); $i++ ){
			if(array_key_exists($i, $data['id'])){
				$result = DB::table('tbluserinstidinfo')
						->where('nUsrID', Auth::user()->ausrid)
						->where('nIDMaster', $data["id"][$i])
						->first();
				if( count($result) > 0 ){
					DB::table('tbluserinstidinfo')->where('nUsrID', Auth::user()->ausrid)
												->where('aUserInstIDInfo', $result->aUserInstIDInfo)
													->update(['tIDValue'	=> $data["val"][$i] ]);
				}else{
						if(Auth::user()->nUsrRoleID == 1002){
							$user = DB::table('tblusermaster')
							->join('tblinstitutemaster', 'tblusermaster.ausrid', '=', 'tblinstitutemaster.nInstituteMgrIncharge')
							->where('tblusermaster.ausrid', Auth::user()->ausrid)->first();	
							$nInstituteiD = $user->aInstituteID;
						}else{
							$nInstituteiD = NULL;
						}
					DB::table('tbluserinstidinfo')->insert([
					'nUsrID'	=> Auth::user()->ausrid,
					'nIDMaster' 	  	=> $data["id"][$i],
					'tIDValue' 	  	=> $data["val"][$i],
					'nInstituteiD' 	  	=> $nInstituteiD
				]);
				}	
			}
			
		}

		if($validInputs){
			$response['status'] = 'error';
			$response['msg'] = '<span style="color:red">'.implode(",<br/> ",$validInputs).'</span>';
		}else{
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green"></span>';	
		}		
		
		print_r(json_encode($response));
	}


	public function validateIdentityTypes($data){

		$id = array_filter($data['id']);
		$idImp = "'" . implode("','", $id) . "'";	
		$idValues = array_filter($data['val']);

		$validationRule = array(); 
		$idNames = DB::table('tblidmaster')->whereIn('aIDtype', $id)->get();
				
		foreach($idNames as $ids){
			$validationRule[$ids->aIDtype]['format'] = $ids->tIDFormat;
			$validationRule[$ids->aIDtype]['name'] = $ids->tIDName;
		}
		
		$errorMessage = array();
		foreach($idValues as $key=>$value){
			
			if(isset($id[$key])){
				$ruleFormat = $validationRule[$id[$key]]['format']; 
				$ruleName = $validationRule[$id[$key]]['name']; 
				$value = $idValues[$key];

				$value = preg_replace("/[^0-9]/", "X",$value);
				$value = preg_replace("/[^a-zA-Z]/","N",$value);

				if( (strlen($ruleFormat) != strlen($value)) || ($ruleFormat != $value)){
					$errorMessage[$id[$key]] = "Please enter a valid  ".$ruleName;
				}
			}
		}

		return $errorMessage;

	}




	public function updateEducationInfo()
	{
		$data = Input::all();
		$filter_data = array_filter($data['degree']);
		$response = array();
		for( $i = 0; $i < count($filter_data); $i++ ){
			$ins = DB::table('tblinstitutemaster')
					->where('tInstituteName', $data["insName"][$i])
					->first();
			if( $ins == NULL ){
				DB::table('tblinstitutemaster')->insert([
				'nInstituteTypeID'	=> 6,
				'tInstituteName' 	  	=> $data["insName"][$i]
			]);	
			$nInstitutionMasterID = DB::getPdo()->lastInsertId();	
			}else{
				$nInstitutionMasterID = $ins->aInstituteID;	
			}
			if( isset($data["aUserEduInfo"][$i]) ){
				$result = DB::table('tblusereduinfo')
					->where('nUsrID', Auth::user()->ausrid)
					->where('aUserEduInfo', $data["aUserEduInfo"][$i])
					->first();
						DB::table('tblusereduinfo')->where('nUsrID', Auth::user()->ausrid)
											->where('aUserEduInfo', $result->aUserEduInfo)
												->update([
												'nDegreeid'	=> $data["degree"][$i],
												'nYearofPassing'	=> $data["year_of_passing"][$i],
												'nUsrCGPA'	=> $data["grade"][$i],
												'nInstitutionMasterID'	=> $nInstitutionMasterID,
												]);
			}else{
					
				DB::table('tblusereduinfo')->insert([
				'nUsrID'	=> Auth::user()->ausrid,
				'nYearofPassing' 	  	=> $data["year_of_passing"][$i],
				'nUsrCGPA' 	  	=> $data["grade"][$i],
				'nInstitutionMasterID' 	  	=> $nInstitutionMasterID,
				'nDegreeid' 	  	=> $data["degree"][$i],
			]);	
			}
			
		}		
		$response['status'] = 'success';
		$response['msg'] = '<span style="color:green"></span>';
		print_r(json_encode($response));
	}
	public function updateUserLang()
	{
		$data = Input::all(); //print_r($data);die;
		$filter_data = array_filter($data['langid']);
		$response = array();
		for( $i = 0; $i < count($filter_data); $i++ ){
			$result = DB::table('tbluserlang')
					->where('nuserid', Auth::user()->ausrid)
					->where('nlangid', $data["langid"][$i])
					->first();
			if( count($result) > 0 ){
				if(isset($data["read"][$i])){
					$bread = 1;
				}else{
					$bread = 0;
				}
				if(isset($data["write"][$i])){
					$bwrite = 1;
				}else{
					$bwrite = 0;
				}
				if(isset($data["speak"][$i])){
					$bspeak = 1;
				}else{
					$bspeak = 0;
				}
				DB::table('tbluserlang')->where('nuserid', Auth::user()->ausrid)
											->where('auserlangid', $result->auserlangid)
												->update(['bread'	=> $bread, 'bwrite'	=> $bwrite,'bspeak'	=> $bspeak ]);
			}else{
				if(isset($data["read"][$i])){
					$bread = 1;
				}else{
					$bread = 0;
				}
				if(isset($data["write"][$i])){
					$bwrite = 1;
				}else{
					$bwrite = 0;
				}
				if(isset($data["speak"][$i])){
					$bspeak = 1;
				}else{
					$bspeak = 0;
				}
					
				DB::table('tbluserlang')->insert([
				'nuserid'	=> Auth::user()->ausrid,
				'nlangid' 	  	=> $data["langid"][$i],
				'bread' 	  	=> $bread,
				'bwrite' 	  	=> $bwrite,
				'bspeak' 	  	=> $bspeak
			]);	
			}
			
		} 
		DB::table('tblusrinstskillprof')->where('nusrid', Auth::user()->ausrid)->delete();
		$tSkillDescription = explode(';', $data['skillproficiency']);
		for( $k = 0; $k < count($tSkillDescription); $k++ ){
			$result = DB::table('tblusrinstskillprof')
					->where('nusrid', Auth::user()->ausrid)
					->where('tSkillDescription', $tSkillDescription[$k])
					->first();
			if($result == NULL){
				if(Auth::user()->nUsrRoleID == 1002){ 
						$user = DB::table('tblusermaster')
						->join('tblinstitutemaster', 'tblusermaster.ausrid', '=', 'tblinstitutemaster.nInstituteMgrIncharge')
						->where('tblusermaster.ausrid', Auth::user()->ausrid)->first();	
						$nInstituteiD = $user->aInstituteID;
					}else{
						$nInstituteiD = NULL;
					}
				DB::table('tblusrinstskillprof')->insert([
					'tSkillDescription'	=> $tSkillDescription[$k],
					'nusrid' 	  	=> Auth::user()->ausrid,
					'nInstituteid' 	  	=> $nInstituteiD
				]);
			}
		}
		
		if(isset($data['certifications']) && !empty($data['certifications']) ){
			DB::table('tbl_user_certification')->where('user_id', Auth::user()->ausrid)->delete();
			$certifications = explode(';', $data['certifications']);
			foreach( $certifications as $key_Cert=>$value_cert ){
				DB::table('tbl_user_certification')->insert([
					'certification_name'	=> $value_cert,
					'user_id' 	  	=> Auth::user()->ausrid
				]);
			}
		}
		
		DB::table('tblsectoraffiliation')->where('nuserid', Auth::user()->ausrid)->delete();
		if( isset($data['aff_sectors']) ) {
			for( $as = 0; $as < count($data['aff_sectors']); $as++ ){
				$result = DB::table('tblsectoraffiliation')
						->where('nuserid', Auth::user()->ausrid)
						->where('nsectorid', $data['aff_sectors'][$as])
						->first();
				if($result == NULL){
					if(Auth::user()->nUsrRoleID == 1002){
							$user = DB::table('tblusermaster')
							->join('tblinstitutemaster', 'tblusermaster.ausrid', '=', 'tblinstitutemaster.nInstituteMgrIncharge')
							->where('tblusermaster.ausrid', Auth::user()->ausrid)->first();	
							$nInstituteiD = $user->aInstituteID;
						}else{
							$nInstituteiD = NULL;
						}
					DB::table('tblsectoraffiliation')->insert([
						'nsectorid'	=> $data['aff_sectors'][$as],
						'ninstituteid' 	  	=> $nInstituteiD,
						'nuserid' 	  	=> Auth::user()->ausrid
					]);
				}
			}
		}
		if(Auth::user()->nUsrRoleID == 1002){
			$user = DB::table('tblusermaster')
			->join('tblinstitutemaster', 'tblusermaster.ausrid', '=', 'tblinstitutemaster.nInstituteMgrIncharge')
			->where('tblusermaster.ausrid', Auth::user()->ausrid)->first();	
			$nInstituteiD = $user->aInstituteID;
				// DB::table('tblinstitutemaster')->where('aInstituteID', $nInstituteiD)->update([
					// 'tNSDC_affiliation_cert_no'	=> $data['nsdcNo'],
					// 'nNSDC_affiliation' 	  	=> $data['nsdcYN']
				// ]);
		}
	
		$response['status'] = 'success';
		$response['msg'] = '<span style="color:green">Updated Successfully</span>';
		print_r(json_encode($response));
	}
	public function updateFacilities(){
		$data = Input::all(); 	
		DB::table('tblinstitutefacilities')->where('nUserId', Auth::user()->ausrid)->delete();
		if(isset($data['facility'])) {
		for( $i = 0; $i < count($data['facility']); $i++ ){
			$result = DB::table('tblinstitutefacilities')
					->where('nUserId', Auth::user()->ausrid)
					->where('nFacilityID', $data["facility"][$i])
					->first();
			if( count($result) > 0 ){
				// DB::table('tbluserinstidinfo')->where('nUsrID', Auth::user()->ausrid)
											// ->where('aUserInstIDInfo', $result->aUserInstIDInfo)
												// ->update(['tIDValue'	=> $data["val"][$i] ]);
			}else{
					if(Auth::user()->nUsrRoleID == 1002){
						$user = DB::table('tblusermaster')
						->join('tblinstitutemaster', 'tblusermaster.ausrid', '=', 'tblinstitutemaster.nInstituteMgrIncharge')
						->where('tblusermaster.ausrid', Auth::user()->ausrid)->first();	
						$nInstituteiD = $user->aInstituteID;
					}else{
						$nInstituteiD = NULL;
					}
				DB::table('tblinstitutefacilities')->insert([
				'nFacilityID'	=> $data["facility"][$i],
				'ninstituteid' 	  	=> $nInstituteiD,
				'nUserId' 	  	=>Auth::user()->ausrid
			]);	
			}
		}
		}
		$response['status'] = 'success';
		$response['msg'] = '<span style="color:green"></span>';
		
		
		print_r(json_encode($response));
			
	}
	public function updatePAN(){
		$data = Input::all(); 
		$response = array();
		$result = DB::table('tbluserinstidinfo')->where('nUsrID', Auth::user()->ausrid)
											->where('nIDMaster', 1)->first();
		if($result == NULL){
				DB::table('tbluserinstidinfo')->insert([
				'tIDValue'	=> $data['panNo'],
				'nIDMaster' 	  	=> 1,
				'nUsrID' 	  	=>Auth::user()->ausrid
			]);	
		}else{
				DB::table('tbluserinstidinfo')->where('nUsrID', Auth::user()->ausrid)
											->where('nIDMaster', 1)
												->update(['tIDValue'	=> $data['panNo'] ]);
		}
		$response['status'] = 'success';
		$response['msg'] = '<span style="color:green"></span>';
		print_r(json_encode($response));
			
	}
	
	public function updateExperience(){
		$data = Input::all(); 
		$response = array();
		
			DB::table('tbluserworkexp')->where('nUsrID', Auth::user()->ausrid)->delete();
			for( $i=0; $i<count($data['exp_from']); $i++ ){
			if(isset($data['exp_ins'][$i]) && !empty($data['exp_ins'][$i]) ){				
				DB::table('tbluserworkexp')->insert([
					'tUsrWorkExpSector'	=> $data['exp_sector'][$i],
					'tUsrWorkExpDesignation' 	  	=> $data['exp_designation'][$i],
					'tUsrExpFrom' 	  	=>date("Y-m-d", strtotime(str_replace("/","-",$data['exp_from'][$i]))),
					'tUsrExpTo' 	  	=>date("Y-m-d", strtotime(str_replace("/","-",$data['exp_to'][$i]))),
					'tUsrExpInstitution' 	  	=>$data['exp_ins'][$i],
					'nUsrID' 	  	=>Auth::user()->ausrid
				]);	
			}
			}
		
		$response['status'] = 'success';
		$response['msg'] = '<span style="color:green">Updated Successfully</span>';
		print_r(json_encode($response));
		
		// 
		// $result = DB::table('tbluserinstidinfo')->where('nUsrID', Auth::user()->ausrid)
											// ->where('nIDMaster', 1)->first();
		// if($result == NULL){
				// DB::table('tbluserinstidinfo')->insert([
				// 'tIDValue'	=> $data['panNo'],
				// 'nIDMaster' 	  	=> 1,
				// 'nUsrID' 	  	=>Auth::user()->ausrid
			// ]);	
		// }else{
				// DB::table('tbluserinstidinfo')->where('nUsrID', Auth::user()->ausrid)
											// ->where('nIDMaster', 1)
												// ->update(['tIDValue'	=> $data['panNo'] ]);
		// }
		// $response['status'] = 'success';
		// $response['msg'] = '<span style="color:green"></span>';
		// print_r(json_encode($response));
			
	}
	public function updateClassroom(){
		$data = Input::all();  
		$response = array();
		
			DB::table('tblUsrClassRoom')->where('user_id', Auth::user()->ausrid)->delete();
			for( $i=0; $i<count($data['classroom_name']); $i++ ){
			if(isset($data['classroom_name'][$i]) && !empty($data['classroom_name'][$i]) ){				
				DB::table('tblUsrClassRoom')->insert([
					'classroom_name'	=> $data['classroom_name'][$i],
					'classroom_type' 	  	=> $data['classroom_type'][$i],
					'classroom_capacity' 	  	=>$data['teaching_capacity'][$i],
					'user_id' 	  	=>Auth::user()->ausrid
				]);	
			}
			}
		
		$response['status'] = 'success';
		$response['msg'] = '<span style="color:green">Updated Successfully</span>';
		print_r(json_encode($response));
		
		
	}
	public function forgotPassword()
	{
		
		$email = Request::input('email');
		$response = array();
		$customer_info = DB::table('tblusermaster')->where('tUsrEmail', $email)->first();
		if($customer_info != NULL){
			$token = '';
			do {
				$token	= str_random(60);
				$token_info = DB::table('tblusermaster')->where('token', $token)->first();
				
			} while ($token_info != NULL);
			//DB::table('_forgot_pwd')->insert(array('id_customer' => $customer_info->id_customer,'old_password' =>$customer_info->password, 'created_at' =>date("Y-m-d H:i:s")));
			DB::table('tblusermaster')->where('tUsrEmail', $email)->update(array('token' => $token,'token_created_at' =>date("Y-m-d H:i:s")));
				$emailcontent = array (
				'name' => $customer_info->tUsrFName,
				'token' => $token
			);
			Mail::send('emails.forgot-password', $emailcontent, function($message) use ($email)
			{
				$message->to($email)->subject('Password Reset Link from BuddhiJeevi.com');
			});
			
			$response['status'] = 'success';
			$response['msg'] = 'We have sent you an E-mail containing a link to reset your password. Kindly check your E-mail now.';
			
		}else{
			$response['status'] = 'success';
			$response['msg'] = $email.' is not registered with us';
		}
		print_r(json_encode($response));
	}	


	public function resetPassword()
	{
		$data = Input::all();
		$validator = Validator::make(Input::all(), 
			array(
				'password'		=> 'required|min:6|confirmed',
				'password_confirmation'		=> 'required|min:6'
			)
		);		
		if($validator->fails()) {
			return Redirect('/account/reset-password/'.$data['token'])
					->withErrors($validator);
		} else{
			$customer_info = DB::table('tblusermaster')->where('token', $data['token'])->first();			
			if($customer_info != NULL){	
				$token_created_at = strtotime($customer_info->token_created_at);
				$token_expiry_at = $token_created_at+(60*120);				
				if(strtotime("now") < $token_expiry_at){
					DB::table('tblusermaster')->where('token', $data['token'])->update(array('token' => '','token_created_at' => NULL, 'password' => Hash::make($data["password"])));
					
					return Redirect::route('UserLogin')
						->with('status', 'Password changed successfully. Please login below');
				}else{  
					return Redirect::route('Home');
				}
			}else{
				return Redirect::route('Home');
			}
		}
		
	}	
	public function userRegistration($data, $ref_by="")
	{
		$response = array();
		$customer_info = DB::table('tblusermaster')->where('tUsrEmail', $data["email"])->first();
		$customer_inf = DB::table('tblusermaster')->where('tUsrMobileNumber', $data["phone"])->first();
		$error_msg = '';
		if( count($customer_inf) > 0 ){
			$error_msg .= '<p>Mobile number already presented</p>';
		}
		if( count($customer_info) > 0 ){
			$error_msg .= '<p>eMail already presented</p>';
		}
		if( (count($customer_inf) > 0) || (count($customer_info) > 0) ){
			$response['status'] = 'failed';
			$response['msg'] = $error_msg;
			return $response;die;
		}
		if(count($customer_info) == NULL):
			$token = '';
			do {
				$token	= str_random(60);
				$token_info = DB::table('tblusermaster')->where('email_verification_token', $token)->first();
				
			} while ($token_info != NULL);
			$result = DB::table('tblusermaster')->insert([
						'tUsrFName'	=> $data["ufName"],
						'tUsrLName'	=> $data["ulName"],
						'tUsrMobileNumber'	=> $data["phone"],
						'nUsrRoleID'	=> $data["role"],
						'tUsrEmail' 	  	=> $data["email"],
						'email_verification_token' => $token,
						'password' 		=> Hash::make($data["password"]),
						'dUsrcreateddt' => date('Y-m-d H:i:s'),
						'status' 		=> 0
					]);	
			$response['user_id'] = 	DB::getPdo()->lastInsertId();	
		if($result){
			
			$emailcontent = array (
				'name' => $data["ufName"],
				'token' => $token,
				'ref_by' => $ref_by,
				'role' => $data["role"]
				);
			$email = $data["email"];
			try {
			  			Mail::send('emails.customer-registration', $emailcontent, function($message) use ($email)
				{
					$message->to($email)->subject('Thank you for signing up with BuddhiJeevi.com');
				});
			}
			catch (\Exception $e) {
				
			}

			
			$response['status'] = 'success';
			$response['redirect_url'] = '/signup-thankyou'; 
			return $response;
		}else{
			$response['status'] = 'failed';
			$response['msg'] = 'Something went wrong. Please contact admin';
			return $response;
		}
		else:
			$response['status'] = 'failed';
			$response['msg'] = 'eMail already presented';
			return $response;
		endif;
		
	}
	
	public function customerLogin()
	{
		$email = Request::input('email');
		$password = Request::input('password'); 
		$redirect_url = Request::input('redirect_url'); 
		$remember = (Input::has('remember')) ? true : false;	
		if($remember){
			Cookie::queue('email', $email); 
		}else{
			Cookie::queue(Cookie::forget('email'));
		}			
		$result =  $this->postLogin($email, $password, $remember, $redirect_url);	
		//print_r(json_encode($result));
		return json_encode($result);
	}	
	public function iRegistration()
	{
		$data = Input::all();
		$data['role'] = 1002;
		$response = $this->userRegistration($data); 
		if($response['status'] == 'success'){
			$result = DB::table('tblinstitutemaster')->insert([
						'tInstituteName'	=> $data["iName"],
						'nInstituteMgrIncharge'	=> $response["user_id"],
						'nInstituteTypeID'	=> $data["nInstituteTypeID"]
					]);	
		}
		print_r(json_encode($response)); 
	}	
	public function tRegistration()
	{
		$data = Input::all();
		$data['role'] = 1003;
		$response = $this->userRegistration($data);
		print_r(json_encode($response)); 
	}	
	public function sRegistration()
	{
		$data = Input::all();
		$data['role'] = 1004;
		$response = $this->userRegistration($data);
		print_r(json_encode($response)); 
	}	
	public function getDistrict()
	{
		$data = Input::all(); 
		$dist = DB::table('tbllocationmaster')->where('tState_County', $data['state'])->groupBy('tDistrict')->get();
		$html = '';
		foreach($dist as $dist){
			$html .= '<option value="'.$dist->aLocationID.'">'.$dist->tDistrict.'</option>';
		}
		return $html;
	}	
	public function sendFeedBackMail()
	{
		$data = Input::all();

		$response = array();
                
                // validate the user-entered Captcha code when the form is submitted
                $code = $data['CaptchaCode'];
                $isHuman = captcha_validate($code);
                
                if($isHuman){
                    $result = DB::table('tblfeedback')
                            ->insert([
                                'tContactFName' => $data['name'],
                                'tContactEmail' => $data['email'],
                                'tContactMobile' => $data['phone'],
                                'nRequestID' => $data['requestType'],
                                'tMessage' => $data['messages'],
                                'dRequestDateTime' => date("Y-m-d H:i:s")								
                                ]);
                    if($result){
                            $email = 'support@buddhijeevi.com';	
                            $send_mail = Mail::send(
                                'emails.send-feedback',
                                $data, 
                                function($message) use ($email)
                                {   
                                    $feedback_type = DB::table('tblrequesttype')->where('aRequestID',Request::input('requestType'))->first();
                                    $message->to($email)->subject('SR No : '.'- Type : '.$feedback_type->tRequestType);
                                }
                            );
                            if($send_mail){
                                Session::flash('message', 'Thanks for your feedback. We will contact you shortly'); 
                                Session::flash('alert-class', 'alert-success');
//                                $response['status'] = 'success';
//                                $response['msg'] = 'Thanks for your feedback. We will contact you shortly';
                            }else{
                                Session::flash('message', 'Something went wrong. Please try later'); 
                                Session::flash('alert-class', 'alert-danger'); 
//                                $response['status'] = 'failed';
//                                $response['msg'] = 'Something went wrong. Please try later';
                            }
                    } else {
                        Session::flash('message', 'Something went wrong. Please try later'); 
                        Session::flash('alert-class', 'alert-danger'); 
//                            $response['status'] = 'failed';
//                            $response['msg'] = 'Something went wrong. Please try later';
                    }
                } else {
                    Session::flash('message', 'Wrong captcha entered'); 
                    Session::flash('alert-class', 'alert-danger'); 
//                    $response['status'] = 'failed';
//                    $response['msg'] = 'Wrong captcha entered';
                }
		
                if(isset($result)){
                    return redirect('contact_us');
                } else {
                    return redirect('contact_us')->withInput();
                }
	
	}
	public function postLogin($email, $password, $remember, $redirect_url="")
	{
		$response = array();
		$admin = DB::table('tblusermaster')->where('tUsrEmail', $email)->where('status', 1)->first();
		if($admin != NULL){				
		$dataAttempt = array(
					'tUsrEmail' => $email,
					'password' => $password,
					'status' => 1
				); 
		$auth = Auth::attempt($dataAttempt, $remember);
		if (Auth::check())
			 {					
				$user_agent	= json_encode(Request::server('HTTP_USER_AGENT'));
				$ip_address		= Request::getClientIp(); 
				DB::table('tbltakshashila_login_history')->insert([
					'id_user' 		=> Auth::user()->ausrid,
					'id_role' 		=> Auth::user()->nUsrRoleID,
					'login_datetime' 	=> date('Y-m-d H:i:s'),
					'ip_address' 		=> $ip_address,
					'user_agent' 		=> $user_agent
				]);					
				$id_login_history = DB::getPdo()->lastInsertId();					
				Session::put('id_login_history', $id_login_history); 
				if( $redirect_url == 'reload'){
					$response['redirect_url'] = '/course/list/';
				}else{
					if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ||  ( Auth::user()->nUsrRoleID == 1006 )){
						$response['redirect_url'] = '/account/profile/';
					}else if( ( Auth::user()->nUsrRoleID == 1001 ) ){
						$response['redirect_url'] = '/admin/users-login-history/';
					}else{
						$response['redirect_url'] = '/';
					}
				}
				
				$response['status'] = 'success';
				$response['msg'] = '<span style="color:green">Login Successful</span>';
			} else {
				$response['status'] = 'failed';
				$response['msg'] = '<span style="color:red">Login failed - Please try again.</span>';
			}
		}else{
			$admin = DB::table('tblusermaster')->where('tUsrEmail', $email)->where('status', 0)->first();
			if($admin != NULL){
				$response['status'] = 'failed';
				$response['msg'] = '<span style="color:red">Please verify your email....</span>';
			}else{
				$response['status'] = 'failed';
				$response['msg'] = '<span style="color:red">Login failed - Please try again.</span>';
			}
			
		}	
		return $response;
	}
	public function customerLogout()
	{
		Auth::logout();
		$current_datetime = date('Y-m-d H:i:s');
		DB::table('tbltakshashila_login_history')
						->where('id_login_history', Session::get('id_login_history'))
						->update(['logout_datetime' => $current_datetime]);		
		Session::flush();
		return Redirect::route('Home');	
	}



	public function signupThankyou(){
		return view('account.signup-thankyou');
	}

	public function addsubscribe()
	{
		$data = Input::all();
		$response = array();

		$table = DB::table('tblsubscription')->where('email','=',$data['user_email'])->first();

		if ($table === null) {

			$result = DB::table('tblsubscription')
				->insert(array(
					'userType' => $data['user_type'],
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'email' => $data['user_email'],
					'mobile' => $data['user_mobile'],
				));				
			if ($result) {		
				$response['status'] = 'success';
				$response['msg'] = '<span style="color:green">Thanks for your subscription with Buddhijeevi. A representative will get in touch with you. </span>';
			}else{
				$response['status'] = 'failed';
				$response['msg'] = '<span style="color:red">Erorr in saving your subscription. Try again.</span>';
			}
			
		} else {
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Provided email already subscribed with us.</span>';
		}
		print_r(json_encode($response));
	}
	function getExperience($dates){ 
		$month_count = 0;
		 foreach( $dates  as $date ){
		  if( date("Y",strtotime($date->tUsrExpFrom)) != 1970 ){
			  
			   $exp = array();
			   $date1 = $date->tUsrExpFrom;
			   $date2 = $date->tUsrExpTo;
			   if( date("Y",strtotime($date->tUsrExpTo)) == 1970 ){
				$date2 = date("Y-m-d");
			   }  
			   $ts1 = strtotime($date1);
			   $ts2 = strtotime($date2);
			   $year1 = date('Y', $ts1);
			   $year2 = date('Y', $ts2);
			   $month1 = date('m', $ts1);
			   $month2 = date('m', $ts2);
			   $day1 = date('d', $ts1);
			   $day2 = date('d', $ts2);
			   $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
			   $month_count = $month_count + $diff;		  
			   // echo 'day'. $day = $day2 - $day1;
			   // echo '<br>'; die;
		  }
		 }
		 $year = $month_count / 12;
		 $year = floor($year);
		 $month = $month_count % 12;
		 $result = $year . ' Years and ' . $month . ' Months';
		 return $result;
	}
	public function viewTrainerProfile($ausrid){		
		
		$tblusermaster = DB::table('tblusermaster')
				->where('ausrid', $ausrid)	
				->where('nUsrRoleID', 1003)->first();	
		if( isset($tblusermaster) && !empty($tblusermaster) ){
			$skill = DB::table('tblusrinstskillprof')
				->where('nusrid', $ausrid)->get();	
			$my_skills = array();
			foreach( $skill as $key=>$value ){
				$my_skills[] = $value->tSkillDescription;
			}
			$language = DB::table('tbluserlang')
				->join('tbllanguagemaster', 'tbluserlang.nlangid', '=', 'tbllanguagemaster.aCourseLangOptionID')
				->where('tbluserlang.nuserid', $ausrid)->get();	
			$language_all = array();
			foreach( $language as $key=>$value ){
				$language_all[] = $value->tCourseLangName;
			}
			$education = DB::table('tblusereduinfo')
				->join('tblinstitutemaster', 'tblinstitutemaster.aInstituteID', '=', 'tblusereduinfo.nInstitutionMasterID')
				->join('tbldegreemaster', 'tbldegreemaster.aDegreeID', '=', 'tblusereduinfo.nDegreeid')
				->where('tblusereduinfo.nUsrID', $ausrid)
				->orderBy('tblusereduinfo.aUserEduInfo', 'DESC')->first();	
				
			$tbluserworkexp = DB::table('tbluserworkexp')
				//->join('tblinstitutemaster', 'tbluserworkexp.tUsrExpInstitutionid', '=', 'tblinstitutemaster.aInstituteID')
				->where('nUsrID', $ausrid)
				->orderBy('tUsrExpFrom', 'DESC')->get();	

			$tbl_user_certification = DB::table('tbl_user_certification')->where('user_id', $ausrid)->get();
			$batch = app('App\Http\Controllers\CourseController')->getCourses($googleLocation="", $keyword="", $id_category="", $sector_id="",$ausrid);	
			
			return view('account.view-trainer-profile')
						->with('skillsets', implode(', ',$my_skills))
						->with('languagesets', implode(', ',$language_all))
						->with('education', $education)
						->with('tblusermaster', $tblusermaster)
						->with('tbluserworkexp', $tbluserworkexp)
						->with('tbl_user_certification', $tbl_user_certification)
						->with('batch', $batch)
						->with('page', "profile")
						->with('total', count($batch))
						->with('exp_count', $this->getExperience($tbluserworkexp));
		}				
			
	
	}
	public function viewStudentProfile($ausrid){		
		
		$tblusermaster = DB::table('tblusermaster')
				->where('ausrid', $ausrid)	
				->where('nUsrRoleID', 1004)->first();	
		if( isset($tblusermaster) && !empty($tblusermaster) ){
			$skill = DB::table('tblusrinstskillprof')
				->where('nusrid', $ausrid)->get();	
			$my_skills = array();
			foreach( $skill as $key=>$value ){
				$my_skills[] = $value->tSkillDescription;
			}
			$language = DB::table('tbluserlang')
				->join('tbllanguagemaster', 'tbluserlang.nlangid', '=', 'tbllanguagemaster.aCourseLangOptionID')
				->where('tbluserlang.nuserid', $ausrid)->get();	
			$language_all = array();
			foreach( $language as $key=>$value ){
				$language_all[] = $value->tCourseLangName;
			}
			$education = DB::table('tblusereduinfo')
				->join('tblinstitutemaster', 'tblinstitutemaster.aInstituteID', '=', 'tblusereduinfo.nInstitutionMasterID')
				->join('tbldegreemaster', 'tbldegreemaster.aDegreeID', '=', 'tblusereduinfo.nDegreeid')
				->where('tblusereduinfo.nUsrID', $ausrid)
				->orderBy('tblusereduinfo.aUserEduInfo', 'DESC')->first();	
				
			$tbluserworkexp = DB::table('tbluserworkexp')
				//->join('tblinstitutemaster', 'tbluserworkexp.tUsrExpInstitutionid', '=', 'tblinstitutemaster.aInstituteID')
				->where('nUsrID', $ausrid)
				->orderBy('tUsrExpFrom', 'DESC')->get();	

			$tbl_user_certification = DB::table('tbl_user_certification')->where('user_id', $ausrid)->get();
			$batch = app('App\Http\Controllers\CourseController')->getCourses($googleLocation="", $keyword="", $id_category="", $sector_id="",$ausrid);	
			
			return view('account.view-trainer-profile')
						->with('skillsets', implode(', ',$my_skills))
						->with('languagesets', implode(', ',$language_all))
						->with('education', $education)
						->with('tblusermaster', $tblusermaster)
						->with('tbluserworkexp', $tbluserworkexp)
						->with('tbl_user_certification', $tbl_user_certification)
						->with('batch', $batch)
						->with('studprofile', "studprofile")
						->with('total', count($batch))
						->with('exp_count', $this->getExperience($tbluserworkexp));
		}				
			
	
	}
	public function viewInstituteProfile($ausrid){ 
	
		$tblusermaster = DB::table('tblusermaster')				
				->where('ausrid', $ausrid)	
				->where('nUsrRoleID', 1002)->first();	
		$tblusraffiliates = DB::table('tblUsrAffiliates')				
				->where('user_id', $ausrid)->get();	
		$tblusrinstskillprof = DB::table('tblusrinstskillprof')				
				->where('nusrid', $ausrid)->get();	
		$tblinstitutefacilities = DB::table('tblinstitutefacilities')
				->join('tbltrainingfacilities', 'tblinstitutefacilities.nFacilityID', '=', 'tbltrainingfacilities.atrainingfacilityid')
				->join('tblinstitutemaster', 'tblinstitutefacilities.ninstituteid', '=', 'tblinstitutemaster.aInstituteID')
				->where('tblinstitutefacilities.nUserId', $ausrid)
				->get(); 
		// $tbltakinstituteaffiliation = DB::table('tbltakinstituteaffiliation')
				// ->join('tbltrainingfacilities', 'tblinstitutefacilities.nFacilityID', '=', 'tbltrainingfacilities.atrainingfacilityid')
				// ->join('tblinstitutemaster', 'tblinstitutefacilities.ninstituteid', '=', 'tblinstitutemaster.aInstituteID')
				// ->where('tblinstitutefacilities.nUserId', $ausrid)
				// ->get(); 
			
		if( isset($tblusermaster) && !empty($tblusermaster) ){		
			$institute = DB::table('tblinstitutemaster')
					->where('nInstituteMgrIncharge', $ausrid)->first();	
				$batch = app('App\Http\Controllers\CourseController')->getCourses($googleLocation="", $keyword="", $id_category="", $sector_id="","",$ausrid);	
			return view('account.view-institute-profile')
								->with('tblusermaster', $tblusermaster)
								->with('tblinstitutefacilities', $tblinstitutefacilities)
								->with('batch', $batch)
								->with('page', "profile")
								->with('tblusraffiliates', $tblusraffiliates)
								->with('tblusrinstskillprof', $tblusrinstskillprof)
						->with('total', count($batch))
								->with('institute', $institute);
		}
		
		
	}





}
