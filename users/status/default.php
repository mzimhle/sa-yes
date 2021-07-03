<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/applicationstatus.php';

$applicationstatusObject = new class_applicationstatus();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['applicationstatus_deleted'] = 1;
		
		$where	= $applicationstatusObject->getAdapter()->quoteInto('applicationstatus_code = ?', $code);
		$success	= $applicationstatusObject->update($data, $where);
		
		if($success) {
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

/* Setup Pagination. */
$applicationstatusData = $applicationstatusObject->getAll("applicationstatus.applicationstatus_deleted = 0",'applicationstatus_added DESC');
if($applicationstatusData) $smarty->assign('applicationstatusData', $applicationstatusData);

/* End Pagination Setup. */
$smarty->display('users/status/default.tpl');

?>