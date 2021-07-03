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

	// notes
	$notes = $_POST['notes'];
	$values['notes_admin'] = $notes;
	array_push($types,'text');

	$affected = $dbm->updateMeeting($meetingId,$values,$types);

	if (PEAR::isError($affected)) {
		echo '{ "error": "' . $affected -> getMessage() . '" }';
	} else {
		echo '{ "success": "Meeting updated" }';
	}
}
?>