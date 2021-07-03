<div class="aSection" style="text-align: right">
	<span class="bold">Mentee:</span> 
	<?php 
		$menteeId = $dbm->getCurrentMentee($currentUser->getId());
		$mentee = $dbm->getUser($menteeId);
		echo $mentee->getFirstName().' '.$mentee->getLastName();
	?>
	<br/>
	<span class="bold">Match Date:</span>
	<?php 
		echo $dbm->getMatchDate($currentUser->getId(),$menteeId);
	?>
</div>
<div class="aSection">
	<h2>Add a Meeting</h2>
	<div class="aSection">
	<div class='sectionContent'>
		<form id="addMeeting" name="addMeeting" method="POST">
			<!-- Meeting Date -->
			<p>
				<label for="date">Meeting Date<span class="req">*</span></label>
				<input class="input" id="meetingDate" type="text" name="date" />
			</p>
			
			<!-- Meeting Status -->
			<p>
				<label>Did you meet?<span class="req">*</span></label>
				<input type="radio" name="status" value="1" checked="checked" />
				Yes
				<input type="radio" name="status" value="0" />
				No
			</p>
			
			<!-- Meeting Status Reason-->
			<p id="statusReasonOptsWrap">
				<label for="reason" style="width:40em">If you did not meet, what was the reason?<span class="req">*</span></label>
				<br/>
				<select id="statusReasonOpts" name="statusReasonOpts">
					<option value="Illness">Illness</option>
					<option value="Schedule conflict mentee">Schedule conflict mentee</option>
					<option value="Schedule conflict mentor">Schedule conflict mentor</option>
					<option value="Vacation">Vacation</option>
					<option value="School holiday">School Holiday</option>
					<option value="Mentee no show">Mentee no show</option>
					<option value="Mentor no show">Mentor no show</option>
					<option value="Communication breakdown">Communication breakdown</option>
					<option value="Other">Other</option>
				</select>
			</p>
			
			<!-- Meeting Status Reason (Other) -->
			<p id="statusReasonOtherWrap">
				<label style="width:40em">Please specify the reason<span class="req">*</span></label>
				<br/>
				<input class="input" id="statusReasonOther" type="text" name="reason" />
			</p>
			
			<div id="statusYesItems">
				
				<!-- Meeting Start Time -->
				<p>
					<label for="date">Meeting Start Time</label>
					<input class="input hasDatePicker" id="meetingTime" type="text" name="time" />
				</p>
				
				<!-- Meeting Length -->
				<p>
					<label for="date">Meeting Length</label>
					<input class="input" id="meetingLength" type="text" name="length" />
				</p>
				
				<!-- Meeting Type -->
				<p>
					<label for="date">Meeting Type</label>
					<select id="typeOpts" name="typeOpts">
						<option value="In Person">In Person</option>
						<option value="Phone">Phone</option>
						<option value="Skype">Skype</option>
					</select>
				</p>
				
				<!-- With SA-YES staff?-->
				<p>
					<label for="withStaff">Was the meeting with SA-YES staff?</label>
					<input type="radio" id="withStaffYes" name="withStaff" value="1" checked="checked" /> Yes
					<input type="radio" id="withStaffNo" name="withStaff" value="0" /> No
				</p>				
			</div>
			<br />
			
			<!-- Meeting Notes -->
			<p>
				<label for="date">Meeting Notes</label>
				<br/>
				<textarea class="input" id="meetingNotes" name="notes"></textarea>
			</p>
			
			<p>
				<input class="button" type="submit" value="Save Meeting" />
			</p>
		</form>
	</div>
