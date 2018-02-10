<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Admin

Route::get('/admin/thastest', ['middleware' => 'auth','as' => 'thastest','uses' => 'AdminController@index']);
Route::get('/admin/latest/activity', ['middleware' => 'auth','as' => 'latestactivity','uses' => 'AdminController@latestActivity']);
Route::get('/admin/users-login-history', ['middleware' => 'auth','as' => 'usersList_login_historys','uses' => 'AdminController@usersLoginHistory']);
Route::get('/admin/users-list', ['middleware' => 'auth','as' => 'usersList','uses' => 'AdminController@usersList']);
Route::get('/admin/institute-list', ['middleware' => 'auth','as' => 'institute-lists','uses' => 'AdminController@instituteList']);
Route::get('/admin/institute-Manager-List', ['middleware' => 'auth','as' => 'institute_Manager_List','uses' => 'AdminController@instituteManagerList']);
Route::get('/admin/course-list', ['middleware' => 'auth','as' => 'courseList','uses' => 'AdminController@courseList']);
Route::post('/admin/affiliate-user-add', ['middleware' => 'auth','as' => 'courseList','uses' => 'AdminController@affiliateRegistration']);



Route::get('/admin/affiliate-user/add', ['middleware' => 'auth','as' => 'affiliateUserAdd','uses' => 'AdminController@affiliateUserAdd']);





Route::get('/admin/grade-master', ['middleware' => 'auth','as' => 'grademaster','uses' => 'AdminController@gradeMaster']);


Route::get('/admin/sector-master', ['middleware' => 'auth','as' => 'sectormaster','uses' => 'AdminController@sectorMaster']);
Route::get('/admin/sector/add', ['middleware' => 'auth','as' => 'addsectormaster','uses' => 'AdminController@addSectorMaster']);
Route::post('/admin/sector/update', ['middleware' => 'auth','as' => 'updatesectormaster','uses' => 'AdminController@sectorMasterUpdate']);
Route::get('/admin/sector/edit/{id}', ['middleware' => 'auth','as' => 'editsectorMaster','uses' => 'AdminController@editSectorMaster']);
Route::get('/admin/sector/delete/{id}', ['middleware' => 'auth','as' => 'deletesectorMaster','uses' => 'AdminController@deleteSectorMaster']);



Route::get('/admin/degree/list', ['middleware' => 'auth','as' => 'degreeMaster','uses' => 'AdminController@degreeMaster']);
Route::get('/admin/degree/add', ['middleware' => 'auth','as' => 'adddegreemaster','uses' => 'AdminController@addDegreeMaster']);
Route::get('/admin/degree/edit/{id}', ['middleware' => 'auth','as' => 'editMaster','uses' => 'AdminController@editDegreeMaster']);
Route::get('/admin/degree/delete/{id}', ['middleware' => 'auth','as' => 'deleteMaster','uses' => 'AdminController@deleteDegreeMaster']);



/*-- --------------- Admin End --------------------*/

Route::get('/', array('as' => 'Home', 'uses' => 'HomeController@index'));

Route::get('/account/login', ['middleware' => 'guest', 'as' => 'UserLogin', function() { return view('account.login'); }]);
Route::post('/account/login', 'AccountController@customerLogin');
Route::get('/account/logout', 'AccountController@customerLogout');

Route::get('/account/view-student-profile/{ausrid}', array( 'as' => 'ViewStudentProfile','uses' => 'AccountController@viewStudentProfile'));
Route::get('/account/view-trainer-profile/{ausrid}', array( 'as' => 'ViewTrainerProfile','uses' => 'AccountController@viewTrainerProfile'));
Route::get('/account/view-institute-profile/{ausrid}', array( 'as' => 'ViewInstituteProfile','uses' => 'AccountController@viewInstituteProfile'));
Route::get('/account/interested/{batch_id}', ['as' => 'interested','uses' => 'AccountController@interested']);




Route::get('/account/registration', ['middleware' => 'guest', 'as' => 'UserRegistration', function(){ return view('account.registration'); }]);   
Route::post('/account/registration', 'AccountController@customerRegistration');

