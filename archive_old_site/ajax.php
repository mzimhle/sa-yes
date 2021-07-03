<?php 

// include ('debug.php');
	// passes all ajax calls on to appropriate handlers in forms/ directory

	$command = $_GET['command'];

	switch($command) {
		case 'addUser':
			require_once('forms/adduser.php');
			break;
		case 'addMeeting':
			require_once('forms/addmeeting.php');
			break;
		case 'delete':
			require_once('forms/delete.php');
			break;
		case 'updateUser':
			require_once('forms/updateuser.php');
			break;
		case 'addMatch':
			require_once('forms/addmatch.php');
			break;
		case 'activate':
		case 'deactivate':
			require_once('forms/activate.php');
			break;
		case 'updateMatch':
			require_once('forms/updatematch.php');
			break;
		case 'updateMeeting':
			require_once('forms/updatemeeting.php');
			break;
		case 'listAdmins':
			require_once('includes/listUsersAdmin.php');
			require_once('includes/addUserAdmin.php');
			break;
		case 'listMentees':
			require_once('includes/listUsersMentee.php');
			require_once('includes/addUserMentee.php');
			break;
		case 'addMeetingNotes':
			require_once('forms/addmeetingnotes.php');
			break;
	}
?>