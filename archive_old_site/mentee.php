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
	$page = 'mentee';
	
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
			$menteeId = $dbm->getCurrentMentee($currentUser->getId());
			$mentee = $dbm->getUser($menteeId);
			
			$fname = $mentee -> getFirstName();
			$lname = $mentee -> getLastName();
			$email = $mentee -> getEmail();
			$phone = $mentee -> getPhone();
			$cphone = $mentee -> getCell();
			$home = $mentee -> getHome();
			$homeDetails = $mentee -> getHomeDetails();
			
			if ($phone == "") { $phone = '&nbsp;'; }
			if ($cphone == "") { $cphone = '&nbsp;'; }
			?>

			<form id="mentorMenteeEditForm" class="form" name="menteeEditForm">
				<input type="hidden" name="userId" value="<?php echo $menteeId;?>" />
				<div class="aSection">
					<h2>View/Edit Mentee Information</h2>
					<div class='sectionContent'>
						<p>
							<label for="fname">First Name:</label>
							<?php echo $fname ?>
						</p>
						<p>
							<label for="lname">Last Name:</label>
							<?php echo $lname ?>
						</p>
						<p>
							<label for="email">Email:</label>
							<?php echo $email ?>
						</p>
						<p>
							<label for="phone">Phone Number:</label>
							<span><?php echo $phone ?></span>
						</p>
						<p>
							<label for="cphone">Cell Phone:</label>
							<span><?php echo $cphone ?></span>
						</p>
						<p>
							<label for="home">Home:</label>
							<input class="input" type="text" name="home" value="<?php echo $home ?>" />
						</p>
						<p>
							<label for="homeDetails">Home Contact Details</label>
							<br/>
							<textarea class="input" name="homeDetails"><?php echo $homeDetails; ?></textarea>
						</p>
						<input class="button" type="submit" value="Update" />
					</div>
				</div>
			</form>
		</div>
	</body>
</html>