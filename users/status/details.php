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
require_once 'class/applicationstatus.php';

$applicationstatusObject	= new class_applicationstatus();

if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$reference = trim($_GET['code']);
	
	$applicationstatusData = $applicationstatusObject->getByCode($reference);

	if($applicationstatusData) {
		$smarty->assign('applicationstatusData', $applicationstatusData);
	} else {
		header('Location: /users/status/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['applicationstatus_name']) && trim($_POST['applicationstatus_name']) == '') {
		$errorArray['applicationstatus_name'] = 'Required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['applicationstatus_name'] 	= trim($_POST['applicationstatus_name']);
		$data['applicationstatus_active'] 	= 1;
		$data['applicationstatus_deleted']	= 0;
		
		if(isset($applicationstatusData)) {
		
			$where	= $applicationstatusObject->getAdapter()->quoteInto('applicationstatus_code = ?', $applicationstatusData['applicationstatus_code']);
			$success	= $applicationstatusObject->update($data, $where);	
			
		} else {
			/* Insert */
			$success = $applicationstatusObject->insert($data);	
		}
			
		header('Location: /users/status/');
		exit();				
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('users/status/details.tpl');
?>