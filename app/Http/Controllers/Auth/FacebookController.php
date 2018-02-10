<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Session;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

use App\Models\Fbuser as fbuser;
use App\Models\Userrole as userrole;
use Input;
use DB;
use Hash;
use Auth;
use Request;
use Redirect;

class FacebookController extends Controller{

	
    public function handleFacebookCallback(LaravelFacebookSdk $fb){        

        try {
            $token = $fb->getAccessTokenFromRedirect();
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

    
    
        if (! $token) {        
            $helper = $fb->getRedirectLoginHelper();

            if (! $helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            dd(
                $helper->getError(),
                $helper->getErrorCode(),
                $helper->getErrorReason(),
                $helper->getErrorDescription()
            );
        }

        if (! $token->isLongLived()) {
            
            $oauth_client = $fb->getOAuth2Client();

            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                dd($e->getMessage());
            }
        }

        $fb->setDefaultAccessToken($token);

    
        Session::put('fb_user_access_token', (string) $token);

        
        try {
            $response = $fb->get('/me?fields=id,first_name,last_name,email');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }

        
        $userNode   = $response->getGraphUser();    
        $email      = $userNode->getEmail();
        $first_name = $userNode->getFirstName();
        $last_name  = $userNode->getLastName();
        $id         = $userNode->getId();


        $userRecord = DB::table('tblusermaster')                        
                            ->where('tUsrEmail', $email)->first();

        if($userRecord === null){
            $userType = Session::get('userType');    
            Session::forget('userType');
            $getUsrRoleObj = userrole::where('TUsrRoleName',$userType)->get(); 
            $usrRoleArray = json_decode(json_encode($getUsrRoleObj), True);
            if($usrRoleArray){
                $password = $first_name.$last_name;    
                $userResult = DB::table('tblusermaster')->insert([
                    'tUsrEmail'         => $email,
                    'nUsrRoleID'        => $usrRoleArray[0]['aUsrRoleID'],
                    'tUsrFName'         => $first_name,
                    'tUsrLName'         => $last_name,
                    'dUsrcreateddt'     => date('Y-m-d H:i:s'),
                    'password'          => Hash::make($first_name.$last_name),
                    'fb_user_id'        => $id,
                    'status'            => 1
                ]);

                if($userType == ucwords('training institute manager')){
                    $userId = DB::getPdo()->lastInsertId();
                    if($userId){
                        $result = DB::table('tblinstitutemaster')->insert([
                            'tInstituteName'    => Session::get('instituteName'),
                            'nInstituteMgrIncharge' => $userId,
                            'nInstituteTypeID'  => 1,
                            'tInstitutePhoneNumber' => Session::get('institutePhone')
                        ]); 

                        Session::forget('instituteName');
                        Session::forget('institutePhone');
                    }
                }

            }else{
                abort(403, 'Unauthorized action.');
            }

        }else{
            $userResult = DB::table('tblusermaster')->where('tUsrEmail',$email)->update([
                            'fb_user_id' => $id
                        ]);
        }

        return $this->userLogin($email,$id);
    }


    public function setUserType(){
        $data = Input::all();                
        Session::put('userType', ucwords($data['usertype']));
        if($data['usertype'] == "training institute manager"){
            Session::put('institutePhone', $data['phone']);
            Session::put('instituteName', $data['insname']);    
        }        
        $response['status'] = "success";         
        print_r(json_encode($response));
    }


    public function userLogin($email,$fbUserId){

        $response = array();
        $userObj = DB::table('tblusermaster')
                            ->where('tUsrEmail', '=', $email)
                            ->where('fb_user_id', '=', $fbUserId)->first();
        if($userObj != NULL){     
                            
            $userArray = json_decode(json_encode($userObj), True);
            
            if($userArray){        
                $userId = $userArray['ausrid'];   
                $userRoleId = $userArray['nUsrRoleID'];   
                Auth::loginUsingId($userId);
                if (Auth::check()){ 
                    $user_agent = json_encode(Request::server('HTTP_USER_AGENT'));
                    $ip_address     = Request::getClientIp();
                    DB::table('tbltakshashila_login_history')->insert([
                        'id_user'       => $userId,
                        'id_role'       => $userRoleId,
                        'login_datetime'    => date('Y-m-d H:i:s'),
                        'ip_address'        => $ip_address,
                        'user_agent'        => $user_agent
                    ]);                 
                    $id_login_history = DB::getPdo()->lastInsertId();                   
                    Session::put('id_login_history', $id_login_history);
                    if( ( $userRoleId == 1002 ) || ( $userRoleId == 1003 ) ){
                        $response['redirect_url'] = '/account/profile/';
                    }else if( ( $userRoleId == 1001 ) ){
                        $response['redirect_url'] = '/account/profile/';
                    }else{
                        $response['redirect_url'] = '/';
                    }
                    $response['status'] = 'success';
                    $response['msg'] = '<span style="color:green">Login Successful</span>';
                } else {
                    $response['redirect_url'] = '/account/login';
                    $response['status'] = 'failed';
                    $response['msg'] = '<span style="color:red">Please enter correct password</span>';
                }
            }else{
                $response['redirect_url'] = '/account/login';
                $response['status'] = 'failed';
                $response['msg'] = '<span style="color:red">Login failed - Please try again.</span>';    
            }
        }else{
            $response['redirect_url'] = '/account/login';
            $response['status'] = 'failed';
            $response['msg'] = '<span style="color:red">Login failed - Please try again.</span>';
        }
        return redirect()->to($response['redirect_url']);
    }

	
}