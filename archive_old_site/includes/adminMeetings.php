<table id="meetings" class="display adminMeetings" style="table-layout: fixed">
	<thead>
	<tr>
		<th style="width: 9em">Date</th>
		<th style="width: 11em">Mentor Name</th>
		<th style="width: 11em">Mentee Name</th>
		<th style="width: 8em">Meeting Status</th>
		<th style="width: 8em">Type</th>
		<th style="width: 7em">With Staff</th>
		<th style="width: 8em">Start Time</th>
		<th style="width: 8em">Length (hours)</th>
		<th>Reason</th>
		<th>Notes</th>
		<th>Admin Notes</th>
	</tr>
	</thead>
	<tbody>
	<?php

		$rows = $dbm -> getMeetings();

		foreach ($rows as $key => $row) {
			$id = $row['id'];
			$date = $row['date'];
			$status = $row['status'];
			$mentorId = $row['mentor'];
			$menteeId = $row['mentee'];
			$type = $row['type'];
			$withStaff = $row['staff'];
			$startTime = $row['start_time'];
			$length = $row['length'];
			$reason = $row['reason'];
			$notes = $row['notes'];
			$adminNotes = $row['notes_admin'];
			$active = $row['active'];

			// get display names
			$mentor = $dbm->getDisplayName($mentorId);
			$mentee = $dbm->getDisplayName($menteeId);

			echo '<tr id="row' . $id . '">';

			echo "<td>$date</td>";
			echo "<td>$mentor</td>";
			echo "<td>$mentee</td>";

			// status
			if ($status == 0)
				$status = 'No';
			else
				$status = 'Yes';
			echo "<td>$status</td>";

			// meeting type
			echo "<td>$type</td>";
			
			// with staff
			if ($withStaff == 0)
				$withStaff = 'No';
			else
				$withStaff = 'Yes';
			echo "<td>$withStaff</td>";
					
			echo "<td>$startTime</td>";
			echo "<td>$length</td>";
			echo "<td>$reason</td>";
			echo "<td><pre>$notes</pre></td>";
			echo "<td><pre>$adminNotes</pre></td>";
			echo "<td>$active</td>";

			echo '</tr>';
		}
	?>
	</tbody>
	<tfoot>
		<tr>
			<th><input type="text" name="search_date" value="Search dates" class="search_init" /></th>
			<th><input type="text" name="search_mentor" value="Search mentors" class="search_init" /></th>
			<th><input type="text" name="search_mentee" value="Search mentees" class="search_init" /></th>
			<th><input type="text" name="search_status" value="Search statuses" class="search_init" /></th>
			<th><input type="text" name="search_reason" value="Search types" class="search_init" /></th>
			<th><input type="text" name="search_reason" value="Search with staff" class="search_init" /></th>
			<th><input type="text" name="search_reason" value="Search start time" class="search_init" /></th>
			<th><input type="text" name="search_reason" value="Search length" class="search_init" /></th>
			<th><input type="text" name="search_reason" value="Search reason" class="search_init" /></th>
			<th><input type="text" name="search_reason" value="Search notes" class="search_init" /></th>
		</tr>
	</tfoot>
</table>

<div id="addAdminNotes" title="Edit Admin Notes" style="display:none">
		<form id="addAdminNotesForm" class="form" name="addAdminNotes">
			<input id="addNotesId" type="hidden" name="meetingId" value="" />
			<div>
				<p>
					<label for="fname">Admin Notes</label>
					<textarea id="addAdminNotesField" class="input" name="adminNotes" />
				</p>
			</div>
		</form>
	</div>
