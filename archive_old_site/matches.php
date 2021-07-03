<?php 
	require_once('models.php');
	
	session_start();
	
	$dbm = DBManager::getInstance();
	
	// get current user
	$currentUser = $_SESSION['user'];
	if (!isset($currentUser)) { header('Location: index.php'); }
	$currentUser = $dbm->getUser($currentUser);
	
	if (!$dbm->isAdmin($currentUser->getId())) {
		header('Location: index.php');
	}
	
	// define page so nav can highlight properly
	$page = 'matches';
	
	echo '<!DOCTYPE html>';
?>
<html>
	<head>
		<?php include_once('includes.php'); ?>
		<script type="text/javascript" src="js/matches.js"></script>
	</head>
	<body>
		<?php include_once ('header.php'); ?>
		<?php include_once('nav.php'); ?>
		
		<div id="mainContent" class="ui-widget">
			<div>
				<?php require_once 'includes/listMatches.php';?>
			</div>
			<div>
				<?php require_once 'includes/addMatch.php';?>
			</div>
			<div id="dialog-deleteConfirm" class="dialog" title="Delete the user?">
				<p>This will <span class="bold">permanently</span> delete the match. Are you sure?</p>
			</div>
		</div>
	</body>
</html>