<?php
	require_once ('models.php');
	
	session_start();
	
	$dbm = DBManager::getInstance();
	
	// get current user
	$currentUser = $_SESSION['user'];
	if (!isset($currentUser)) { header('Location: index.php'); }
	$currentUser = $dbm -> getUser($currentUser);
	if (!$dbm->isAdmin($currentUser->getId())) {
		header('Location: index.php');
	}
	
	
	$userTypes = $dbm -> getUserTypes();
	
	// define page so nav can highlight properly
	$page = 'users';
	
	echo '<!DOCTYPE html>';
?>
<html>
	<head>
		<?php
		include_once ('includes.php');
		?>
		<script type="text/javascript" src="js/users.js"></script>
	</head>
	<body>
		<?php
		include_once ('header.php');
		?>
		<?php
		include_once ('nav.php');
		?>
		<div id="mainContent">
			<div id="userTabs">
				<ul>
					<li>
						<a href="#userTabs-mentor">Mentors</a>
					</li>
					<li>
						<a href="ajax.php?command=listMentees">Mentees</a>
					</li>
					<li>
						<a href="ajax.php?command=listAdmins">Administrators</a>
					</li>
				</ul>
				<div id="userTabs-mentor">
					<?php
					include_once ('includes/listUsersMentor.php');
					?>
					<?php
					include_once ('includes/addUserMentor.php');
					?>
				</div>
			</div>
		</div>
		
		<div id="dialog-deleteConfirm" class="dialog" title="Delete the user?">
			<p>This will <span style="font-weight:bold">permanently</span> remove the user and all associated data (user information, meetings, etc.) and cannot be undone. Are you sure?</p>
		</div>

	</body>
</html>