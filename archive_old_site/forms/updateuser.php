<?php
require_once('models.php');

session_start();

$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm->getUser($currentUser);

$userId = $_POST['id'];

// ensure user is authorized to make this change
if ($dbm->isAdmin($currentUser->getId()) || $currentUser->getId() == $userId || $dbm -> getCurrentMentee($currentUser->getId()) == $userId) {
		
	$userType = $_POST['userType'];
	
	$email = $_POST['email'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
	$cphone = $_POST['cphone'];
	$password = $_POST['password'];
	$home = $_POST['home'];
	$homeDetails = $_POST['homeDetails'];
	$joinDate = $_POST['date'];
	$notes = $_POST['notes'];
	$race = $_POST['race'];

	// if true, don't set non-specified values to null in db
	$selective = $_POST['selective'];
	if (isset($selective) && $selective == 'true') {
		$updatedUser = $dbm -> getUser($userId);
	} else if ($userType == "mentee") {
		$updatedUser = new Mentee();
	} else if ($userType == "mentor") {
		$updatedUser = new Mentor();
	} else {
		$updatedUser = new User();
	}
	
	if ($userType == "mentee") {
		$updatedUser->setHome($home);
		$updatedUser->setHomeDetails($homeDetails);
		$updatedUser->setJoinDate($joinDate);
		$updatedUser->setRace($race);
	} else if ($userType == "mentor") {
		$updatedUser->setJoinDate($joinDate);
	}

	$updatedUser->setId($userId);
	$updatedUser->setFirstName($fname);
	$updatedUser->setLastName($lname);
	$updatedUser->setEmail($email);
	$updatedUser->setPhone($phone);
	$updatedUser->setCell($cphone);
	$updatedUser->setNotes($notes);
		
	if (isset($password)) {
		$updatedUser->setPassword($password);
	}

	$affected = $dbm->updateUser($updatedUser);

	if (PEAR::isError($affected)) {
		echo '{ "error": "' . $affected -> getMessage() . '" }';
	} else {
		echo '{ "success": "User updated", "userType" : "' . $userType . '" }';
	}		
} else {
	echo '{ "error": "You are not authorized to make this change." }';
}
?>