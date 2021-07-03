<?php

/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_NOTICE);

/* Check for login */
require_once 'includes/auth.php';

require_once 'class/_comms.php';

$commsObject 	= new class_comms();

if (isset($_GET['code']) && trim($_GET['code']) != '') {
	
	$code = trim($_GET['code']);
	
	$commsData = $commsObject->getByCode($code);

	if(!$commsData) {
		header('Location: /commss/');
		exit;
	}

	$smarty->assign('commsData', $commsData);
} else {
	header('Location: /commss/');
	exit;
}


$smarty->display('comms/comms/details.tpl');

?>