<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'class/calendar.php';

require_once 'global_functions.php';

$calendarObject	= new class_calendar();

$results 		= array();
$list			= array();	

if(isset($_REQUEST['term'])) {
	
	$q		= trim($_REQUEST['term']); 
	$data	= $calendarObject->searchContact($q);
	
	if($data) {
		for($i = 0; $i < count($data); $i++) {
			$results[] = array(
				"label"		=> $data[$i]["search"],
				"name"	=> $data[$i]["fullname"],
				"email"		=> $data[$i]["email"],
				"cell" 		=> onlyCellNumber($data[$i]["cell"]),
				"code" 	=> $data[$i]["code"],
				"type" 		=> $data[$i]["type"]
			);			
		}
		
		/* 
		foreach ($list as $details) {
			if (strpos(strtolower($details["value"]), $q) !== false) {
				$results[] = $details;
			}
		}
		*/
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