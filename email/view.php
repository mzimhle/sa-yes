<?php

/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/_comms.php';

$commsObject	= new class_comms();

if(isset($_GET['depo']) && $_GET['depo'] != '') {

	$reference = trim($_GET['depo']);

	$commData = $commsObject->getByCode($reference);
	
	if($commData) {
		$smarty->assign('commData', $commData);
	} else {
		header('Location: http://sa-yes.com/');
		exit;
	}
} else {
	header('Location: http://sa-yes.com/');
	exit;
}


echo $commData['_comms_html'];
?>