Route::post('/account/update-profile', 'AccountController@UpdateProfile');
Route::post('/account/update-profile-address', 'AccountController@UpdateProfileAddress');

Route::get('/account/profile', array( 'middleware' => 'auth','as' => 'UserProfile','uses' => 'AccountController@index'));

Route::get('/account/forgot-password', array('middleware' => 'guest', 'as' => 'ForgotPassword', function(){ return view('account.forgot-password'); }));

Route::post('/account/forgot-password', 'AccountController@forgotPassword');

Route::get('/account/reset-password/{token}', array('middleware' => 'guest', 'as' => 'RsetPassword', function($token){ 
	
	$customer_info = DB::table('tblusermaster')->where('token', $token)->first();				
	if($customer_info == NULL){  
		echo '<script> alert("Link expired"); </script>';die;
	}
	$token_created_at = strtotime($customer_info->token_created_at);
	$token_expiry_at = $token_created_at+(60*120);
	if((strtotime("now") > $token_expiry_at)){		
		echo '<script> alert("Link expired");</script>';die;
	}
	return view('account.reset-password')->with('token', $token); 
}));

Route::post('/account/reset-password', 'AccountController@resetPassword');
Route::post('/get-district', 'AccountController@getDistrict');
Route::post('/account/update-trainer-info', 'AccountController@updateTrainerInfo');
Route::post('/account/update-useridentity', 'AccountController@updateUserId');
Route::post('/account/update-user-lang', 'AccountController@updateUserLang');
Route::post('/account/update-facilities', 'AccountController@updateFacilities');
Route::post('/account/update-pan', 'AccountController@updatePAN');
Route::post('/account/update-work-exp', 'AccountController@updateExperience');
Route::post('/account/update-classroom', 'AccountController@updateClassroom');

Route::post('/get-governingbody', 'CourseController@getGoverningBody');


Route::get('/account/change-password', array('middleware' => 'auth', 'as' => 'ChanePassword', function(){ return view('account.change-password'); }));

Route::post('/account/change-password', 'AccountController@changePassword');

Route::get('/account/edit-profile', array('middleware' => 'auth', 'as' => 'EditProfile','uses' => 'AccountController@editProfilePage'));

Route::post('/account/edit-profile', 'AccountController@editProfile');

Route::get('/account/email-verification/{token}', ['as' => 'EmailVerification', function($token)
{
	$customer_info = DB::table('tblusermaster')->where('email_verification_token', $token)->first();				
	if($customer_info == NULL){  
		//echo '<script> alert("Link expired"); </script>';//die;
		//redirect('/account/login');
		return redirect('/account/login');
	}else{
		DB::table('tblusermaster')->where('email_verification_token', $token)
					->update(array('email_verification_token'=> '', 'email_verification'=>1,'status'=>'1'));	
		echo "Email Verified Successfully";
		return redirect('/account/login');
		//return view('account.email-verification')->with('token', $token);
	}
}]);

$urls = DB::table('tbltakshashila_url')->where('status', '1')->get(); 
	foreach ($urls as $url) {
		Route::get($url->url_name, array('as' => $url->id_url, 'uses' => $url->controller));
	}
Route::get('/course-catalogue', array('as' => 'CourseCatalog','uses' => 'CourseController@displayCatalog'));

Route::get('/course-description/{batchid}', array('as' => 'coursedes','uses' => 'CourseController@courseDescription'));


Route::get('/export-batchlist/{id_course}', ['middleware' => 'auth', 'uses' => 'CourseController@exportBatchList']);
Route::get('/course-approval/{id_course}', ['middleware' => 'auth', 'uses' => 'CourseController@courseApproval']);


Route::post('/get-location', 'CourseController@getLocation');
Route::post('/account/update-educationinfo', 'AccountController@updateEducationInfo');
Route::post('/account/add-comment', 'AccountController@addComment');
Route::post('/account/add-enquire', 'AccountController@addEnquire');
Route::post('/account/add-enrole', 'AccountController@addEnrole');
Route::post('/store-filter', 'CourseController@storeFilter');
Route::post('/upload-image', 'CourseController@uploadImage');

