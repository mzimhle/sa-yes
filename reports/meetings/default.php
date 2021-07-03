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
require_once 'class/mentorship.php';

$meetingObject 		= new class_meeting();
$meetingtypeObject	= new class_meetingtype();
$mentorshipObject	= new class_mentorship();

$meetingtypeData = $meetingtypeObject->pairs();
if($meetingtypeData) { $smarty->assign('meetingtypeData', $meetingtypeData); }

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmeetings') && (isset($_REQUEST['cvs']) && (int)trim($_REQUEST['cvs']) == 1)) {

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
	$mentorship 			= isset($_REQUEST['mentorship']) && trim($_REQUEST['mentorship']) != '' ? trim($_REQUEST['mentorship']) : '';

	$mentorname 	= isset($_REQUEST['mentorsearch']) && trim($_REQUEST['mentorsearch']) != '' ? trim($_REQUEST['mentorsearch']) : '';
	$menteename 	= isset($_REQUEST['menteesearch']) && trim($_REQUEST['menteesearch']) != '' ? trim($_REQUEST['menteesearch']) : '';

	$where = ' meeting.meeting_deleted = 0 ';

	if($startdate != '' && $enddate != '') {
		$where .= ' and meeting.meeting_date between \''.$startdate.'\' and \''.$enddate.'\' ';
	}

	if($smentorid != '') {
		$where .= ' and meeting.mentor_code = '.$smentorid.' ';
	}

	if($smenteeid != '') {
		$where .= ' and meeting.mentee_code = '.$smenteeid.' ';
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

	if($mentorship != '') {
		$where .= ' and mentorship.mentorship_code = \''.$mentorship.'\' ';
	}	
	$meetingData = $meetingObject->searchAll($where, 'meeting.meeting_date desc');

	$meetingObject->download_send_headers("data_export_" . date("Y-m-d") . ".csv");
	
	if($meetingData) {
	
		$data = array();
		$i		= 0;
		
		foreach($meetingData as $item) {
				
				$data[$i]['Mentorship']				= isset($item['mentorship_name']) && trim($item['mentorship_name']) != '' ? trim($item['mentorship_name']) : 'N/A';
				$data[$i]['Created']				= isset($item['meeting_added']) && trim($item['meeting_added']) != '0000-00-00' ? trim($item['meeting_added']) : 'N/A';
				$data[$i]['Date']				= isset($item['meeting_date']) && trim($item['meeting_date']) != '0000-00-00' ? trim($item['meeting_date']) : 'N/A';
				$data[$i]['Mentor']				= isset($item['mentorname']) && trim($item['mentorname']) != '' ? trim($item['mentorname']) : 'N/A';
				$data[$i]['Mentee']				= isset($item['menteename']) && trim($item['menteename']) != '' ? trim($item['menteename']) : 'N/A';
				$data[$i]['Status']				= isset($item['meeting_status']) && (int)trim($item['meeting_status']) != 0 ? 'Yes' : 'No';
				$data[$i]['Reason']			= isset($item['meeting_reason']) && trim($item['meeting_reason']) != '' ? trim($item['meeting_reason'])  : 'N/A';
				$data[$i]['Length']				= isset($item['meeting_length']) && trim($item['meeting_length']) != '' ? trim($item['meeting_length'])  : 'N/A';
				$data[$i]['Start_Time']		= isset($item['meeting_starttime']) && trim($item['meeting_starttime']) != '' ? trim($item['meeting_starttime'])  : 'N/A';
				$data[$i]['Notes']				= isset($item['meeting_notes']) && trim($item['meeting_notes']) != '' ? stripslashes(trim($item['meeting_notes']))  : 'N/A';
				$data[$i]['Type']				= isset($item['meetingtype_name']) && trim($item['meetingtype_name']) != '' ? trim($item['meetingtype_name'])  : 'N/A';
				$data[$i]['Staff']				= isset($item['meeting_staff']) && (int)trim($item['meeting_staff']) != 0 ? 'Yes' : 'No';
				$data[$i]['Notes_Admin']	= isset($item['meeting_adminnotes']) && trim($item['meeting_adminnotes']) != '' ? stripslashes(trim($item['meeting_adminnotes']))  : 'N/A';
				
				$i++;
		}
		
		echo array2csv($data);
	}
	
	die();	

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
	$mentorship 			= isset($_REQUEST['mentorship']) && trim($_REQUEST['mentorship']) != '' ? trim($_REQUEST['mentorship']) : '';

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

	if($mentorship != '') {
		$where .= ' and mentorship.mentorship_code = \''.$mentorship.'\' ';
	}
	
	$meetingData = $meetingObject->searchAll($where, 'meeting_date desc');

	if($meetingData) {
		$response['records'] = $meetingData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('reports/meetings/default.tpl');

?>