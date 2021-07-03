<?php
	require_once('models.php');
	
	session_start();
	
	$dbm = DBManager::getInstance();
	
	$currentUser = $_SESSION['user'];
	if (!isset($currentUser)) { header('Location: index.php'); }
	$currentUser = $dbm->getUser($currentUser);

	echo '<!DOCTYPE html>';
?>
<html>
	<head>
		<?php
		include_once ('includes.php');
		?>
	</head>
	<body>
		<?php
		include_once ('header.php');
		?>
		<h2>Edit User</h2>
		<div class="message"></div>
		<?php
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				
				$sql = "SELECT * FROM users WHERE users.id = '$id'";
				$res = doQuery($sql);
				while ($row = $res -> fetchRow(MDB2_FETCHMODE_ASSOC)) {
					$id = $row['id'];
					$fname = $row['first_name'];
					$lname = $row['last_name'];
					$email = $row['email'];
					$active = $row['active'];
					$groupId = $row['user_group'];
					$phone = $row['phone'];
					$cphone = $row['cphone'];
		?>

		<form name="editUser" action="javascript:updateUser()">
			<input type="hidden" name="userId" value="<?php echo $id; ?>" />
			<p>
				<label for="fname">First Name:</label>
				<input type="text" name="firstname" value="<?php echo $fname ?>" />
			</p>
			<p>
				<label for="lname">Last Name:</label>
				<input type="text" name="lastname" value="<?php echo $lname ?>" />
			</p>
			<p>
				<label for="email">Email:</label>
				<input type="text" name="email" value="<?php echo $email ?>" />
			</p>
			<p>
				<label for="phone">Phone Number:</label>
				<input type="text" name="phone" value="<?php echo $phone ?>" />
			</p>
			<p>
				<label for="cphone">Cell Phone:</label>
				<input type="text" name="cphone" value="<?php echo $cphone ?>" />
			</p>
			<input type="submit" value="Update" />
		</form>
		<?php
				}
			}
		?>
	</body>
</html>