<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/mentorapp.php';
require_once 'class/applicationstatus.php';
require_once 'class/mentorship.php';
require_once 'class/user.php';

$mentorappObject 			= new class_mentorapp();
$applicationstatusObject		= new class_applicationstatus();
$mentorshipObject			= new class_mentorship();
$userObject			= new class_user();

$applicationstatusData = $applicationstatusObject->pairs();
if($applicationstatusData) { $smarty->assign('applicationstatusData', $applicationstatusData); }

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

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

if((isset($_GET['action']) && trim($_GET['action']) == 'deleteapp')) {
	
	$response				= array();
	$response['result'] 	= false;
	$response['message'] 	= '';
	
	$mentorappcode	= isset($_REQUEST['appcode']) && trim($_REQUEST['appcode']) != '' ? trim($_REQUEST['appcode']) : '';
	$program		= trim($_REQUEST['program']);
	
	if($mentorappcode != '' && $program != '') {
		$data = array();
		$data['mentorapp_deleted'] = 1;
		
		/*Update. */
		$where = array();
		$where[] = $mentorappObject->getAdapter()->quoteInto('mentorapp_code = ?', $mentorappcode);
		$where[] = $mentorappObject->getAdapter()->quoteInto('mentorship_code = ?', $program);
		$success = $mentorappObject->update($data, $where);
		$response['result'] 	= true;
		
	} else {
		$response['message'] 	= 'Please select participant.';
	}
	
	echo json_encode($response);
	die();		
}

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmentors') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$usercode 		= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : '';
	$status			= isset($_REQUEST['status']) && trim($_REQUEST['status']) != '' ? trim($_REQUEST['status']) : '';
	$programme			= isset($_REQUEST['programme']) && trim($_REQUEST['programme']) != '' ? trim($_REQUEST['programme']) : '';

	$where = ' mentorapp.mentorapp_deleted = 0 ';

	if($usercode != '') {
		$where .= ' and mentorapp.mentorapp_code = \''.$usercode.'\' ';
	}

	if($programme != '') {
		$where .= ' and mentorapp.mentorship_code = \''.$programme.'\' ';
	}

	
	if($status != '') {
		$where .= ' and mentorapp.applicationstatus_code = \''.$status.'\' ';
	}

	$userData = $mentorappObject->getAll($where, 'mentorapp_name asc');

	if($userData) {
		$response['records'] = $userData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('users/mentorapplications/default.tpl');

?>