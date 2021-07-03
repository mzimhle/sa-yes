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

$commsObject = new class_comms();

/* Setup Pagination. */
$commsData = $commsObject->getAll('_comms._comms_code is not null','_comms._comms_added DESC');

if($commsData) { $smarty->assign_by_ref('commsData', $commsData); }

/* End Pagination Setup. */
$smarty->display('comms/comms/default.tpl');

?>