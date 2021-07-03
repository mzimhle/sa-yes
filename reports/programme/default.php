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
require_once 'class/menteeapp.php';
require_once 'class/applicationstatus.php';
require_once 'class/mentorship.php';

$mentorappObject 			= new class_mentorapp();
$menteeappObject 			= new class_menteeapp();
$applicationstatusObject	= new class_applicationstatus();
$mentorshipObject			= new class_mentorship();

$applicationstatusData = $applicationstatusObject->pairs();
if($applicationstatusData) { $smarty->assign('applicationstatusData', $applicationstatusData); }

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmembers') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';
	$mentorData 			= array();
	$menteeData 			= array();
	
	$status			= isset($_REQUEST['status']) && trim($_REQUEST['status']) != '' ? trim($_REQUEST['status']) : '';
	$type			= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';
	$programme		= isset($_REQUEST['programme']) && trim($_REQUEST['programme']) != '' ? trim($_REQUEST['programme']) : '';
	
	if($type == '' || $type == 'mentor') {
		$where = ' mentorapp.mentorapp_deleted = 0 ';
		
		if($programme != '') {
			$where .= ' and mentorapp.mentorship_code = \''.$programme.'\' ';
		}
		
		if($status != '') {
			$where .= ' and mentorapp.applicationstatus_code = \''.$status.'\' ';
		}

		$mentorData = $mentorappObject->getAll($where, 'mentorapp_name asc');
		if(!$mentorData) {$mentorData = array(); }
	}
	
	if($type == '' || $type == 'mentee') {
		$iwhere = ' menteeapp.menteeapp_deleted = 0 ';
		
		if($programme != '') {
			$iwhere .= ' and menteeapp.mentorship_code = \''.$programme.'\' ';
		}
		
		if($status != '') {
			$iwhere .= ' and menteeapp.applicationstatus_code = \''.$status.'\' ';
		}

		$menteeData = $menteeappObject->getAll($iwhere, 'menteeapp_name asc');
		if(!$menteeData) {$menteeData = array();}
	}
	
	
	$userData = array_merge($mentorData, $menteeData);
	
	if($userData) {
		$response['records'] = $userData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('reports/programme/default.tpl');

?>