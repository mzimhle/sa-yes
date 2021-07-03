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
require_once 'class/partner.php';
require_once 'class/partnertype.php';

$partnerObject		= new class_partner();
$partnertypeObject	= new class_partnertype();

$partnertypeData = $partnertypeObject->pairs();
if($partnertypeData) { $smarty->assign('partnertypeData', $partnertypeData); }

if (!empty($_GET['code']) && $_GET['code'] != '') {
	
	$reference = trim($_GET['code']);
	
	$partnerData = $partnerObject->getByCode($reference);

	if($partnerData) {
		$smarty->assign('partnerData', $partnerData);
	} else {
		header('Location: /users/partners/view/');
		exit;
	}
}

/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['partner_name']) && trim($_POST['partner_name']) == '') {
		$errorArray['partner_name'] = 'Required';
		$formValid = false;		
	}
	
	if(isset($_POST['partnertype_code']) && trim($_POST['partnertype_code']) == '') {
		$errorArray['partnertype_code'] = 'Required';
		$formValid = false;		
	}
	
	if(isset($_POST['partner_address']) && trim($_POST['partner_address']) == '') {
		$errorArray['partner_address'] = 'Required';
		$formValid = false;		
	}
	
	if(isset($_POST['area_code']) && trim($_POST['area_code']) == '') {
		$errorArray['area_code'] = 'Required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data 	= array();		
		$data['partner_name'] 			= trim($_POST['partner_name']);		
		//$data['partner_description']	= trim($_POST['partner_description']);	
		$data['partnertype_code']		= trim($_POST['partnertype_code']);	
		$data['area_code']				= trim($_POST['area_code']);	
		$data['partner_website']		= trim($_POST['partner_website']);	
		$data['partner_address']		= trim($_POST['partner_address']);	
		
		if(isset($partnerData)) {
		
			$where		= $partnerObject->getAdapter()->quoteInto('partner_code = ?', $partnerData['partner_code']);
			$success	= $partnerObject->update($data, $where);	
			
		} else {
			/* Insert */
			$success = $partnerObject->insert($data);	
		}
			
		header('Location: /users/partners/view/');
		exit();				
	}	
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('users/partners/view/details.tpl');
?>