<div class="aSection">
	<h2>Add New Administrator</h2>
	<div class="sectionContent">
	<form id="addUserAdmin" class="form" name="addUserAdmin" method="POST">
	
		<?php
			$userType = 'Admin';
			include ('addUserCommon.php');
		?>

		<p>
			<label for="notes">Notes</label>
			<br/>
			<textarea class="input" id="notesAdmin" name="notes"></textarea>
		</p>
		<input type="hidden" name="group" value="Administrator" />
		<p>
			<input class="button" type="submit" value="Add Administrator" />
		</p>
	</form>
	</div>
</div>