<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/match.php';

$matchObject = new class_match();

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;
	$success					= NULL;
	$code						= trim($_GET['code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['match_active'] = 0;
		
		$where	= $matchObject->getAdapter()->quoteInto('match_code = ?', $code);
		$success	= $matchObject->update($data, $where);
		
		if($success) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not deactivate, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmatches') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$smentorid 		= isset($_REQUEST['smentorid']) && trim($_REQUEST['smentorid']) != '' ? trim($_REQUEST['smentorid']) : '';
	$smenteeid 	= isset($_REQUEST['smenteeid']) && trim($_REQUEST['smenteeid']) != '' ? trim($_REQUEST['smenteeid']) : '';

	$where = ' match.match_deleted = 0 ';

	if($smentorid != '') {
		$where .= ' and match.mentor_code = \''.$smentorid.'\' ';
	}

	if($smenteeid != '') {
		$where .= ' and match.mentee_code = \''.$smenteeid.'\' ';
	} 

	$matchData = $matchObject->getAll($where, 'match_added desc');

	if($matchData) {
		$response['records'] = $matchData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('matches/view/default.tpl');

?>