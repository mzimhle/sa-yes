<div id="header">
	<div style="text-align: right">
		<?php
			if (isset($currentUser) && $currentUser != null) {
				echo '<span class="bold">Logged in:</span> ';
				echo '<a href="user.php">';
				echo $currentUser->getEmail();
				echo '</a>';
				echo ' | ';
				echo '<a href="logout.php">Logout</a>';
			}
		?>
	</div>
	<h1>Meeting Tracker <span style="font-size:.6em; vertical-align:super; color:#EFEFEF; font-variant:small-caps">beta</span></h1>
</div>