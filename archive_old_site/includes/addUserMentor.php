<div class="aSection">
	<h2>Add New Mentor</h2>
	<div class="sectionContent">
		<form id="addUserMentor" class="form" name="addUserMentor" method="POST">
			<?php 
				$userType = 'Mentor';
				include('addUserCommon.php');
			?>
			
			<p>
				<label for="date">Join Date</label>
				<input class="input" id="joinDate" type="text" name="date" />
			</p>
			<p>
				<label for="notes">Notes</label>
				<br/>
				<textarea class="input" id="notesMentor" name="notes"></textarea>
			</p>
			
			<input type="hidden" name="group" value="Mentor" />
			<p>
				<input class="button" type="submit" value="Add Mentor" />
			</p>
		</form>
	</div>
</div>