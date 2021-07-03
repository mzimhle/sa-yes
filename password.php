<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/user.php';
require_once 'class/_comms.php';

$commsObject 	= new class_comms();
$userObject		= new class_user();

if (!empty($_POST) && !is_null($_POST)) {

	if(isset($_POST['email']) && trim($_POST['email']) != '' ) {
	
		$email	= (isset($_POST['email'])) ? $_POST['email'] : "";		
		
		$emailData	= $userObject->checkEmail($email);
		$message		= '';
		$result			= 'success';

		if($emailData) {

			/* Send email to the user. */												
			$emailData['category']	= 'request-login';			
			$success = $commsObject->sendEmailComm('mailers/user_password.html', $emailData, 'Mentor login details', array('email' => 'info@say-yes.com', 'name' => 'SA-YES Admin'));	
			
			if(!$success) {
				$message	= 'Could not send email, please try again';
				$result		= 'error';
			} else {
				$message	= 'Check your email inbox';
				$result		= 'success';
			}
		} else {
			$message	= 'You are not a valid system user';
			$result		= 'error';
		}//end check for user				
	} else {
		$message	= 'Email required';
		$result		= 'error';
	}
	
	$smarty->assign('message', $message);
	$smarty->assign('result', $result);
}

 /* Display the template */	
$smarty->display('password.tpl');
?>