</div>

	<h2>View Meetings</h2>
	<div class='sectionContent'>
		<table id="meetings" class="display userMeetings" style="table-layout: fixed">
			<thead>
				<tr>
					<th>Date</th>
					<th>Meeting Status</th>
					<th>Type</th>
					<th>With Staff</th>
					<th>Start Time</th>
					<th>Length (hours)</th>
					<th>Reason</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$rows = $dbm -> getMeetings($currentUser -> getId());
				// echo count($rows);
				foreach ($rows as $key => $row) {
					$id = $row['id'];
					$date = $row['date'];
					$status = $row['status'];
					$type = $row['type'];
					$withStaff = $row['staff'];
					$startTime = $row['start_time'];
					$length = $row['length'];
					$reason = $row['reason'];
					$notes = $row['notes'];

					echo '<tr id="meetings_row' . $id . '">';

					echo "<td>$date</td>";

					if ($status == 0)
						$status = 'No';
					else
						$status = 'Yes';
					echo "<td>$status</td>";
					
					echo "<td>$type</td>";
					
					if ($withStaff == 0)
						$withStaff = 'No';
					else
						$withStaff = 'Yes';
					echo "<td>$withStaff</td>";
					
					echo "<td>$startTime</td>";
					echo "<td>$length</td>";
					echo "<td>$reason</td>";
					echo "<td><pre>$notes</pre></td>";

					echo '</tr>';
				}
				?>
			</tbody>
		</table>
		<div id="meetingsControls" class="dtControls">
			<ul>
				<li>
					<input class="button delete disabled" type="button" disabled="true" onclick="deleteClicked()" value="Delete" />
				</li>
				<li>
					<input class="button edit disabled" type="button" disabled="true" onclick="editClicked()" value="Edit" />
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- Edit Box -->
<div id="editMeeting" title="Edit Meeting Information" style="display:none">
	<form id="editMeetingForm" name="editMeeting">
		<input id="editMeetingId" type="hidden" name="meetingId" value="" />
		<div id="editMeetingFields">
			<p>
				<label for="meetingDate">Meeting Date<span class="req">*</span></label>
				<input class="input" id="meetingDateField" name="meetingDate" type="text"  tabindex="-1"/>
			</p>
			<p>
				<label for="meetingStatus">Meeting Status<span class="req">*</span></label>
				<input id="meetingStatusYes" name="meetingStatus" type="radio" value="1" />
				Yes
				<input id="meetingStatusNo" name="meetingStatus" type="radio" value="0" />
				No
			</p>
			<p id="statusReasonOptsEditWrap">
				<label for="statusReason" style="width:40em">If you did not meet, what was the reason?</label>
				<br/>
				<select id="statusReasonOptsEdit" name="statusReasonOpts">
					<option value="Illness">Illness</option>
					<option value="Schedule conflict mentee">Schedule conflict mentee</option>
					<option value="Schedule conflict mentor">Schedule conflict mentor</option>
					<option value="Vacation">Vacation</option>
					<option value="School holiday">School Holiday</option>
					<option value="Mentee no show">Mentee no show</option>
					<option value="Mentor no show">Mentor no show</option>
					<option value="Communication breakdown">Communication breakdown</option>
					<option value="Other">Other</option>
				</select>
			</p>
			<p id="statusReasonOtherEditWrap">
				<label style="width:40em">Please specify the reason</label>
				<br/>
				<input class="input" id="statusReasonOtherEdit" name="statusReasonOther" type="text" />
			</p>
			<div id="statusYesItemsEdit">
				<p>
					<label for="date">Meeting Start Time</label>
					<input class="input hasDatePicker" id="meetingTimeEdit" type="text" name="time" />
				</p>
				<p>
					<label for="date">Meeting Length</label>
					<input class="input" id="meetingLengthEdit" type="text" name="length" />
				</p>
				<p>
					<label for="date">Meeting Type</label>
					<select id="typeOptsEdit" name="typeOpts">
						<option value="In Person">In Person</option>
						<option value="Phone">Phone</option>
						<option value="Skype">Skype</option>
					</select>
				</p>
				
				<!-- With SA-YES staff?-->
				<p>
					<label for="withStaffEdit">Was the meeting with SA-YES staff?</label>
					<input type="radio" id="withStaffYesEdit" name="withStaffEdit" value="1" checked="checked" /> Yes
					<input type="radio" id="withStaffNoEdit" name="withStaffEdit" value="0" /> No
				</p>
				
			</div>
			<p>
				<label for="date">Meeting Notes</label>
				<br/>
				<textarea class="input" id="meetingNotesEdit" name="notes"></textarea>
			</p>
		</div>
	</form>
</div>