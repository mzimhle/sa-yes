<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/menteeapp.php';
require_once 'class/applicationstatus.php';
require_once 'class/mentorship.php';

$menteeappObject 			= new class_menteeapp();
$applicationstatusObject		= new class_applicationstatus();
$mentorshipObject			= new class_mentorship();

$applicationstatusData = $applicationstatusObject->pairs();
if($applicationstatusData) { $smarty->assign('applicationstatusData', $applicationstatusData); }

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

if((isset($_GET['action']) && trim($_GET['action']) == 'deleteapp')) {
	
	$response				= array();
	$response['result'] 	= false;
	$response['message'] 	= '';
	
	$menteeappcode	= isset($_REQUEST['appcode']) && trim($_REQUEST['appcode']) != '' ? trim($_REQUEST['appcode']) : '';
	$program		= trim($_REQUEST['program']);
	
	if($menteeappcode != '' && $program != '') {
		$data = array();
		$data['menteeapp_deleted'] = 1;
		
		/*Update. */
		$where = array();
		$where[] = $menteeappObject->getAdapter()->quoteInto('menteeapp_code = ?', $menteeappcode);
		$where[] = $menteeappObject->getAdapter()->quoteInto('mentorship_code = ?', $program);
		$success = $menteeappObject->update($data, $where);
		$response['result'] 	= true;
		
	} else {
		$response['message'] 	= 'Please select participant.';
	}
	
	echo json_encode($response);
	die();		
}

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmentees') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$usercode 	= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : '';
	$status			= isset($_REQUEST['status']) && trim($_REQUEST['status']) != '' ? trim($_REQUEST['status']) : '';
	$programme	= isset($_REQUEST['programme']) && trim($_REQUEST['programme']) != '' ? trim($_REQUEST['programme']) : '';

	$where = ' menteeapp.menteeapp_deleted = 0 ';

	if($usercode != '') {
		$where .= ' and menteeapp.menteeapp_code = \''.$usercode.'\' ';
	}

	if($programme != '') {
		$where .= ' and menteeapp.mentorship_code = \''.$programme.'\' ';
	}
	
	if($status != '') {
		$where .= ' and menteeapp.applicationstatus_code = \''.$status.'\' ';
	}

	$userData = $menteeappObject->getAll($where, 'menteeapp_name asc');

	if($userData) {
		$response['records'] = $userData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('users/menteeapplications/default.tpl');

?>