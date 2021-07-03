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
require_once 'class/mentorship.php';

$mentorshipObject	= new class_mentorship();

if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$reference = trim($_GET['code']);

	$mentorshipData = $mentorshipObject->getByCode($reference);

	if($mentorshipData) {
		$smarty->assign('mentorshipData', $mentorshipData);
	} else {
		header('Location: /program/view/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['mentorship_name']) && trim($_POST['mentorship_name']) == '') {
		$errorArray['mentorship_name'] = 'Required';
		$formValid = false;		
	}
	
	if(isset($_POST['mentorship_description']) && trim($_POST['mentorship_description']) == '') {
		$errorArray['mentorship_description'] = 'Product Required';
		$formValid = false;		
	}
	
	if(!isset($mentorshipData)) {
		if(isset($_POST['mentorship_code']) && trim($_POST['mentorship_code']) == '') {
			$errorArray['mentorship_code'] = 'Year Required';
			$formValid = false;		
		} else {
			$checkProgram = $mentorshipObject->getByCode(trim($_POST['mentorship_code']));
			if($checkProgram) {
				$errorArray['mentorship'] = 'Program program already exists.';
				$formValid = false;				
			}
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['mentorship_name'] 		= trim($_POST['mentorship_name']);		
		$data['mentorship_description']	= trim($_POST['mentorship_description']);			
		
		if(isset($mentorshipData)) {
		
			$where		= $mentorshipObject->getAdapter()->quoteInto('mentorship_code = ?', $mentorshipData['mentorship_code']);
			$success	= $mentorshipObject->update($data, $where);	
			
		} else {
			/* Insert */
			$data['mentorship_startdate']	= trim($_POST['mentorship_code']).'-01-01';
			$data['mentorship_enddate'] 	= trim($_POST['mentorship_code']).'-12-31';
			$data['mentorship_code']		= trim($_POST['mentorship_code']);
			
			$success = $mentorshipObject->insert($data);	
		}
			
		header('Location: /program/view/');
		exit();				
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('program/view/details.tpl');
?>