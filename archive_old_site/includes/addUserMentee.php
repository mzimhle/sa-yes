<div class="aSection">
	<h2>Add New Mentee</h2>
	<div class="sectionContent">
	<form id="addUserMentee" class="form" name="addUserMentee" method="POST">
		
		<?php
			$userType = 'Mentee';
			include ('addUserCommon.php');
		?>

		<p>
			<label for="race">Race</label>
			<input type="text" name="race" class="input" />
		</p>
		<p>
			<label for="home">Home</label>
			<input type="text" name="home" class="input" />
		</p>
		<p>
			<label for="homeDetails">Home Contact Details</label>
			<br/>
			<textarea class="input" id="homeDetails" name="homeDetails"></textarea>
		</p>
		<p>
			<label for="date">Join Date</label>
			<input class="input" id="joinDateMentee" type="text" name="date" />
		</p>
		<p>
			<label for="notes">Notes</label>
			<br/>
			<textarea class="input" id="notesMentee" name="notes"></textarea>
		</p>
		
		<input type="hidden" name="group" value="Mentee" />
		<p>
			<input class="button" type="submit" value="Add Mentee" />
		</p>
	</form>
	</div>
</div>