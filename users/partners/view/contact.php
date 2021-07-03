<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

/**
 * Check for login
 */
require_once 'includes/auth.php';

/* objects. */
require_once 'class/partner.php';
require_once 'class/partnercontact.php';

$partnerObject 				= new class_partner();
$partnercontactObject 	= new class_partnercontact();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$partnerData = $partnerObject->getByCode($code);

	if(!$partnerData) {
		header('Location: /users/partners/view/');
		exit;
	}

	$smarty->assign('partnerData', $partnerData);
	
} else {

	header('Location: /users/partners/view/');
	exit;
	
}

/* Check posted data. */
if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;	
	$formValid				= true;
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {	
		$data	= array();
		$data['partnercontact_deleted'] = 1;
		
		$where		= array();
		$where[]	= $partnercontactObject->getAdapter()->quoteInto('partnercontact_code = ?', $code);
		$where[]	= $partnercontactObject->getAdapter()->quoteInto('partner_code = ?', $partnerData['partner_code']);
		
		$success	= $partnercontactObject->update($data, $where);	
		
		if(is_numeric($success) && $success > 0) {		
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

/* Check posted data. */
if(isset($_GET['code_update'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;
	$data 						= array();
	$formValid				= true;
	$success					= NULL;
	$code						= trim($_GET['code_update']);

	if(isset($_REQUEST['partnercontact_fullname']) && trim($_REQUEST['partnercontact_fullname']) == '') {
			$errorArray['error']	= 'Contact name needed';
			$errorArray['result']	= 0;			
	}

	if(isset($_REQUEST['partnercontact_position']) && trim($_REQUEST['partnercontact_position']) == '') {
			$errorArray['error']	= 'Position missing';
			$errorArray['result']	= 0;			
	}
	
	if(isset($_REQUEST['partnercontact_email']) && trim($_REQUEST['partnercontact_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_REQUEST['partnercontact_email']))) {
			$errorArray['error']	= 'Enter valid email';
			$errorArray['result']	= 0;		
		}	
	} else {
			$errorArray['error']	= 'Contact email missing';
			$errorArray['result']	= 0;		
	}
	
	if(isset($_REQUEST['partnercontact_cell']) && trim($_REQUEST['partnercontact_cell']) != '') {
		if(!preg_match('/^[0-9]{10}$/', trim($_REQUEST['partnercontact_cell']))) {
			$errorArray['error']	= 'Enter valid cell';
			$errorArray['result']	= 0;		
		}		
	}
	
	if(isset($_REQUEST['partnercontact_telephone']) && trim($_REQUEST['partnercontact_telephone']) != '') {
		if(!preg_match('/^[0-9]{10}$/', trim($_REQUEST['partnercontact_telephone']))) {
			$errorArray['error']	= 'Enter valid telephone';
			$errorArray['result']	= 0;		
		}		
	}

	if($errorArray['error']  == '') {

		/* Get image details. To check order. */
		$contactdata = $partnercontactObject->getByCode($code);
		
		if($contactdata) {
						
			$data 	= array();		
			$data['partnercontact_fullname'] 	= trim($_REQUEST['partnercontact_fullname']);		
			$data['partnercontact_position'] 	= trim($_REQUEST['partnercontact_position']);		
			$data['partnercontact_email'] 		= trim($_REQUEST['partnercontact_email']);		
			$data['partnercontact_cell'] 			= trim($_REQUEST['partnercontact_cell']);		
			$data['partnercontact_telephone']	= trim($_REQUEST['partnercontact_telephone']);		
			$data['partnercontact_address'] 	= trim($_REQUEST['partnercontact_address']);		
			
			$where		= array();
			$where[]	= $partnercontactObject->getAdapter()->quoteInto('partnercontact_code = ?', $code);
			$where[]	= $partnercontactObject->getAdapter()->quoteInto('partner_code = ?', $partnerData['partner_code']);
			$success	= $partnercontactObject->update($data, $where);	

			if(is_numeric($success)) {		
				$errorArray['error']	= '';
				$errorArray['result']	= 1;			
			} else {
				$errorArray['error']	= 'Could not update, please try again.';
				$errorArray['result']	= 0;				
			}
		} else {
			$errorArray['error']	= '';
			$errorArray['result']	= 0;					
		}
	}
	
	echo json_encode($errorArray);
	exit;
}


/* Check posted data. */
if(count($_POST) > 0) {

	$errorArray	= array();
	$data 			= array();
	$formValid	= true;
	$success		= NULL;
	
	if(isset($_POST['partnercontact_fullname']) && trim($_POST['partnercontact_fullname']) == '') {
		$errorArray['partnercontact_fullname'] = 'required';
		$formValid = false;		
	}

	if(isset($_POST['partnercontact_position']) && trim($_POST['partnercontact_position']) == '') {
		$errorArray['partnercontact_position'] = 'required';
		$formValid = false;		
	}
	
	if(isset($_POST['partnercontact_email']) && trim($_POST['partnercontact_email']) != '') {
		if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($_POST['partnercontact_email']))) {
			$errorArray['partnercontact_email'] = 'required';
			$formValid = false;
		}	
	} else {
		$errorArray['partnercontact_email'] = 'required';
		$formValid = false;	
	}
	
	if(isset($_POST['partnercontact_cell']) && trim($_POST['partnercontact_cell']) != '') {
		if(!preg_match('/^[0-9]{10}$/', trim($_POST['partnercontact_cell']))) {
			$errorArray['partnercontact_cell'] = 'required';
			$formValid = false;
		}		
	}
	
	if(isset($_POST['partnercontact_telephone']) && trim($_POST['partnercontact_telephone']) != '') {
		if(!preg_match('/^[0-9]{10}$/', trim($_POST['partnercontact_telephone']))) {
			$errorArray['partnercontact_telephone'] = 'required';
			$formValid = false;
		}		
	}

	if(count($errorArray) == 0 && $formValid == true) {
		
		$data = array();
		$data['partnercontact_fullname'] 	= trim($_POST['partnercontact_fullname']);		
		$data['partnercontact_position'] 	= trim($_POST['partnercontact_position']);		
		$data['partnercontact_email'] 		= trim($_POST['partnercontact_email']);		
		$data['partnercontact_cell'] 			= trim($_POST['partnercontact_cell']);		
		$data['partnercontact_telephone']	= trim($_POST['partnercontact_telephone']);		
		$data['partnercontact_address'] 	= trim($_POST['partnercontact_address']);		
		$data['partner_code'] 					= $partnerData['partner_code'];		

		$success	= $partnercontactObject->insert($data);	
			
		header('Location: /users/partners/view/contact.php?code='.$code);
		exit;
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
}

$contactData = $partnercontactObject->getByPartner($partnerData['partner_code']);


if($contactData) {
	$smarty->assign('contactData', $contactData);
}

$smarty->display('users/partners/view/contact.tpl');

?>