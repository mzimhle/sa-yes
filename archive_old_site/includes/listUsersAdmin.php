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
?>
<div class="aSection">
	<h2>Manage Administrators</h2>
	<div class="sectionContent">
	<table id="usersAdmin" class="display">
		<thead>
			<tr>
				<th>Given Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Cell Phone</th>
				<th>Notes</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if ($currentUser instanceof Administrator) {
			$rows = $dbm -> getUsers('Administrator');
	
			foreach ($rows as $key => $row) {
	
				$id = $row['id'];	
				$fname = $row['first_name'];
				$lname = $row['last_name'];
				$email = $row['email'];
				$active = $row['active'];
				$phone = $row['phone'];
				$cphone = $row['cphone'];
				$notes = $row['notes'];
	
				echo '<tr id="usersAdmin_row'.$id.'">';
				echo '<td>' . $fname . '</td>';
				echo '<td>' . $lname . '</td>';
				echo '<td>' . $email . '</td>';
				echo '<td>' . $phone . '</td>';
				echo '<td>' . $cphone . '</td>';
				echo '<td><pre>' . $notes . '</pre></td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
	</table>
	
	<div id="usersAdminControls" class="dtControls">
		<ul>
			<li>
				<input class="button activate disabled" type="button" disabled="true" onclick="activateClicked('admin')" value="Deactivate" />
			</li>
			<li>
				<input class="button delete disabled" type="button" disabled="true" onclick="deleteClicked('admin')" value="Delete" />
			</li>
			<li>
				<input class="button edit disabled" type="button" disabled="true" onclick="editClicked('admin')" value="Edit" />
			</li>
		</ul>
	</div>
	</div>
	
	<!-- Edit Box -->
	<div id="editAdmin" title="Edit User Information" style="display:none">
		<form id="editAdminForm" class="form" name="editAdmin">
			<input id="editAdminId" type="hidden" name="userId" value="" />
			<div id="editAdminFields">
				<p>
					<label for="fname">Given Name<span class="req">*</span></label>
					<input class="input" type="text" name="firstname" value="" />
				</p>
				<p>
					<label for="lname">Surame<span class="req">*</span></label>
					<input class="input" type="text" name="lastname" value="" />
				</p>
				<p>
					<label for="email">Email<span class="req">*</span></label>
					<input class="input" type="text" name="email" value="" />
				</p>
				<p>
					<label for="phone">Phone Number</label>
					<input class="input" type="text" name="phone" value="" />
				</p>
				<p>
					<label for="cphone">Cell Phone</label>
					<input class="input" type="text" name="cphone" value="" />
				</p>
				<p>
					<label for="notes">Notes</label>
					<br/>
					<textarea class="input" id="notesAdmin" name="notes"></textarea>
				</p>
				<h3>Change Password</h3>
				<p>
					<label for="password">Password</label>
					<input class="input" id="passwordEditAdmin" name="password" type="password" value="" />
				</p>
				<p>
					<label for="password2">Re-Enter Password</label>
					<input class="input" id="password2EditAdmin" name="password2" type="password" value="" />
				</p>
			</div>
		</form>
	</div>
</div>