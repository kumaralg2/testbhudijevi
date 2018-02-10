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
		$data = Input::all();  
		$response = array();

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
		if($result){
			$response['status'] = 'success';
			$response['msg'] = '<span style="color:green">Institute information updated successfully</span>';
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Something went wrong. Please contact admin</span>';
		}	
		print_r(json_encode($response));
	}



	public function getLatLong($address){
    
	    if(!empty($address)){
	        
	        $formattedAddr = str_replace(' ','+',$address);
	        
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
		$data = Input::all();
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
		$tSkillDescription = explode(';', $data['summary']);
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
				DB::table('tblinstitutemaster')->where('aInstituteID', $nInstituteiD)->update([
					'tNSDC_affiliation_cert_no'	=> $data['nsdcNo'],
					'nNSDC_affiliation' 	  	=> $data['nsdcYN']
				]);
		}
	
		$response['status'] = 'success';
		$response['msg'] = '<span style="color:green"></span>';
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
			//DB::table('history_forgot_pwd')->insert(array('id_customer' => $customer_info->id_customer,'old_password' =>$customer_info->password, 'created_at' =>date("Y-m-d H:i:s")));
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
	public function userRegistration($data)
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
				'token' => $token
				);
			$email = $data["email"];
			Mail::send('emails.customer-registration', $emailcontent, function($message) use ($email)
			{
				$message->to($email)->subject('Thank you for signing up with BuddhiJeevi.com');
			});
			//return array_merge($response, $this->postLogin($data["email"], $data["password"], 0));
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
		$remember = (Input::has('remember')) ? true : false;	
		if($remember){
			Cookie::queue('email', $email); 
		}else{
			Cookie::queue(Cookie::forget('email'));
		}			
		$result =  $this->postLogin($email, $password, $remember);	
		print_r(json_encode($result));
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
                    return redirect('contact_us')->withInput();
                } else {
                    return redirect('contact_us');
                }
	
	}
	public function postLogin($email, $password, $remember)
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
				if( ( Auth::user()->nUsrRoleID == 1002 ) || ( Auth::user()->nUsrRoleID == 1003 ) ){
					$response['redirect_url'] = '/account/profile/';
				}else if( ( Auth::user()->nUsrRoleID == 1001 ) ){
					$response['redirect_url'] = '/account/profile/';
				}else{
					$response['redirect_url'] = '/';
				}
				$response['status'] = 'success';
				$response['msg'] = '<span style="color:green">Login Successful</span>';
			} else {
				$response['status'] = 'failed';
				$response['msg'] = '<span style="color:red">Login failed - Please try again.</span>';
			}
		}else{
			$response['status'] = 'failed';
			$response['msg'] = '<span style="color:red">Login failed - Please try again.</span>';
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






}
