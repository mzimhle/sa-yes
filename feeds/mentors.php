<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'class/user.php';

$userObject	= new class_user();

$results 		= array();
$list			= array();	

function showProgram($code = '') {
	return ($code == '') ? 'N/A' : $code = $code;	
}
 
if(isset($_REQUEST['term'])) {
		
	$q						= trim($_REQUEST['term']); 
	$userData	= $userObject->searchUsers($q, 2);
	
	if($userData) {
		for($i = 0; $i < count($userData); $i++) {
			$list[] = array(
				"id" 		=> $userData[$i]["user_code"],
				"label" 	=> $userData[$i]["user_code"].' - '.showProgram($userData[$i]['mentorship_code']).' - '.$userData[$i]['user_name'].' '.$userData[$i]['user_surname'].' '.$userData[$i]['user_cell'].' - '.$userData[$i]['user_email'],
				"value" 	=> $userData[$i]["user_code"].' - '.showProgram($userData[$i]['mentorship_code']).' - '.$userData[$i]['user_name'].' '.$userData[$i]['user_surname'].' '.$userData[$i]['user_cell'].' - '.$userData[$i]['user_email'], 
			);			
		}	
	}
}


if(count($list) > 0) {
	echo json_encode($list); 
	exit;
} else {
	echo json_encode(array(0 => array('id' => '', 'label' => 'no results', 'value' => ''))); 
	exit;
}

exit;

?>