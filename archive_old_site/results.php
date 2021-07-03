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
	$page = 'reports';
	
	// get report name
	$report = $_GET['report'];
	
	echo '<!DOCTYPE html>';
?>
<html>
	<head>
		<?php include_once('includes.php'); ?>
		<link rel="stylesheet" media="print" href="css/report-print.css" />
		<script type="text/javascript" src="js/table-utils.js"></script>
		<?php
			if ($report == "Meeting Report") {
				echo '<script type="text/javascript" src="js/results-meetings.js"></script>';
			} else if ($report == "Meeting Status Report") {
				echo '<script type="text/javascript" src="js/results-meetingstatus.js"></script>';
			}
		?>
	</head>
	<body>
		<?php include_once ('header.php'); ?>
		<?php include_once('nav.php'); ?>
		
		<div id="mainContent" class="ui-widget">
			<?php
				if (!isset($report)) {
					echo '<div class="sectionContent"><p>No report selected.</p></div>';
				} else if ($report == "Meeting Report") {
					include('reports/meetings.php');
				} else if ($report == "Meeting Status Report") {
					include('reports/meetingstatus.php');
				}
			?>
		</div>
	</body>
</html>