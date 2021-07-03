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
require_once 'class/calendarattend.php';
require_once 'class/_comms.php';
require_once 'global_functions.php';

$calendarObject 				= new class_calendar();
$calendartypeObject		= new class_calendartype();
$calendarattendObject	= new class_calendarattend();
$commsObject 				= new class_comms();

$calendartypeData = $calendartypeObject->pairs();
if($calendartypeData) { $smarty->assign('calendartypeData', $calendartypeData); }

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$calendarData = $calendarObject->getByCode($reference);
	
	if($calendarData) {
		$smarty->assign('calendarData', $calendarData);
		
		$attendeeData = $calendarattendObject->getByCalendarCode($calendarData['calendar_code']);
		if($attendeeData) $smarty->assign('attendeeData', $attendeeData);
		
	} else {
		header('Location: /calendar/schedules/');
		exit;		
	}
} else if((isset($_GET['startdate']) && isset($_GET['enddate'])) && (trim($_GET['startdate']) == date('Y-m-d H:i', strtotime(trim($_GET['startdate'])))) && (trim($_GET['enddate']) == date('Y-m-d H:i', strtotime(trim($_GET['enddate']))))) {

	$smarty->assign('startdate', trim($_GET['startdate']));
	$smarty->assign('enddate', trim($_GET['enddate']));
}

if(isset($_GET['action']) && trim($_GET['action']) == 'emailall') {

	$response					= array();
	$response['result'] 		= true;
	$response['error'] 		= '';
	
	if(!isset($calendarData)) {
		$response['result'] = false;
		$response['error'] 	= 'Please select calendar event';
	}
	
	if($response['result'] == true && $response['error'] == '') {
		
		$attendeeData = $calendarattendObject->getByCalendarCode($calendarData['calendar_code']);
		
		if($attendeeData) {
		
			for($i = 0; $i < count($attendeeData); $i++) {
				/* Send email to the user. */												
				$attendeeData[$i]['category']		= 'calendar';
				$attendeeData[$i]['reference']	= $calendarData['calendar_code'];
				$attendeeData[$i]['user_code']	= $attendeeData[$i]['calendarattend_user'];
				$attendeeData[$i]['user_email']	= $attendeeData[$i]['calendarattend_email'];
				$attendeeData[$i]['user_name']	= $attendeeData[$i]['calendarattend_fullname'];
				
				$success = $commsObject->sendEmailComm('mailers/calendar.html', $attendeeData[$i], 'SA-YES Invite: '.$attendeeData[$i]['calendartype_name'], array('email' => 'info@say-yes.com', 'name' => 'SA-YES Admin'));	
								
				$data = array();
				$data['calendarattend_reminder'] = date('Y-m-d H:i:s');
				
				$where = array();
				$where[] = $calendarattendObject->getAdapter()->quoteInto('calendar_code = ?', $calendarData['calendar_code']);
				$where[] = $calendarattendObject->getAdapter()->quoteInto('calendarattend_user = ?', $attendeeData[$i]['calendarattend_user']);
				$success = $calendarattendObject->update($data, $where);
			}
		}	else {
			$response['result'] = false;
			$response['error'] 	= 'There are no attendees for this event';		
		}
	}
	
	echo json_encode($response);
	die();	
	
}

