<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/partnertype.php';

$partnertypeObject = new class_partnertype();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['partnertype_deleted'] = 1;
		
		$where	= $partnertypeObject->getAdapter()->quoteInto('partnertype_code = ?', $code);
		$success	= $partnertypeObject->update($data, $where);
		
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
$partnertypeData = $partnertypeObject->getAll("partnertype.partnertype_deleted = 0",'partnertype_added DESC');
if($partnertypeData) $smarty->assign('partnertypeData', $partnertypeData);

/* End Pagination Setup. */
$smarty->display('users/partners/types/default.tpl');

?>