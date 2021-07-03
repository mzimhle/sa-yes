<?php
session_start();
require_once('models.php');

$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm->getUser($currentUser);

$active = $_POST['active'];
$type = $_POST['type'];
$userId = $_POST['userId'];

if (isset($userId,$active,$type)) {
	
	// ensure user is authorized to make this change
	if ($currentUser instanceof Administrator) {
		try {
			$res = $dbm -> activateUser($userId,$active);
			
			// return error or userId
			if (MDB2::isError($res)) {
				echo '{ "error": "' . $res -> getMessage() . '" }';
			} else {
				echo '{ "userId" : "' . $userId . '" }';
			}
		} catch (Exception $e) {
		    echo '{ "error": "'.$e->getMessage().'"}';
		}

	}
} else {
	echo '{ "error": "No user specified."}';
}
?>