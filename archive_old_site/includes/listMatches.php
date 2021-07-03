<div class="aSection">
	<h2>View Matches</h2>
	<div class="sectionContent">
	<table id="matches" class="display">
		<thead>
			<tr>
				<th>Mentor Name</th>
				<th>Mentee Name</th><br/>
				<th>Match Date</th>
				<th>Notes</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$matches = $dbm -> getMatches();
			
				foreach ($matches as $key => $match) {
			
					$matchId = $match['id'];
					$mentorId = $match['mentor'];	
					$menteeId = $match['mentee'];
					$matchDate = $match['match_date'];
					$notes = $match['notes'];
			
					// get mentor name
					$mentor = $dbm->getUser($mentorId);
					$mentorName = $mentor->getFirstName().' '.$mentor->getLastName();
					
					// get mentee name
					$mentee = $dbm->getUser($menteeId);
					$menteeName = $mentee->getFirstName().' '.$mentee->getLastName();
					
					echo '<tr id="matches_row'.$matchId.'">';
					echo '<td>' . $mentorName . '</td>';
					echo '<td>' . $menteeName . '</td>';
					echo '<td>' . $matchDate . '</td>';
					echo '<td><pre>' . $notes . '</pre></td>';
					echo '</tr>';
				}
			?>
		</tbody>
		<tfoot>
		<tr>
			<th><input type="text" name="search_mentor" value="Search mentors" class="search_init" /></th>
			<th><input type="text" name="search_mentee" value="Search mentees" class="search_init" /></th>
			<th><input type="text" name="search_date" value="Search dates" class="search_init" /></th>
			<th><input type="text" name="search_notes" value="Search notes" class="search_init" /></th>
		</tr>
	</tfoot>
	</table>
	
	<div id="matchesControls" class="dtControls">
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
	<!-- Edit Box -->
	<div id="editMatch" title="Edit Match Information" style="display:none">
		<form id="editMatchForm" class="form" name="editMatch">
			<input id="editMatchId" type="hidden" name="matchId" value="" />
			<div id="editMatchFields">
				<h2>Match Information</h2>
				<p>
					<label for="mentorName">Mentor Name:</label>
					<span id="mentorNameField"></span>
				</p>
				<p>
					<label for="menteeName">Mentee Name:</label>
					<span id="menteeNameField"></span>
				</p>
				<p>
					<label for="matchDate">Match Date:</label>
					<input class="input" id="matchDateField" type="text" name="matchDate" value="" />
				</p>
				<p>
					<label for="notes">Notes</label>
					<br/>
					<textarea class="input" id="matchNotesField" name="notes"></textarea>
				</p>
			</div>
		</form>
	</div>
</div>