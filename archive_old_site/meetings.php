<?php
	require_once('models.php');
	
	session_start();
	
	$dbm = DBManager::getInstance();
	
	$currentUser = $_SESSION['user'];
	if (!isset($currentUser)) { header('Location: index.php'); }
	$currentUser = $dbm->getUser($currentUser);
	
	$isAdmin = $dbm->isAdmin($currentUser->getId());
	$isMentor = $dbm->isMentor($currentUser->getId());
	if (!isAdmin && !isMentor) {
		header('Location: index.php');
	}
	
	// define page so nav can highlight properly
	$page = 'meetings';
	
	echo '<!DOCTYPE html>';
?>
<html>
	<head>
		<?php include_once('includes.php'); ?>
		<script type="text/javascript" src="js/meetings.js"></script>
	</head>
<body>
	<?php include_once('header.php'); ?>
	<?php include_once('nav.php'); ?>
	<div id="mainContent" class="ui-widget">
		<div class="aSection">
			<?php
				if ($dbm->isAdmin($currentUser->getId())) {
					require_once 'includes/adminMeetings.php';		
				} else {
					require_once('includes/userMeetings.php');
				}
			?>	
			<div style="clear:both"></div>
		</div>
		<div id="dialog-deleteConfirm" class="dialog" title="Delete the meeting?">
			<p>This will <span style="font-weight:bold">permanently</span> remove the meeting and cannot be undone. Are you sure?</p>
		</div>
	</div>
</body>
</html>