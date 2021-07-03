<?php
/* Add this on all pages on top. */
set_include_path($_SERVER['DOCUMENT_ROOT'].'/'.PATH_SEPARATOR.$_SERVER['DOCUMENT_ROOT'].'/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/user.php';
require_once 'class/usertype.php';
require_once 'class/mentorship.php';
require_once 'class/_comms.php';

$userObject 			= new class_user();
$usertypeObject		= new class_usertype();
$mentorshipObject	= new class_mentorship();
$commsObject 		= new class_comms();

$usertypeData = $usertypeObject->pairs();
if($usertypeData) { $smarty->assign('usertypeData', $usertypeData); }

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

if(isset($_GET['action']) && trim($_GET['action']) == 'searchusers') {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$usercode 		= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : '';
	$type 				= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';
	$mentorship	= isset($_REQUEST['mentorship']) && trim($_REQUEST['mentorship']) != '' ? trim($_REQUEST['mentorship']) : '';

	$where = ' user.user_deleted = 0 ';

	if($usercode != '') {
		$where .= ' and user.user_code = \''.$usercode.'\' ';
	}

	if($type != '') {
		$where .= ' and user.usertype_code = \''.$type.'\' ';
	}

	if($mentorship != '') {
		$where .= ' and usermentorship.mentorship_code = \''.$mentorship.'\' ';
	}
	
	$userData = $userObject->getAllToAssign($where, 'user_name asc');

	if($userData) {
		$response['records'] = $userData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

if(isset($_GET['action']) && trim($_GET['action']) == 'code_delete') {

	require_once 'class/usermentorship.php';
	
	$response						= array();
	$response['result'] 			= true;
	$response['error'] 			= '';
	$usermentorshipObject	= new class_usermentorship();
	$data								= array();
	
	$users				= array_unique(explode(',',substr(trim($_REQUEST['users']), 1)));
	$mentorship	= trim($_REQUEST['mentorship']);
	
	if(count($users) > 0) {
		for($i = 0; $i < count($users); $i++) {
			
			$usermentorshipData = $usermentorshipObject->getUserMentorship($users[$i], $mentorship);
			
			if(!$usermentorshipData) {
				
				$data = array();
				$data['mentorship_code']	= $mentorship;
				$data['user_code']				= $users[$i];
				
				$usermentorshipObject->insert($data);
			}
		}
	} else {
		$response['result'] 			= false;
		$response['error'] 			= 'No users selected.';
	}
	
	echo json_encode($response);
	die();	
}

if(isset($_GET['action']) && trim($_GET['action']) == 'assignusers') {

	require_once 'class/usermentorship.php';
	
	$response						= array();
	$response['result'] 			= true;
	$response['error'] 			= '';
	$usermentorshipObject	= new class_usermentorship();
	$data								= array();
	
	$users				= array_unique(explode(',',substr(trim($_REQUEST['users']), 1)));
	$mentorship	= trim($_REQUEST['mentorship']);

	if(count($users) > 0) {
		for($i = 0; $i < count($users); $i++) {
			
			$usermentorshipData = $usermentorshipObject->getUserMentorship($users[$i], $mentorship);

			if(!$usermentorshipData) {
				
				$data = array();
				$data['mentorship_code']	= $mentorship;
				$data['user_code']				= $users[$i];
				
				$usermentorshipObject->insert($data);
				
				/* Send an email to these newly assigned members, and give new password. */
				$userData = $userObject->getByCode($users[$i]);
				if($userData) {
					if($mentorship == date('Y')) {
						if(in_array($userData['usertype_code'], array(1, 2))) {
							/* Only send to administrators and mentors. */
							/* Create new password for the user. */					
							$data = array();
							$data['user_password'] = $userObject->createPassword();
							
							$where	= array();
							$where	= $userObject->getAdapter()->quoteInto('user_code = ?', $users[$i]);
							$success	= $userObject->update($data, $where);
							
							/* Send email to the user. */												
							$userData['category'] = 'user';
							$userData['user_decoded'] = $data['user_password'];
							$userData['reference']	= $userData['user_code'];
							$userData['user_name']	= $userData['user_name'].' '.$userData['user_surname'];
				
							$success = $commsObject->sendEmailComm('mailers/user_password.html', $userData, 'SA-YES Login Details', array('email' => 'info@say-yes.com', 'name' => 'SA-YES Admin'));	
						}					
					}
				}
			}
		}
	} else {
		$response['result'] 			= false;
		$response['error'] 			= 'No users selected.';
	}
	
	echo json_encode($response);
	die();	
}

if(isset($_GET['action']) && trim($_GET['action']) == 'deactivate') {

	require_once 'class/usermentorship.php';
	
	$response						= array();
	$response['result'] 			= true;
	$response['error'] 			= '';
	$usermentorshipObject	= new class_usermentorship();
	$data								= array();
	
	$code				= trim($_REQUEST['code']);
	$mentorship	= trim($_REQUEST['mentorship']);
			
	$usermentorshipData = $usermentorshipObject->getUserMentorship($code, $mentorship);
		
	if($usermentorshipData) {
			
		$data = array();
		$data['usermentorship_active']	= 0;
		
		$where = array();
		$where[] = $usermentorshipObject->getAdapter()->quoteInto('user_code = ?', $usermentorshipData['user_code']);
		$where[] = $usermentorshipObject->getAdapter()->quoteInto('mentorship_code = ?', $usermentorshipData['mentorship_code']);		
		$success = $usermentorshipObject->update($data, $where);
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('users/mentorship/default.tpl');

?>