if(isset($_GET['action']) && trim($_GET['action']) == 'emailattendee') {

	$response					= array();
	$response['result'] 		= true;
	$response['error'] 		= '';
	
	
	if(!isset($_POST['attendeecode'])) {
		$response['result'] = false;
		$response['error'] 		= 'Please choose attendee';
	} else if(trim($_POST['attendeecode']) == '') {
		$response['result'] = false;
		$response['error'] 		= 'Please choose attendee';		
	}
	
	if(!isset($calendarData)) {
		$response['result'] = false;
		$response['error'] 	= 'Please select calendar event';
	}
	
	if($response['result'] == true && $response['error'] == '') {
		
		$attendeeData = $calendarattendObject->getAttendeeByCalendarCode(trim($_POST['attendeecode']), $calendarData['calendar_code']);
		
		if($attendeeData) {
		
							/* Send email to the user. */												
			$attendeeData['category']		= 'calendar';
			$attendeeData['user_code']	= $attendeeData['calendarattend_user'];
			$attendeeData['user_email']	= $attendeeData['calendarattend_email'];
			$attendeeData['user_name']	= $attendeeData['calendarattend_fullname'];
			
			$success = $commsObject->sendEmailComm('mailers/calendar.html', $attendeeData, 'SA-YES Invite: '.$attendeeData['calendartype_name'], array('email' => 'info@say-yes.com', 'name' => 'SA-YES Admin'));	
							
			$data = array();
			$data['calendarattend_reminder'] = date('Y-m-d H:i:s');
			
			$where = array();
			$where[] = $calendarattendObject->getAdapter()->quoteInto('calendar_code = ?', $calendarData['calendar_code']);
			$where[] = $calendarattendObject->getAdapter()->quoteInto('calendarattend_user = ?', $attendeeData['calendarattend_user']);
			$success = $calendarattendObject->update($data, $where);
		}	else {
			$response['result'] = false;
			$response['error'] 	= 'Attendee does exist.';		
		}
	}
	
	echo json_encode($response);
	die();	
	
}

if(isset($_GET['action']) && trim($_GET['action']) == 'deleteattendee') {
	$response					= array();
	$response['result'] 		= true;
	$response['error'] 		= '';
	
	
	if(!isset($_POST['attendeecode'])) {
		$response['result'] = false;
		$response['error'] 		= 'Please choose attendee';
	} else if(trim($_POST['attendeecode']) == '') {
		$response['result'] = false;
		$response['error'] 		= 'Please choose attendee';		
	}
	
	if(!isset($calendarData)) {
		$response['result'] = false;
		$response['error'] 	= 'Please select calendar event';
	}
	
	if($response['result'] == true && $response['error'] == '') {
	
		$data = array();
		$data['calendarattend_deleted'] = 1;
		
		$where = array();
		$where[] = $calendarattendObject->getAdapter()->quoteInto('calendar_code = ?', $calendarData['calendar_code']);
		$where[] = $calendarattendObject->getAdapter()->quoteInto('calendarattend_user = ?', trim($_POST['attendeecode']));
		$success = $calendarattendObject->update($data, $where);
			
	}
	
	echo json_encode($response);
	die();	
	
}

if(isset($_GET['action']) && trim($_GET['action']) == 'addattendee') {

	$response					= array();
	$response['result'] 		= true;
	$response['attendee']	= null;
	$response['error'] 		= '';
	
	if(!isset($calendarData)) {
		$response['result'] = false;
		$response['error'] 		= 'Please add calendar first';
	}		

	if(!isset($_POST['attendename'])) {
		$response['result'] = false;
		$response['error'] 		= 'Please add name first';
	} else if(trim($_POST['attendename']) == '') {
		$response['result'] = false;
		$response['error'] 		= 'Please add name first';		
	}
	
	if(!isset($_POST['attendeemail'])) {
		$response['result'] = false;
		$response['error'] 		= 'Please add email';
	} else if(validateEmail($_POST['attendeemail']) == '') {
		$response['result'] = false;
		$response['error'] 		= 'Please add valid email';		
	}
	
	if(isset($_POST['attendeecell']) && trim($_POST['attendeecell']) != '') {
		 if(validateCell($_POST['attendeecell']) == '') {
			$response['result'] = false;
			$response['error'] 		= 'Please add valid cell, e.g. 0735879541';		
		}
	}
	
	if(!isset($_POST['attendetype'])) {
		$response['result'] = false;
		$response['error'] 		= 'Please add name first';
	} else if(trim($_POST['attendetype']) == '') {
		$response['result'] = false;
		$response['error'] 		= 'Please add name first';		
	}
	
	if(!isset($calendarData)) {
		$response['result'] = false;
		$response['error'] 	= 'Please select calendar event';
	}
	
	if(!isset($_POST['attendeecode'])) {
		$response['result'] = false;
		$response['error'] 	= 'Please select candidate using given options';
	}
	
	if($response['result'] == true && $response['error'] == '') {
	
		$data = array();
		$data['calendar_code']					= $calendarData['calendar_code'];
		$data['calendarattend_user'] 			= trim($_POST['attendetype']) == 'custom' ? $calendarattendObject->createUserCode($calendarData['calendar_code']) : trim($_POST['attendeecode']);
		$data['calendarattend_fullname'] 	= trim($_POST['attendename']);
		$data['calendarattend_email'] 		= validateEmail(trim($_POST['attendeemail']));
		$data['calendarattend_cell'] 			= validateCell(trim($_POST['attendeecell']));
		$data['calendarattend_usertype'] 	= trim($_POST['attendetype']);
		$data['calendarattend_hascode'] 	= md5(date('Y-m-d h:i:s'));
		
		$response['attendee']	= $data['calendarattend_user'];
		
		$calendarattendObject->insert($data);
		
	}
	
	echo json_encode($response);
	die();	
}

