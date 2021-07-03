<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/mentor.php';
require_once 'class/meeting.php';
require_once 'class/meetingtype.php';
require_once 'class/match.php';

$meetingObject 		= new class_meeting();
$meetingtypeObject	= new class_meetingtype();
$matchObject			= new class_match();

$meetingtypeData = $meetingtypeObject->pairs();
if($meetingtypeData) { $smarty->assign('meetingtypeData', $meetingtypeData); }

$matchData = $matchObject->getByMentor($zfsession->userData['user_code'], date('Y'));

if($matchData) {
	$smarty->assign('matchData', $matchData);
}
	
if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$meetingData = $meetingObject->getByCode($reference);
	
	if($meetingData) {
		$smarty->assign('meetingData', $meetingData);
		$smarty->assign('status', $meetingData['meeting_status']);
	} else {
		header('Location: /mentor/meetings/');
		exit;		
	}
}

/* Check posted data. */
if(count($_POST) > 0 && !isset($meetingData)) {
	
	$errorArray	= array();
	$data 		= array();
	$formValid	= true;
	$success	= NULL;
	$areaByName	= NULL;	
	
	
	if(!isset($matchData)) {
		$errorArray['mentee_code'] = 'There is no mentee you are matched with';
		$formValid = false;		
	}	

	if(isset($_POST['meeting_date']) && trim($_POST['meeting_date']) != date('Y-m-d H:i', strtotime(trim($_POST['meeting_date'])))) {
		$errorArray['meeting_date'] = 'valid date and time required';
		$formValid = false;		
	}	else {
		/* Check time if its valid. */
		if(!preg_match('/(2[0-3]|[01][0-9]):[0-5][0-9]/', date('H:i', strtotime(trim($_POST['meeting_date']))))) {
			$errorArray['meeting_date'] = 'valid time required';
			$formValid = false;
		}
		
		if(strtotime(date('Y-m-d H:i', time())) < strtotime(date('Y-m-d H:i', strtotime(trim($_POST['meeting_date']))))) {
			$errorArray['meeting_date'] = 'date cannot be in the future';
			$formValid = false;			
		}		
	}
	
	if(isset($_POST['meeting_status']) && trim($_POST['meeting_status']) == '') {
		$errorArray['meeting_status'] = 'required';
		$formValid = false;		
	} else {
		if((int)trim($_POST['meeting_status']) == 1) {
			/* They met. */
			if(isset($_POST['meetingtype_code']) && trim($_POST['meetingtype_code']) == '') {
				$errorArray['meetingtype_code'] = 'required';
				$formValid = false;		
			}
			
			if(isset($_REQUEST['meeting_length']) && (int)trim($_REQUEST['meeting_length']) == 0) {
				$errorArray['meeting_length'] = 'required';
				$formValid = false;		
			}			
			if(isset($_POST['meeting_partner']) && trim($_POST['meeting_partner']) == '') {
				$errorArray['meeting_partner'] = 'required';
				$formValid = false;		
			}
			if(isset($_POST['meeting_staff']) && trim($_POST['meeting_staff']) == '') {
				$errorArray['meeting_staff'] = 'required';
				$formValid = false;		
			}			
			if(isset($_POST['meeting_address']) && trim($_POST['meeting_address']) == '') {
				$errorArray['meeting_address'] = 'required';
				$formValid = false;		
			}					
		} else {
			/* Did not meet. */
			if(isset($_POST['meeting_reason']) && trim($_POST['meeting_reason']) == '') {
				$errorArray['meeting_reason'] = 'required';
				$formValid = false;		
			}			
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required. */
		$data['mentor_code'] 			= $zfsession->userData['user_code'];
		$data['mentee_code'] 			= $matchData['menteecode'];	
		$data['meetingtype_code'] 		= trim($_POST['meetingtype_code']);				
		$data['meeting_date'] 			= date('Y-m-d', strtotime(trim($_POST['meeting_date'])));
		$data['meeting_status'] 		= trim($_POST['meeting_status']);		
		$data['meeting_reason']			= trim($_POST['meeting_reason']);	
		$data['meeting_length']			= trim($_POST['meeting_length']);	
		$data['meeting_starttime']		= date('H:i', strtotime(trim($_POST['meeting_date'])));
		$data['meeting_staff']			= trim($_POST['meeting_staff']);	
		$data['meeting_partner']		= trim($_POST['meeting_partner']);	
		$data['meeting_address']		= trim($_POST['meeting_address']);	
		$data['mentorship_code']		= $matchData['mentorship_code'];
		$data['meeting_notes'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['meeting_notes'])));		
		
		/* Insert. */
		$success = $meetingObject->insert($data);
					
		header('Location: /mentor/meetings/');
		exit;		
		
	}

	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	$smarty->assign('status', trim($_POST['meeting_status']));
}

 /* Display the template  */	
$smarty->display('mentor/meetings/details.tpl');
?>