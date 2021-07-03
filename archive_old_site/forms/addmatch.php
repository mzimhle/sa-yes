<?php
session_start();
require_once('models.php');

$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm->getUser($currentUser);

$mentorId = $_POST['mentor'];
$menteeId = $_POST['mentee'];
$matchDate = $_POST['matchDate'];
$notes = $_POST['notes'];

if (isset($mentorId,$menteeId,$matchDate)) {

	$affected = $dbm->newMatch($mentorId,$menteeId,$matchDate,$notes);

	if (PEAR::isError($affected)) {
		echo '{ "error": "' . $affected -> getMessage() . '" }';
	} else {
		
		// get mentor name
		$mentor = $dbm->getUser($mentorId);
		$mentorName = $mentor->getFirstName().' '.$mentor->getLastName();
		
		// get mentee name
		$mentee = $dbm->getUser($menteeId);
		$menteeName = $mentee->getFirstName().' '.$mentee->getLastName();
		
		// get last id
		$id = $dbm->getLastMatchId();
		
		$match = array($mentorName,$menteeName,$matchDate,'<pre>'.$notes.'</pre>');
		echo '{ "matchId": "' . $id . '", "match" : ' . json_encode($match) . ' }';
	}
} else {
	//echo '{ "error": "No user specified."}';
}
?>