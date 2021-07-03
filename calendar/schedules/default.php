<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/calendar.php';
require_once 'class/calendartype.php';

$calendarObject 			= new class_calendar();
$calendartypeObject	= new class_calendartype();

$calendartypeData = $calendartypeObject->pairs();
if($calendartypeData) { $smarty->assign('calendartypeData', $calendartypeData); }

if(isset($_GET['action']) && trim($_GET['action']) == 'emailall') {

	$response			= array();
	$response['result'] = true;
	$response['error'] 	= '';
	$sendemail			= isset($_POST['sendemail']) && (int)trim($_POST['sendemail']) == 1 ? true : false;
	
	if (!empty($_POST['code']) && $_POST['code'] != '') {

		$reference = trim($_POST['code']);

		$calendarData = $calendarObject->getByCode($reference);
		
		if(!$calendarData) {
			$response['result'] = false;
			$response['error'] 	= 'Please select a calendar event/meeinting to delete';
		}
	} else {
		$response['result'] = false;
		$response['error'] 	= 'Please select a calendar event/meeinting to delete';
	}
	
	
	if(!isset($calendarData)) {
		$response['result'] = false;
		$response['error'] 	= 'Please select calendar event';
	}
	
	if($response['result'] == true && $response['error'] == '') {
		
		require_once 'class/calendarattend.php';
		require_once 'class/_comms.php';
		
		$calendarattendObject	= new class_calendarattend();
		$commsObject 			= new class_comms();
		
		$idata = array();
		$idata['calendar_deleted'] = 1;
		
		$where 		= $calendarObject->getAdapter()->quoteInto('calendar_code = ?', $calendarData['calendar_code']);
		$calendarObject->update($idata, $where);
			
		$attendeeData = $calendarattendObject->getByCalendarCode($calendarData['calendar_code']);
		
		if($attendeeData) {
			
			if($sendemail == true) {
				for($i = 0; $i < count($attendeeData); $i++) {
					/* Send email to the user. */												
					$attendeeData[$i]['category']	= 'calendar_cancel';
					$attendeeData[$i]['reference']	= $calendarData['calendar_code'];
					$attendeeData[$i]['user_code']	= $attendeeData[$i]['calendarattend_user'];
					$attendeeData[$i]['user_email']	= $attendeeData[$i]['calendarattend_email'];
					$attendeeData[$i]['user_name']	= $attendeeData[$i]['calendarattend_fullname'];
					
					$success = $commsObject->sendEmailComm('mailers/calendar_cancel.html', $attendeeData[$i], 'SA-YES Cancelled : '.$attendeeData[$i]['calendartype_name'], array('email' => 'info@say-yes.com', 'name' => 'SA-YES Admin'));	
									
					$data = array();
					$data['calendarattend_reminder'] = date('Y-m-d H:i:s');
					
					$where = array();
					$where[] = $calendarattendObject->getAdapter()->quoteInto('calendar_code = ?', $calendarData['calendar_code']);
					$where[] = $calendarattendObject->getAdapter()->quoteInto('calendarattend_user = ?', $attendeeData[$i]['calendarattend_user']);
					$success = $calendarattendObject->update($data, $where);
				}
			}
		}	else {			
			$response['error'] 	= 'There are no attendees for this event, but it has been cancelled / deleted';		
		}
	}
	
	echo json_encode($response);
	die();
}

if(isset($_GET['action']) && trim($_GET['action']) == 'searchcalendar') {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$startdate 		= isset($_REQUEST['from']) && trim($_REQUEST['from']) != '' ? trim($_REQUEST['from']) : '';
	$enddate 		= isset($_REQUEST['to']) && trim($_REQUEST['to']) != '' ? trim($_REQUEST['to']) : '';
	$type 				= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';
	$userid			= isset($_REQUEST['userid']) && trim($_REQUEST['userid']) != '' ? trim($_REQUEST['userid']) : '';

	$where = ' calendar.calendar_deleted = 0 ';

	if($startdate != '' && $enddate != '') {
		$where .= ' and calendar.calendar_startdate > \''.$startdate.'\' and calendar_enddate < \''.$enddate.'\' ';
	}

	if($userid != '') {
		$where .= ' and user.user_code = \''.$userid.'\' ';
	}

	if($type != '') {
		$where .= ' and calendar.calendartype_code = \''.$type.'\' ';
	}	

	$calendarData = $calendarObject->getAll($where, 'calendar_startdate desc');

	if($calendarData) {
		$response['records'] = $calendarData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('calendar/schedules/default.tpl');

?>