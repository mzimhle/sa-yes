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

if(isset($_REQUEST['term'])) {
	
	$userData	= $userObject->searchApplication('user.usertype_code = 3 and user.user_deleted = 0', 'user.user_name DESC');
	$q						= trim($_REQUEST['term']); 
	
	if(count($userData) > 0) {
		for($i = 0; $i < count($userData); $i++) {
			$list[] = array(
				"id" 		=> $userData[$i]["user_code"],
				"label" 	=> $userData[$i]['user_name'].' '.$userData[$i]['user_surname'],
				"value" 	=> $userData[$i]["user_code"].' - '.$userData[$i]['user_name'].' '.$userData[$i]['user_surname']
			);			
		}
		
		foreach ($list as $details) {
			if (strpos(strtolower($details["value"]), $q) !== false) {
				$results[] = $details;
			}
		}		
	}
}


if(count($results) > 0) {
	echo json_encode($results); 
	exit;
} else {
	echo json_encode(array(0 => array('id' => '', 'label' => 'no results', 'value' => ''))); 
	exit;
}

exit;

?>