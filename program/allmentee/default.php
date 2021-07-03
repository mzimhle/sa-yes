<?php
ini_set('memory_limit','300M');

/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/mentorship.php';

$mentorshipObject	= new class_mentorship();

$mentorshipData = $mentorshipObject->getMentees();

$mentorshipObject->download_send_headers("data_mentee_information_export_" . date("Y-m-d") . ".csv");

if($mentorshipData) {
	echo $mentorshipObject->array2csv($mentorshipData);
}

die();	

?>