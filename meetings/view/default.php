<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/meeting.php';
require_once 'class/meetingtype.php';

$meetingObject 			= new class_meeting();
$meetingtypeObject	= new class_meetingtype();

$meetingtypeData = $meetingtypeObject->pairs();
if($meetingtypeData) { $smarty->assign('meetingtypeData', $meetingtypeData); }

if(isset($_GET['code_delete'])) {
	
	$errorArray				= array();
	$errorArray['error']	= '';
	$errorArray['result']	= 0;
	$success				= NULL;
	$code					= trim($_GET['code_delete']);
		
	if($errorArray['error']  == '' && $errorArray['result']  == 0 ) {
		$data	= array();
		$data['meeting_deleted'] = 1;
		
		$where		= $meetingObject->getAdapter()->quoteInto('meeting_code = ?', $code);
		$success	= $meetingObject->update($data, $where);
		
		if($success) {
			$errorArray['error']	= '';
			$errorArray['result']	= 1;			
		} else {
			$errorArray['error']	= 'Could not delete, please try again.';
			$errorArray['result']	= 0;				
		}
	}
	
	echo json_encode($errorArray);
	exit;
}

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmeetings') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$startdate 		= isset($_REQUEST['from']) && trim($_REQUEST['from']) != '' ? trim($_REQUEST['from']) : '';
	$enddate 			= isset($_REQUEST['to']) && trim($_REQUEST['to']) != '' ? trim($_REQUEST['to']) : '';
	$smentorid 		= isset($_REQUEST['smentorid']) && trim($_REQUEST['smentorid']) != '' ? trim($_REQUEST['smentorid']) : '';
	$smenteeid 		= isset($_REQUEST['smenteeid']) && trim($_REQUEST['smenteeid']) != '' ? trim($_REQUEST['smenteeid']) : '';
	$meetingstatus 	= isset($_REQUEST['meetingstatus']) && trim($_REQUEST['meetingstatus']) != '' ? trim($_REQUEST['meetingstatus']) : '';
	$type 				= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';
	$withstaff 			= isset($_REQUEST['withstaff']) && trim($_REQUEST['withstaff']) != '' ? trim($_REQUEST['withstaff']) : '';

	$mentorname 	= isset($_REQUEST['mentorsearch']) && trim($_REQUEST['mentorsearch']) != '' ? trim($_REQUEST['mentorsearch']) : '';
	$menteename 	= isset($_REQUEST['menteesearch']) && trim($_REQUEST['menteesearch']) != '' ? trim($_REQUEST['menteesearch']) : '';

	$where = ' meeting.meeting_deleted = 0 ';

	if($startdate != '' && $enddate != '') {
		$where .= ' and meeting.meeting_date between \''.$startdate.'\' and \''.$enddate.'\' ';
	}

	if($smentorid != '') {
		$where .= ' and meeting.mentor_code = \''.$smentorid.'\' ';
	}

	if($smenteeid != '') {
		$where .= ' and meeting.mentee_code = \''.$smenteeid.'\' ';
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
$smarty->display('meetings/view/default.tpl');

?>