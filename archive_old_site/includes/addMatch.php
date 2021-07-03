<div class="aSection">
	<h2>Add Match</h2>
	<div class="sectionContent">
	<form id="addMatch" class="form" name="addMatch" method="POST" action="javascript:addMatch()">
		<p>
			<label for="mentor">Mentor<span class="req">*</span></label>
			<select name="mentor">
			<?php 
				$mentors = $dbm->getUsers('Mentor');
				foreach ($mentors as $key=>$mentor) {
					$id = $mentor['id'];
					$name = $mentor['first_name'].' '.$mentor['last_name'];
					echo "<option value=\"$id\">$name</option>";
				}
			?>
			</select>
		</p>
		<p>
			<label for="mentee">Mentee<span class="req">*</span></label>
			<select name="mentee">
			<?php 
				$mentees = $dbm->getUsers('Mentee');
				foreach ($mentees as $key=>$mentee) {
					$id = $mentee['id'];
					$name = $mentee['first_name'].' '.$mentee['last_name'];
					echo "<option value=\"$id\">$name</option>";
				}
			?>
				</select>
			</p>
			<p>
				<label for="matchData">Match Date<span class="req">*</span></label>
				<input type="text" name="matchDate" id="matchDate" />
			</p>
			<p>
				<label for="notes">Notes</label>
				<br/>
				<textarea class="input" id="notes" name="notes"></textarea>
			</p>
			<p>
				<input class="button" type="submit" value="Add Match" />
			</p>
	</form>
	</div>
</div>