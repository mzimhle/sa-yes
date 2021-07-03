<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/area.php';

$areaObject	= new class_area();

$results 				= array();
$list						= array();	

if(isset($_REQUEST['term'])) {

	$q			= trim($_REQUEST['term']); 
	$areaData	= $areaObject->getAll('area.area_name like \'%'.$q.'%\'', 'area.area_added DESC');	
	
	if(count($areaData) > 0) {
		for($i = 0; $i < count($areaData); $i++) {
			$list[] = array(
				"id" 		=> $areaData[$i]["area_code"],
				"label" 	=> $areaData[$i]['area_shortPath'],
				"value" 	=> $areaData[$i]['area_shortPath']
			);			
		}	
	}
}

if(count($list) > 0) {
	echo json_encode($list); 
	exit;
} else {
	echo json_encode(array('id' => '', 'label' => 'no results')); 
	exit;
}
exit;

?>