/* Check posted data. */
if(count($_POST) > 0 && !isset($_REQUEST['action'])) {

	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	$areaByName	= NULL;
	
	if(!isset($_POST['calendartype_code'])) {
		$errorArray['calendartype_code'] = 'required';
		$formValid = false;				
	} else if(isset($_POST['calendartype_code']) && trim($_POST['calendartype_code']) == '') {
		$errorArray['calendartype_code'] = 'required';
		$formValid = false;		
	}	
		
	if(!isset($_POST['calendar_name'])) {
		$errorArray['calendar_name'] = 'required';
		$formValid = false;				
	} else if(isset($_POST['calendar_name']) && trim($_POST['calendar_name']) == '') {
		$errorArray['calendar_name'] = 'required';
		$formValid = false;		
	}		
	
	
	if(!isset($_POST['calendar_startdate'])) {
		$errorArray['calendar_startdate'] = 'required';
		$formValid = false;				
	} else if(isset($_POST['calendar_startdate']) && trim($_POST['calendar_startdate']) != date('Y-m-d H:i', strtotime(trim($_POST['calendar_startdate'])))) {
		$errorArray['calendar_startdate'] = 'required';
		$formValid = false;		
	} else {
		if(isset($_POST['calendar_enddate']) && trim($_POST['calendar_enddate']) != date('Y-m-d H:i', strtotime(trim($_POST['calendar_enddate'])))) {
			$errorArray['calendar_enddate'] = 'required';
			$formValid = false;		
		} else {
			
			$startdate = strtotime(trim($_POST['calendar_startdate']));
			$enddate = strtotime(trim($_POST['calendar_enddate']));

			if($startdate > $enddate) {
				$errorArray['calendar_enddate'] = 'required';
				$formValid = false;					
			}
		}	
	}	
	
	if(!isset($_POST['calendar_description'])) {
		$errorArray['calendar_description'] = 'required';
		$formValid = false;				
	} else if(isset($_POST['calendar_description']) && strlen(trim($_POST['calendar_description'])) < 10) {
		$errorArray['calendar_description'] = 'required';
		$formValid = false;		
	}

	if(!isset($_POST['calendar_address'])) {
		$errorArray['calendar_address'] = 'required';
		$formValid = false;				
	} else if(isset($_POST['calendar_address']) && trim($_POST['calendar_address']) == '') {
		$errorArray['calendar_address'] = 'required';
		$formValid = false;		
	}
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		/* required.	*/
		$data['calendartype_code'] 	= trim($_POST['calendartype_code']);	
		$data['user_code'] 					= $zfsession->userData['user_code'];
		$data['calendar_name'] 			= trim($_POST['calendar_name']);	
		$data['calendar_startdate'] 	= trim($_POST['calendar_startdate']);				
		$data['calendar_enddate'] 		= trim($_POST['calendar_enddate']);		
		$data['calendar_address'] 		= trim($_POST['calendar_address']);	
		$data['calendar_description'] 	= htmlspecialchars_decode(stripslashes(trim($_POST['calendar_description'])));	

		if(isset($calendarData)) {
			/*Update. */
			$where = $calendarObject->getAdapter()->quoteInto('calendar_code = ?', $calendarData['calendar_code']);
			$success = $calendarObject->update($data, $where);
		} else {
			/* Insert. */
			$success = $calendarObject->insert($data);
		}	
				
		header('Location: /calendar/schedules/');
		exit;		
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
	
}

 /* Display the template  */	
$smarty->display('calendar/schedules/details.tpl');
?>