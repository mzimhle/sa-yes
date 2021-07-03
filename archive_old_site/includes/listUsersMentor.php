<div class="aSection">
	<h2>Manage Mentors</h2>
	<div class="sectionContent">
	<table id="usersMentor" class="display" style="table-layout: fixed">
		<thead>
			<tr>
				<th>Given Name</th>
				<th>Surname</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Cell Phone</th>
				<th>Join Date</th>
				<th>Notes</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($currentUser instanceof Administrator) {
				$rows = $dbm -> getUsers('Mentor');

				foreach ($rows as $key => $row) {

					$id = $row['id'];
					$fname = $row['first_name'];
					$lname = $row['last_name'];
					$email = $row['email'];
					$phone = $row['phone'];
					$cphone = $row['cphone'];
					$joinDate = $row['join_date'];
					$notes = $row['notes'];

					$active = $row['active'];
					$activeCss = '';
					if (!$active) {
						$activeCss = 'class="deactivated"';
					}
					echo '<tr id="usersMentor_row' . $id . '" ' . $activeCss . '>';
					echo '<td>' . $fname . '</td>';
					echo '<td>' . $lname . '</td>';
					echo '<td>' . $email . '</td>';
					echo '<td>' . $phone . '</td>';
					echo '<td>' . $cphone . '</td>';
					echo '<td>' . $joinDate . '</td>';
					echo '<td><pre>' . $notes . '</pre></td>';
					echo '</tr>';
				}
			}
			?>
		</tbody>
	</table>
	
	<div id="usersMentorControls" class="dtControls">
		<ul>
			<li>
				<input class="button activate disabled" type="button" disabled="true" onclick="activateClicked('mentor')" value="Deactivate" />
			</li>
			<li>
				<input class="button delete disabled" type="button" disabled="true" onclick="deleteClicked('mentor')" value="Delete" />
			</li>
			<li>
				<input class="button edit disabled" type="button" disabled="true" onclick="editClicked('mentor')" value="Edit" />
			</li>
		</ul>
	</div>
		
	</div>
	<!-- Edit Box -->
	<div id="editMentor" title="Edit User Information" style="display:none">
		<form id="editMentorForm" class="form" name="editMentor" action="javascript:updateUser('editMentorUser')">
			<input id="editMentorId" type="hidden" name="userId" value="" />
			<div id="editMentorFields">
				<p>
					<label for="fname">Given Name<span class="req">*</span></label>
					<input class="input" type="text" name="firstname" value="" />
				</p>
				<p>
					<label for="lname">Surname<span class="req">*</span></label>
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
					<label for="date">Join Date</label>
					<input class="input" id="joinDateEdit" type="text" name="date" />
				</p>
				<p>
					<label for="notes">Notes</label>
					<br/>
					<textarea class="input" id="notesMentor" name="notes"></textarea>
				</p>
				
				<h3>Change Password</h3>
				<p>
					<label for="password">Password</label>
					<input class="input" id="passwordEditMentor" name="password" type="password" value="" />
				</p>
				<p>
					<label for="password2">Re-Enter Password</label>
					<input class="input" id="password2EditMentor" name="password2" type="password" value="" />
				</p>
			</div>
		</form>
	</div>
</div>