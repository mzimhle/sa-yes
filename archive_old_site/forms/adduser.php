<?php
session_start();
require_once('models.php');

$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm -> getUser($currentUser);

$tableId = $_POST['table'];

$email = $_POST['email'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$group = $_POST['group'];
$phone = $_POST['phone'];
$cphone = $_POST['cphone'];
$mentee = $_POST['mentee'];
$race = $_POST['race'];
$home = $_POST['home'];
$homeDetails = $_POST['homeDetails'];
$joinDate = $_POST['joinDate'];
$notes = $_POST['notes'];

// ensure user is authorized to make this change
if ($dbm -> isAdmin($currentUser -> getId()) && isset($email, $password, $fname, $lname)) {

	try {

		switch($group) {
			case 'Administrator' :
				$user = new Administrator();
				break;
			case 'Mentor' :
				$user = new Mentor();
				if (isset($mentee)) {
					$user -> setMenteeId($mentee);
				}
				if (isset($joinDate)) {
					$user -> setJoinDate($joinDate);
				}
				break;
			case 'Mentee' :
				$user = new Mentee();
				if (isset($race)) {
					$user -> setRace($race);
				}
				if (isset($home)) {
					$user -> setHome($home);
					$user -> setHomeDetails($homeDetails);
				}
				if (isset($joinDate)) {
					$user -> setJoinDate($joinDate);
				}
				break;
			default :
				$user = new User();
		}
		
		$user -> setFirstName($fname);
		$user -> setLastName($lname);
		if (isset($email)) {
			$user -> setEmail($email);
		}
		if (isset($password)) {
			$user -> setPassword($password);
		}
		$user -> setPhone($phone);
		$user -> setCell($cphone);
		$user -> setNotes($notes);

		// save the new user to the db
		$affected = $dbm -> newUser($user);

		// get last id
		$id = $dbm->getLastUserId();

		if (PEAR::isError($affected)) {
			$message = $affected -> getMessage();
			if (strpos($message,'constraint violation') > 0) {
				echo '{ "error": "A user with this email address already exists." }';
				die();
			} else {
				echo '{ "error": "' . $affected -> getMessage() . '" }';
			}
		} else {
			
			// build array of values to send back to data table
			if (!isset($email)) $email = '';
			$array = array($fname,$lname,$email,$phone,$cphone);
			if ($user instanceof Mentee) {
				array_push($array,$race);
				array_push($array,$home);
				array_push($array,'<pre>'.$homeDetails.'</pre>');
				array_push($array,$joinDate);
			} else if ($user instanceof Mentor) {
				array_push($array,$joinDate);
			}
			array_push($array,$notes);

			echo '{ "userType" : "' . $group . '", "user" : '. json_encode($array) .', "userId" : '.$id.', "tableId" : "'.$tableId.'" }';
		}
	} catch (Exception $e) {
		echo '{ "error": "' . $e -> getMessage() . '" }';
	}
} else {
	echo '{ "error": "A value is missing or you are not authorized to make this change." }';
}
?>