Route::post('/create-course', 'CourseController@createCourse');
Route::post('/get-trainer', 'CourseController@getTrainer');
Route::post('/get-interest', 'CourseController@getInterest');
Route::post('/get-category', 'CourseController@getCategory');
Route::post('/edit-course', 'CourseController@editCourseConfirm');
Route::post('/account/i-registration', 'AccountController@iRegistration');
Route::post('/account/t-registration', 'AccountController@tRegistration');
Route::post('/account/s-registration', 'AccountController@sRegistration');
Route::post('/send-feedback-mail', 'AccountController@sendFeedBackMail');
Route::get('/signup-thankyou', 'AccountController@signupThankyou');



Route::post('/create-batch', 'CourseController@createBatch');
Route::post('/course/refer-candidate', 'CourseController@referCandidate');
Route::post('/course/enroll-candidate', 'CourseController@enrollCandidate');
Route::post('/close-batch', 'CourseController@closeBatch');
Route::post('/publish-course', 'CourseController@publishCourse');
Route::post('/close-course', 'CourseController@closeCourse');
Route::post('/appove-course', 'CourseController@approveCourse');

Route::get('/trainers-institutes', ['as' => 'TrainersInstitutes', 'uses' => 'CourseController@trainersInstitutesListing']);
Route::get('/course-listing', ['middleware' => 'auth', 'as' => 'CoursListing', 'uses' => 'CourseController@courseListing']);
Route::get('/batch-list/{id_course}', ['middleware' => 'auth', 'as' => 'BatchList', 'uses' => 'CourseController@batchList']);
Route::get('/course-batch-creation', ['middleware' => 'auth', 'as' => 'CourseBatchCreation', 'uses' => 'CourseController@courseBatchCreation']);
Route::get('/edit-course/{id_course}', ['middleware' => 'auth', 'as' => 'EditCourse', 'uses' => 'CourseController@editCourse']);
Route::get('/student-registration', ['middleware' => 'auth', 'as' => 'StudentRegistation', 'uses' => 'CourseController@studentRegistation']);
Route::post('/add-student-registation', ['as' => 'add-student-registation', 'uses' => 'CourseController@addStudentRegistation']);


Route::get('/schedule-new-batch/{batch}', ['middleware' => 'auth', 'as' => 'ScheduleNewBatch', 'uses' => 'CourseController@scheduleNewBatch']);
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('facebook/fblogin', ['as' => 'facebook-login', 'uses' => 'Auth\FacebookController@redirectToFacebook']);
Route::get('facebook/callback', ['as' => 'facebook-callback', 'uses' => 'Auth\FacebookController@handleFacebookCallback']);
Route::get('facebook/deauthorize', ['as' => 'facebook-deauthorize', 'uses' => 'Auth\FacebookController@handleFacebookCallback']);
Route::post('facebook/set-usertype', ['as' => 'facebook-set-usertype', 'uses' => 'Auth\FacebookController@setUserType']);

//Route::get('/about-us','CommonController@displayAboutus');



Route::get('/terms-of-use', function(){	
	return View::make('cms/terms-of-use');
});

Route::get('/about-us',function(){
	return View::make('cms/about-us');
});
Route::get('/privacy-policy', function(){	
	return View::make('cms/privacy-policy');
});

Route::get('/faq', function(){	
	return View::make('cms/faq');
});

Route::get('/contact_us', function(){	
	return View::make('contactus');
});

Route::get('/course/list', array('as' => 'CourseList','uses' => 'CourseController@courseList'));
Route::post('/account/subscribe', 'AccountController@addsubscribe');
Route::post('/is-trainer-exists', 'CourseController@isTrainerExists');
Route::post('/get-trainerinfo', 'CourseController@getTrainerInfo');
Route::post('/course/add-rating', 'CourseController@addRating');
