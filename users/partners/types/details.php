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
require_once 'class/partnertype.php';

$partnertypeObject	= new class_partnertype();

if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$reference = trim($_GET['code']);
	
	$partnertypeData = $partnertypeObject->getByCode($reference);

	if($partnertypeData) {
		$smarty->assign('partnertypeData', $partnertypeData);
	} else {
		header('Location: /users/partners/types/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	
	if(isset($_POST['partnertype_name']) && trim($_POST['partnertype_name']) == '') {
		$errorArray['partnertype_name'] = 'Required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['partnertype_name'] 		= trim($_POST['partnertype_name']);		
		$data['partnertype_description']	= '';	
		
		if(isset($partnertypeData)) {
		
			$where	= $partnertypeObject->getAdapter()->quoteInto('partnertype_code = ?', $partnertypeData['partnertype_code']);
			$success	= $partnertypeObject->update($data, $where);	
			
		} else {
			/* Insert */
			$success = $partnertypeObject->insert($data);	
		}
			
		header('Location: /users/partners/types/');
		exit();				
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('users/partners/types/details.tpl');
?>