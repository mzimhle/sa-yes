<?php
require_once('debug.php');
require_once('models.php');

session_start();

$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm->getUser($currentUser);

$meetingId = $_POST['id'];

$meetingOwner = $dbm->getMeetingOwner($meetingId);

// ensure user is authorized to make this change
if ($dbm->isAdmin($currentUser->getId()) || $meetingOwner == $currentUser->getId()) {

	$meetingId = $_POST['id'];
	
	// build the values and types arrays to be used for the update query
	$values = array();
	$types = array();

	// date
	$meetingDate = $_POST['date'];
	$values['date'] = $meetingDate;
	array_push($types,'text');

	// status
	$meetingStatus = $_POST['status'];
	$values['status'] = $meetingStatus;
	array_push($types,'integer');

	// meeting type
	$meetingType = $_POST['meetingType'];
	//$values['type'] = $meetingType;
	//array_push($types,'text');
	
	// with staff
	$withStaff = $_POST['withStaff'];
	//$values['staff'] = $withStaff;
	//array_push($types,'boolean');
	
	// reason
	$statusReason = $_POST['reason'];
	$values['reason'] = $statusReason;
	array_push($types,'text');
	
	// start time
	$startTime = $_POST['startTime'];
	$values['start_time'] = $startTime;
	array_push($types,'text');
	
	// length
	$length = $_POST['length'];
	$values['length'] = $length;
	array_push($types,'double');
	
	// notes
	$notes = $_POST['notes'];
	$values['notes'] = $notes;
	array_push($types,'text');

	$affected = $dbm->updateMeeting($meetingId,$values,$types);

	if (PEAR::isError($affected)) {
		echo '{ "error": "' . $affected -> getMessage() . '" }';
	} else {
		echo '{ "success": "Meeting updated" }';
	}		
}
?>