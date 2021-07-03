<?php
	require_once ('models.php');
	
	session_start();
	
	$dbm = DBManager::getInstance();
	
	// get current user
	$currentUser = $_SESSION['user'];
	if (!isset($currentUser)) { header('Location: index.php');
	}
	$currentUser = $dbm -> getUser($currentUser);
	
	$userType = $dbm -> getUserType($currentUser -> getId());
	
	$user = $currentUser;
	
	// define page so nav can highlight properly
	$page = 'edit';
	
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
		include_once ('nav.php');
		?>
		<div id="mainContent">
			<div id="message" class="message"></div>
			<?php
			$id = $user -> getId();
			$fname = $user -> getFirstName();
			$lname = $user -> getLastName();
			$email = $user -> getEmail();
			$phone = $user -> getPhone();
			$cphone = $user -> getCell();
			?>

			<form id="editUserSelfForm" class="form" name="editUserSelf">
				<input type="hidden" name="userId" value="<?php echo $id;?>" />
				<div class="aSection">
					<h2>Edit User Information</h2>
					<div class='sectionContent'>
						<p>
							<label for="fname">First Name:</label>
							<input class="input" type="text" name="firstname" value="<?php echo $fname ?>" />
						</p>
						<p>
							<label for="lname">Last Name:</label>
							<input class="input" type="text" name="lastname" value="<?php echo $lname ?>" />
						</p>
						<p>
							<label for="email">Email:</label>
							<input class="input" type="text" name="email" value="<?php echo $email ?>" />
						</p>
						<p>
							<label for="phone">Phone Number:</label>
							<input class="input" type="text" name="phone" value="<?php echo $phone ?>" />
						</p>
						<p>
							<label for="cphone">Cell Phone:</label>
							<input class="input" type="text" name="cphone" value="<?php echo $cphone ?>" />
						</p>
						<?php
if ($userType == 'Mentee') {
$home = $user->getHome();
						?>
						<p>
							<label for="home">Home:</label>
							<input class="input" type="text" name="home" value="<?php echo $home ?>" />
						</p>
						<?php
						}
						?>
					</div>
				</div>
				<div class="aSection">
					<h2>Change Password</h2>
					<div class='sectionContent'>
						<p>
							<label for="password">Password:</label>
							<input class="input" id="passwordEditSelf" name="password" type="password" value="" />
						</p>
						<p>
							<label for="password2">Re-Enter Password:</label>
							<input class="input" id="passwordEditSelf2" name="password2" type="password" value="" />
						</p>
					</div>
				</div>
				<input class="button" type="submit" value="Update" />
			</form>
		</div>
	</body>
</html>