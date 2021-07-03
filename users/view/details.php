<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/user.php';
require_once 'class/usertype.php';
require_once 'class/partner.php';

require_once 'global_functions.php';

$userObject 		= new class_user();
$usertypeObject	= new class_usertype();
$partnerObject	= new class_partner();

$usertypeData = $usertypeObject->pairs();
if($usertypeData) { $smarty->assign('usertypeData', $usertypeData); }

$partnerData = $partnerObject->pairs();
if($partnerData) { $smarty->assign('partnerData', $partnerData); }

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$tempData = $userObject->getByCode($reference);
	
	if($tempData) {
		$smarty->assign('tempData', $tempData);
	} else {
		header('Location: /users/view/');
		exit;		
	}
} else {
	header('Location: /users/view/');
	exit;		
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	$areaByName	= NULL;
	
	if(isset($_POST['user_name']) && trim($_POST['user_name']) == '') {
		$errorArray['user_name'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['user_surname']) && trim($_POST['user_surname']) == '') {
		$errorArray['user_surname'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['user_race']) && trim($_POST['user_race']) == '') {
		$errorArray['user_race'] = 'required';
		$formValid = false;
	}
	/*
	if(isset($_POST['user_idnumber']) && trim($_POST['user_idnumber']) != '') {
		if(validateID(trim($_POST['user_idnumber'])) == '') {
			$errorArray['user_idnumber'] = 'valid 13 digit ID number required';
			$formValid = false;
		}	
	}
	*/
	if(isset($_POST['user_telephone']) && trim($_POST['user_telephone']) != '') {
		if(validateCell(trim($_POST['user_telephone'])) == '') {
			$errorArray['user_telephone'] = 'enter valid number';
			$formValid = false;	
		} 	
	}

	if(isset($_POST['user_cell']) && trim($_POST['user_cell']) != '') {
		if(validateCell(trim($_POST['user_cell'])) == '') {
			$errorArray['user_cell'] = 'enter valid cell';
			$formValid = false;	
		} else {
			$cellData = $userObject->getByCell(trim($_POST['user_cell']), $tempData['user_code']);
			
			if($cellData) {
				$errorArray['user_cell'] = 'Cell number already taken';
				$formValid = false;				
			}
		} 	
	}
		
	if(in_array((int)trim($tempData['usertype_code']), array(2))) {
		
		if(isset($_POST['user_email']) && trim($_POST['user_email']) == '') {
			$errorArray['user_email'] = 'required';
			$formValid = false;
		} else {
			if(validateEmail(trim($_POST['user_email'])) == '') {
				$errorArray['user_email'] = 'enter valid email';
				$formValid = false;
			} else {
					$checkEmail = $userObject->checkUpdateEmail(trim($_POST['user_email']), $tempData['user_code']);
					
					if($checkEmail) {
						$errorArray['user_email'] = 'email already used by someone';
						$formValid = false;				
					}					
			}		
		}
		
		if(validateCell(trim($_POST['user_cell'])) == '') {
			$errorArray['user_cell'] = 'enter valid cell';
			$formValid = false;	
		} else {
			$cellData = $userObject->getByCell(trim($_POST['user_cell']), $tempData['user_code']);
			
			if($cellData) {
				$errorArray['user_cell'] = 'Cell number already taken';
				$formValid = false;				
			}
		} 	
			
	
	} else {
		if(isset($_POST['partner_code']) && trim($_POST['partner_code']) == '') {
			$errorArray['partner_code'] = 'required';
			$formValid = false;
		}		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
				
		$data['partner_code'] 		= isset($_POST['partner_code']) ? trim($_POST['partner_code']) : null;		
		$data['area_code'] 			= isset($_POST['area_code']) ? trim($_POST['area_code']) : null;			
		$data['user_dateofbirth'] 	= isset($_POST['user_dateofbirth']) ? trim($_POST['user_dateofbirth']) : null;			
		$data['user_name'] 			= isset($_POST['user_name']) ? trim($_POST['user_name']) : null;				
		$data['user_surname'] 		= isset($_POST['user_surname']) ? trim($_POST['user_surname']) : null;				
		$data['user_idnumber'] 		= isset($_POST['user_idnumber']) ? trim($_POST['user_idnumber']) : null;				
		$data['user_email'] 			= isset($_POST['user_email']) ? validateEmail(trim($_POST['user_email'])) : null;	
		$data['user_telephone'] 		= isset($_POST['user_telephone']) ? validateCell(trim($_POST['user_telephone'])) : null;	
		$data['user_cell'] 				= isset($_POST['user_cell']) ? validateCell(trim($_POST['user_cell'])) : null;	
		$data['user_race'] 				= isset($_POST['user_race']) ? trim($_POST['user_race']) : null;			
		$data['user_notes'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['user_notes'])));
		
		/*Update. */
		$where = $userObject->getAdapter()->quoteInto('user_code = ?', $tempData['user_code']);
		$success = $userObject->update($data, $where);	
		
		header('Location: /users/view/');
		exit;		
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('users/view/details.tpl');

?>