<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'class/mentorapp.php';

$mentorappObject	= new class_mentorapp();

$results	= array();
$list		= array();	

if(isset($_REQUEST['term'])) {
	
	$userData	= $mentorappObject->getAll('mentorapp_deleted = 0', 'mentorapp.mentorapp_name DESC');
	$q						= trim($_REQUEST['term']); 
	
	if(count($userData) > 0) {
		for($i = 0; $i < count($userData); $i++) {
			$list[] = array(
				"id" 		=> $userData[$i]["mentorapp_code"],
				"label" 	=> $userData[$i]['mentorship_code'].' : '.$userData[$i]['mentorapp_name'].' '.$userData[$i]['mentorapp_surname'],
				"value" 	=> $userData[$i]["mentorship_code"].' - '.$userData[$i]['mentorapp_name'].' '.$userData[$i]['mentorapp_surname']
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