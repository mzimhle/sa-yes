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
	<h2>Manage Mentees</h2>
	<div class="sectionContent">
	<table id="usersMentee" class="display" style="table-layout: fixed">
		<thead>
			<tr>
				<th>Given Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Cell Phone</th>
				<th>Race</th>
				<th>Home</th>
				<th>Home Details</th>
				<th>Join Date</th>
				<th>Notes</th>
			</tr>
		</thead>
		<tbody>
		<?php
		if ($currentUser instanceof Administrator) {
			$rows = $dbm -> getUsers('Mentee');
		
			foreach ($rows as $key => $row) {
		
				$id = $row['id'];	
				$fname = $row['first_name'];
				$lname = $row['last_name'];
				$email = $row['email'];
				$phone = $row['phone'];
				$cphone = $row['cphone'];
				$race = $row['race'];
				$home = $row['home'];
				$homeDetails = $row['home_details'];
				$active = $row['active'];
				$joinDate = $row['join_date'];
				$notes = $row['notes'];
		
				echo '<tr id="usersMentee_row'.$id.'">';
				echo '<td>' . $fname . '</td>';
				echo '<td>' . $lname . '</td>';
				echo '<td class="emailCell">' . $email . '</td>';
				echo '<td>' . $phone . '</td>';
				echo '<td>' . $cphone . '</td>';
				echo '<td>' . $race . '</td>';
				echo '<td>' . $home . '</td>';
				echo '<td><pre>' . $homeDetails . '</pre></td>';
				echo '<td>' . $joinDate . '</td>';
				echo '<td><pre>' . $notes . '</pre></td>';
				echo '</tr>';
			}
		}
		?>
		</tbody>
	</table>

	<div id="usersMenteeControls" class="dtControls">
		<ul>
			<li>
				<input class="button activate disabled" type="button" disabled="true" onclick="activateClicked('mentee')" value="Deactivate" />
			</li>
			<li>
				<input class="button delete disabled" type="button" disabled="true" onclick="deleteClicked('mentee')" value="Delete" />
			</li>
			<li>
				<input class="button edit disabled" type="button" disabled="true" onclick="editClicked('mentee')" value="Edit" />
			</li>
		</ul>
	</div>
	</div>
		
	<!-- Edit Box -->
	<div id="editMentee" title="Edit User Information" style="display:none">
		<form id="editMenteeForm" class="form" name="editMentee">
			<input id="editMenteeId" type="hidden" name="userId" value="" />
			<div id="editMenteeFields">
				<p>
					<label for="fname">Given Name<span class="req">*</span></label>
					<input class="input" type="text" name="firstname" value="" />
				</p>
				<p>
					<label for="lname">Surname<span class="req">*</span></label>
					<input class="input" type="text" name="lastname" value="" />
				</p>
				<p>
					<label for="email">Email</label>
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
					<label for="race">Race</label>
					<input class="input" type="text" name="race" value="" />
				</p>
				<p>
					<label for="home">Home</label>
					<input class="input" type="text" name="home" value="" />
				</p>
				<p>
					<label for="homeDetails">Home Contact Details</label>
					<br/>
					<textarea class="input" id="homeDetailsEdit" name="homeDetails"></textarea>
				</p>
				<p>
					<label for="date">Join Date</label>
					<input class="input" id="joinDateEditMentee" type="text" name="date" />
				</p>
				<p>
					<label for="notes">Notes</label>
					<br/>
					<textarea class="input" id="notesMentee" name="notes"></textarea>
				</p>
				<h3>Change Password</h3>
				<p>
					<label for="password">Password</label>
					<input class="input" id="passwordEditMentee" name="password" type="password" value="" />
				</p>
				<p>
					<label for="password2">Re-Enter Password</label>
					<input class="input" id="password2EditMentee" name="password2" type="password" value="" />
				</p>
			</div>
		</form>
	</div>
</div>