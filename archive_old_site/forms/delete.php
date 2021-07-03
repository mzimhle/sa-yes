<?php
session_start();
require_once('models.php');
$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm -> getUser($currentUser);

$id = $_POST['id'];
$type = $_POST['type'];
$tableId = $_POST['table'];

if (isset($id,$type)) {

	// delete meeting
	if ($type === 'meeting') {
		
		$res = $dbm->deleteMeeting($id);
		
		// send response
		if (PEAR::isError($res)) {
			echo '{ "error": "' . $res -> getMessage() . '" }';
		} else {
			echo '{ "id" : "' . $id . '" }';
		}
	} 
	
	// delete user
	else if ($type === 'user') {
		$res = $dbm->deleteUser($id);

		// send response
		if (PEAR::isError($res)) {
			echo '{ "error": "' . $res -> getMessage() . '" }';
		} else {
			echo '{ "id" : "' . $id . '", "tableId" : "' . $tableId . '" }';
		}
	}
	
	// delete match
	else if ($type === 'match') {

		$res = $dbm->deleteMatch($id);
		
		// send response
		if (PEAR::isError($res)) {
			echo '{ "error": "' . $res -> getMessage() . '" }';
		} else {
			echo '{ "id" : "' . $id . '" }';
		}
	}
	
	else {
		echo '{ "error" : "Item could not be deleted." }';
	}

} else {
	echo '{ "error": "No item to delete was specified."}';
}

?>