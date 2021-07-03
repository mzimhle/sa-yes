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
require_once 'class/calendartype.php';

$calendartypeObject	= new class_calendartype();

if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$reference = trim($_GET['code']);
	
	$calendartypeData = $calendartypeObject->getByCode($reference);

	if($calendartypeData) {
		$smarty->assign('calendartypeData', $calendartypeData);
	} else {
		header('Location: /calendar/types/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['calendartype_name']) && trim($_POST['calendartype_name']) == '') {
		$errorArray['calendartype_name'] = 'Required';
		$formValid = false;		
	}
	
	if(isset($_POST['calendartype_colour']) && trim($_POST['calendartype_colour']) == '') {
		$errorArray['calendartype_colour'] = 'Product Required';
		$formValid = false;		
	}
	
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['calendartype_name'] 		= trim($_POST['calendartype_name']);		
		$data['calendartype_colour']	= preg_replace("/[^a-z]+/", "", trim($_POST['calendartype_colour']));	
		
		if(isset($calendartypeData)) {
		
			$where	= $calendartypeObject->getAdapter()->quoteInto('calendartype_code = ?', $calendartypeData['calendartype_code']);
			$success	= $calendartypeObject->update($data, $where);	
			
		} else {
			/* Insert */
			$success = $calendartypeObject->insert($data);	
		}
			
		header('Location: /calendar/types/');
		exit();				
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('calendar/types/details.tpl');
?>