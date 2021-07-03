<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'Zend/Session.php';

if (!empty($_POST) && !is_null($_POST)) {

	if(isset($_POST['email']) && isset($_POST['password'])) {
	
		$username	= (isset($_POST['email'])) ? $_POST['email'] : "";
		$password		= (isset($_POST['password'])) ? $_POST['password'] : "";
	
		require_once 'class/user.php';
		
		$userObject	= new class_user();
		
		$loginData	= $userObject->checkLogin($username, $password);
		$message	= '';

		if($loginData) {
		
			if($loginData['usertype_code'] == 1) {
				$zfsession = new Zend_Session_Namespace('AdminLogin');
			} else if($loginData['usertype_code'] == 2) {
					$zfsession = new Zend_Session_Namespace('MentorLogin');
			} else {
				$message = 'You login is valid but you are not allowed to use the website at the moment.';
				$zfsession = $loginData = null; unset($zfsession, $loginData);
				//$zfsession = new Zend_Session_Namespace('MenteeLogin');
			}
			
			if($message == '') {
				/* Store user in session. */
				$zfsession->userData	= $loginData;
				$zfsession->identity	= $loginData['user_code'];
				
				/* Record use last login. */
				$data = array('user_last_login' => date('Y-m-d H:i:s'));
				$where = $userObject->getAdapter()->quoteInto('user_code = ?', $zfsession->userData['user_code']);
				$userObject->update($data, $where);

				/* Redirect user to the correct subdirectory. */
				if($loginData['usertype_code'] == 2) {
					header("Location: /mentor/");
				} else {
					header("Location: /");
				}
				
				exit;
			}
		} else {
			$message = 'You are not a valid system user';
		}//end check for user
				
	} else {
		$message = 'Please put in username and password';
	}
	
	$smarty->assign('message', $message);
}

 /* Display the template */	
$smarty->display('login.tpl');
?>