<?php 
require_once('models.php');

session_start();

$dbm = DBManager::getInstance();

// get current user
$currentUser = $_SESSION['user'];
if (!isset($currentUser)) { header('Location: index.php'); }
$currentUser = $dbm->getUser($currentUser);
?>
<html>
	<head></head>
	<body>
		<?php include_once ('header.php'); ?>
		<ul>
			<li>
				<a href="meetings.php">View Meetings</a>
			</li>
			<li>
				<a href="users.php">Manage Users</a>
			</li>
			<li>
				<a href="matches.php">Manage Matches</a> 
			</li>
		</ul>
	</body>
</html>