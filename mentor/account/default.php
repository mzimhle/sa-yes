<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/mentor.php';
require_once 'class/user.php';
require_once 'global_functions.php';

$userObject	= new class_user();

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 			= array();
	$formValid		= true;
	$success		= NULL;
	$changepassword	= false;
	
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
	
	if(isset($_POST['user_telephone']) && trim($_POST['user_telephone']) != '') {
		if(validateCell(trim($_POST['user_telephone'])) == '') {
			$errorArray['user_telephone'] = 'enter valid number';
			$formValid = false;	
		} 	
	}

	if(isset($_POST['user_cell']) && trim($_POST['user_cell']) == '') {
		$errorArray['user_cell'] = 'enter valid cell';
		$formValid = false;				
	} else if(validateCell(trim($_POST['user_cell'])) == '') {
		$errorArray['user_cell'] = 'enter valid cell';
		$formValid = false;		
	}
			
	if(isset($_POST['user_password']) && trim($_POST['user_password']) != '') {
		
		if(isset($_POST['user_password2']) && trim($_POST['user_password2']) == '') {
			$errorArray['user_password2'] = 'Please enter second password';
			$formValid = false;	
		} else {
			if(trim($_POST['user_password']) != trim($_POST['user_password2'])) {	
				$errorArray['user_password'] = 'You passwords do not match';
				$formValid = false;					
			} else {
				$changepassword = true;
			}
		}
	}
	
	if(isset($_POST['user_email']) && trim($_POST['user_email']) == '') {
		$errorArray['user_email'] = 'required';
		$formValid = false;
	} else {
		if(validateEmail(trim($_POST['user_email'])) == '') {
			$errorArray['user_email'] = 'enter valid email';
			$formValid = false;
		} else {
			$checkEmail = $userObject->checkUpdateEmail(trim($_POST['user_email']),$zfsession->userData['user_code']);
			
			if($checkEmail) {
				$errorArray['user_email'] = 'email already used by someone';
				$formValid = false;				
			}					
		}		
	}

	
	if(count($errorArray) == 0 && $formValid == true) {
				
		$data['area_code'] 			= trim($_POST['area_code']);			
		$data['user_dateofbirth'] 	= trim($_POST['user_dateofbirth']);			
		$data['user_name'] 			= trim($_POST['user_name']);				
		$data['user_surname'] 		= trim($_POST['user_surname']);				
		$data['user_idnumber'] 		= trim($_POST['user_idnumber']);				
		$data['user_email'] 			= validateEmail(trim($_POST['user_email']));	
		$data['user_telephone'] 		= validateCell(trim($_POST['user_telephone']));	
		$data['user_cell'] 				= validateCell(trim($_POST['user_cell']));	
		$data['user_race'] 				= trim($_POST['user_race']);				
		$data['user_notes'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['user_notes'])));
		
		if($changepassword) {
			$data['user_password']	= trim($_POST['user_password']);
			$data['user_decoded']	= trim($_POST['user_password']);
		}
		
		/*Update. */
		$where = $userObject->getAdapter()->quoteInto('user_code = ?', $zfsession->userData['user_code']);
		$success = $userObject->update($data, $where);
		
		if($success) {
			$zfsession->userData['area_code'] 			= $data['area_code'];
			$zfsession->userData['user_dateofbirth'] 	= $data['user_dateofbirth'];
			$zfsession->userData['user_name'] 			= $data['user_name'];
			$zfsession->userData['user_surname'] 		= $data['user_surname'];
			$zfsession->userData['user_idnumber'] 		= $data['user_idnumber'];
			$zfsession->userData['user_email'] 			= $data['user_email'];
			$zfsession->userData['user_cell'] 			= $data['user_cell'];
			$zfsession->userData['user_telephone']		= $data['user_telephone'];
			$zfsession->userData['user_race'] 			= $data['user_race'];
			$zfsession->userData['user_notes']			= $data['user_notes'];
			
			header('Location: /mentor/');
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the template  */	
$smarty->display('mentor/account/default.tpl');

?>