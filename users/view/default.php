<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/user.php';
require_once 'class/usertype.php';

$userObject 			= new class_user();
$usertypeObject	= new class_usertype();

$usertypeData = $usertypeObject->pairs();
if($usertypeData) { $smarty->assign('usertypeData', $usertypeData); }


if(isset($_GET['action']) && trim($_GET['action']) == 'sendlogin') {
	
	require_once 'class/_comms.php';
	
	$response				= array();
	$response['result']	= true;
	$response['error']	= '';
	$commsObject 		= new class_comms();
	
	if(!isset($_REQUEST['usercode'])) {
		$response['result'] = false;
		$response['error'] 		= 'Please click on a user';
	} else if(trim($_REQUEST['usercode']) == '') {
		$response['result'] = false;
		$response['error'] 		= 'Please click on a user';	
	}
	
	if($response['result'] == true && $response['error'] == '') {
		
		$mentorData = $userObject->mentorLogin(trim($_REQUEST['usercode']));
		
		if($mentorData) {
		
			/* Send email to the user. */												
			$mentorData['category']		= 'mentor-login';			
			$success = $commsObject->sendEmailComm('mailers/user_password.html', $mentorData, 'Mentor login details', array('email' => 'info@say-yes.com', 'name' => 'SA-YES Admin'));	
			
			if(!$success) {
				$response['result']			= false;
				$response['message']	= 'Could not send email, please try again.';	
			} else {
				$commsData = $commsObject->getByCode($success);
				
				if($commsData) {
					$response['link']	= '/comms/comms/details.php?code='.$commsData['_comms_code'];						
				} else {
					$response['result']			= false;
					$response['message']	= 'Could not send email, please try again.';					
				}
			}
		}	else {
			$response['result'] = false;
			$response['error'] 	= 'User does exist.';		
		}
	}
	
	echo json_encode($response);
	die();	
	
}

if((isset($_GET['action']) && trim($_GET['action']) == 'searchusers') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$usercode 		= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : '';
	$type 				= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';

	$where = ' user.user_deleted = 0 ';

	if($usercode != '') {
		$where .= ' and user.user_code = \''.$usercode.'\' ';
	}

	if($type != '') {
		$where .= ' and user.usertype_code = \''.$type.'\' ';
	}

	$userData = $userObject->getAll($where, 'user_name asc');

	if($userData) {
		$response['records'] = $userData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('users/view/default.tpl');

?>