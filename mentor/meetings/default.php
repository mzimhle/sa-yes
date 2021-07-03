<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/mentor.php';
require_once 'class/meeting.php';
require_once 'class/meetingtype.php';

$meetingObject 		= new class_meeting();
$meetingtypeObject	= new class_meetingtype();

$meetingtypeData = $meetingtypeObject->pairs();
if($meetingtypeData) { $smarty->assign('meetingtypeData', $meetingtypeData); }

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmeetings') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$startdate 		= isset($_REQUEST['from']) && trim($_REQUEST['from']) != '' ? trim($_REQUEST['from']) : '';
	$enddate 		= isset($_REQUEST['to']) && trim($_REQUEST['to']) != '' ? trim($_REQUEST['to']) : '';
	$meetingstatus 	= isset($_REQUEST['meetingstatus']) && trim($_REQUEST['meetingstatus']) != '' ? trim($_REQUEST['meetingstatus']) : '';
	$type 			= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';
	$withstaff 		= isset($_REQUEST['withstaff']) && trim($_REQUEST['withstaff']) != '' ? trim($_REQUEST['withstaff']) : '';

	$where = ' meeting.meeting_deleted = 0 and meeting.mentor_code = \''.$zfsession->userData['user_code'].'\' ';

	if($startdate != '' && $enddate != '') {
		$where .= ' and meeting.meeting_date between \''.$startdate.'\' and \''.$enddate.'\' ';
	}

	if($meetingstatus != '') {
		$where .= ' and meeting.meeting_status = \''.$meetingstatus.'\' ';
	}

	if($type != '') {
		$where .= ' and meeting.meetingtype_code = \''.$type.'\' ';
	}

	if($withstaff != '') {
		$where .= ' and meeting.meeting_staff = '.$withstaff.' ';
	}

	$meetingData = $meetingObject->getAll($where, 'meeting_date desc');

	if($meetingData) {
		$response['records'] = $meetingData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('mentor/meetings/default.tpl');

?>