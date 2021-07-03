<?php
require_once('models.php');

session_start();

$dbm = DBManager::getInstance();

$email = $_POST['email'];
$password = $_POST['password'];
if (isSet($email,$password)) {

	$userId = $dbm->doLogin($email,$password);
	
	$error = null;
	if (PEAR::isError($userId)) {
		$error = "error";
	}

	if ($userId == false) {
		$error = 'Authentication Failed';		
	} else {
		if ($userId != null) {
			$_SESSION['user'] = $userId;
		}
	} 
	
	
}

if (isset($_SESSION['user'])) {

	$currentUserId = $_SESSION['user'];
	$currentUser = $dbm->getUser($currentUserId);
		
	if ($dbm->isAdmin($currentUser->getId()) || $dbm->isMentor($currentUser->getId())) {
		header('Location: meetings.php');			
	} else {
		header('Location: user.php');
	}
}

echo '<!DOCTYPE html>';

?>
<html>
	<head>
		<?php include('includes.php'); ?>
		<script>
			jQuery(document).ready(function(){
			    jQuery("#loginForm").validate({
			    	wrapper: "div"
			    });
			  });
		</script>
	</head>
<body>
	<?php include_once('header.php'); ?>
	<div id="loginPage" class="mainContent">
		<div id="loginWrap">
			<h3>Log In</h3>
			<form id="loginForm" method="POST">
				<div id="loginError"><?php echo $error; ?></div>
				<p>
				<label for="email">Email:</label>
				<input id="email" name="email" type="text" class="input required email" />
				</p>
				<p>
				<label for="password">Password:</label>
				<input id="password" name="password" type="password" class="input required" />
				</p>
				<p>
				<input class="button" type="submit" class="submit" value="Log In" />
				</p>
			</form>
		</div>
	</div>

</body>
</html>