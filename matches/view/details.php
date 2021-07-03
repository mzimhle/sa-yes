<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/* Other resources. */
require_once 'includes/auth.php';

/* objects. */
require_once 'class/match.php';
require_once 'class/mentorship.php';

$matchObject			= new class_match();
$mentorshipObject	= new class_mentorship();

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$reference = trim($_GET['code']);
	
	$matchData = $matchObject->getByCode($reference);

	if($matchData) {
		$smarty->assign('matchData', $matchData);
	} else {
		header('Location: /matches/view/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['mentorship_code']) && trim($_POST['mentorship_code']) == '') {
		$errorArray['mentorship_code'] = 'Required';
		$formValid = false;		
	}
	
	if(isset($_POST['mentor_code']) && trim($_POST['mentor_code']) == '') {
		$errorArray['mentor_code'] = 'Required';
		$formValid = false;		
	}
	
	if(isset($_POST['mentee_code']) && trim($_POST['mentee_code']) == '') {
		$errorArray['mentee_code'] = 'Required';
		$formValid = false;		
	}
	
	if((isset($_POST['mentee_code']) && trim($_POST['mentee_code']) != '') && (isset($_POST['mentor_code']) && trim($_POST['mentor_code']) != '') && (isset($_POST['mentorship_code']) && trim($_POST['mentorship_code']) != '')) {
		
		if(isset($matchData)) {
			$checkMatch = $matchObject->getByUserMentorship(trim($_POST['mentor_code']), trim($_POST['mentee_code']), trim($_POST['mentorship_code']), $matchData['match_code']);
		} else {
			$checkMatch = $matchObject->getByUserMentorship(trim($_POST['mentor_code']), trim($_POST['mentee_code']), trim($_POST['mentorship_code']));		
		}

		if($checkMatch) {
			$errorArray['matchcheck'] = 'Match already exists.';
			$formValid = false;				
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['mentorship_code'] 	= trim($_POST['mentorship_code']);		
		$data['mentor_code']		= trim($_POST['mentor_code']);	
		$data['mentee_code']		= trim($_POST['mentee_code']);	
		$data['match_notes']		= trim($_POST['match_notes']);	
		
		if(isset($matchData)) {
		
			$where	= $matchObject->getAdapter()->quoteInto('match_code = ?', $matchData['match_code']);
			$success	= $matchObject->update($data, $where);	
			
		} else {
			/* Insert */
			$success = $matchObject->insert($data);	
		}
			
		header('Location: /matches/view/');
		exit();				
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('matches/view/details.tpl');
?>