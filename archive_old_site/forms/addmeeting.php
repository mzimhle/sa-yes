<?php
include ('debug.php');
session_start();
require_once('models.php');

$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm->getUser($currentUser);

// get meeting date and status
$date = $_POST['date'];
$status = $_POST['status'];

// build values and types array
$values = array();
$types = array();

// get meeting date
$values['date'] = $date;
array_push($types,'text');

// get meeting status
$values['status'] = $status;
array_push($types,'text');

if (isset($date,$status)) {
	
	$reason = '';	
	$startTime = '';
	$length = '';
	$meetingType = '';
	$withStaff = '';
	
	// get reason for not meeting, if set
	if ($status == 0 && isset($_POST['reason'])) {
		$reason = $_POST['reason'];
	} else if ($status == 1) {
		
		// get meeting start time
		if (isset($_POST['startTime'])) {
			$startTime = $_POST['startTime'];
		}
		
		// get meeting length
		if (isset($_POST['length'])) {
			$length = $_POST['length'];
		}
		
		// get meeting type
		if (isset($_POST['meetingType'])) {
			$meetingType = $_POST['meetingType'];
		}
		
		// get 'with staff'
		if (isset($_POST['withStaff'])) {
			$withStaff = $_POST['withStaff'];
		}
	}
	$values['reason'] = $reason;
	$values['start_time'] = $startTime;
	$values['length'] = $length;
	$values['type'] = $meetingType;
	array_push($types,'text');
	array_push($types,'text');
	array_push($types,'integer');
	array_push($types,'text');
	
	// only set staff if value is defined
	if ($withStaff != '') {
		$values['staff'] = $withStaff;
		array_push($types,'integer');
	}
	
	// get meeting notes
	$notes = '';
	if (isset($_POST['notes'])) {
		$notes = $_POST['notes'];
	}
	$values['notes'] = $notes;
	array_push($types,'text');
	
	// add new meeting to database
	$affected = $dbm->newMeeting($values,$types,$currentUser->getId());

	// return error or new meeting
	if (PEAR::isError($affected)) {
		echo '{ "error": "' . $affected -> getMessage() . '" }';
	} else {
		
		// convert status to human readable form
		if ($status == 0) $status = 'No';
		else $status = 'Yes';
		
		// convert 'with staff' to human readable form
		if ($withStaff == 0) $withStaff = 'No';
		else $withStaff = 'Yes';
		
		// get meeting id
		$id = $dbm->getLastMeetingId();
		
		$meeting = array($date,$status,$meetingType,$withStaff,$startTime,$length,$reason,'<pre>' . $notes . '</pre>');
		echo '{ "meetingId": "' . $id . '", "meeting" : ' . json_encode($meeting) . '}';
	}
} else {
	echo '{ "error": "No date or meeting status specified." }';
}

?>