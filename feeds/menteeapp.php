<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'class/menteeapp.php';

$menteeappObject	= new class_menteeapp();

$results			= array();
$list				= array();	
$mentorship	= isset($_REQUEST['mentorship']) ? "and menteeapp.mentorship_code = ".(int)trim($_REQUEST['mentorship']) : '';

if(isset($_REQUEST['term'])) {
	
	$userData	= $menteeappObject->getAll("menteeapp_deleted = 0 $mentorship ", 'menteeapp.menteeapp_name DESC');
	$q						= trim($_REQUEST['term']); 
	
	if(count($userData) > 0) {
		for($i = 0; $i < count($userData); $i++) {
			$list[] = array(
				"id" 		=> $userData[$i]["menteeapp_code"],
				"label" 	=> $userData[$i]['mentorship_code'].' : '.$userData[$i]['menteeapp_name'].' '.$userData[$i]['menteeapp_surname'],
				"value" 	=> $userData[$i]["mentorship_code"].' - '.$userData[$i]['menteeapp_name'].' '.$userData[$i]['menteeapp_surname']
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