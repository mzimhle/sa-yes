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
require_once 'class/meetingtype.php';

$meetingtypeObject	= new class_meetingtype();

if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$reference = trim($_GET['code']);
	
	$meetingtypeData = $meetingtypeObject->getByCode($reference);

	if($meetingtypeData) {
		$smarty->assign('meetingtypeData', $meetingtypeData);
	} else {
		header('Location: /meetings/types/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['meetingtype_name']) && trim($_POST['meetingtype_name']) == '') {
		$errorArray['meetingtype_name'] = 'Required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['meetingtype_name'] 			= trim($_POST['meetingtype_name']);		
		$data['meetingtype_description']	= '';	
		
		if(isset($meetingtypeData)) {
		
			$where	= $meetingtypeObject->getAdapter()->quoteInto('meetingtype_code = ?', $meetingtypeData['meetingtype_code']);
			$success	= $meetingtypeObject->update($data, $where);	
			
		} else {
			/* Insert */
			$success = $meetingtypeObject->insert($data);	
		}
			
		header('Location: /meetings/types/');
		exit();				
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('meetings/types/details.tpl');
?>