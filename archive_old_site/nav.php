<div class="nav">
	<ul>
<?php
	if ($dbm->isAdmin($currentUser->getId())) {
?>
		<li <?php if ($page == 'meetings') echo 'class="selected"'; ?>>
			<a href="meetings.php">Meetings</a>
		</li>
		<li <?php if ($page == 'users') echo 'class="selected"'; ?>>
			<a href="users.php">Users</a>
		</li>
		<li <?php if ($page == 'matches') echo 'class="selected"'; ?>>
			<a href="matches.php">Matches</a>
		</li>
		<li <?php if ($page == 'reports') echo 'class="selected"'; ?>>
			<a href="reports.php">Reports</a>
		</li>
<?php		
	} else if ($dbm->isMentor($currentUser->getId())) {
?>
		<li <?php if ($page == 'meetings') echo 'class="selected"'; ?>>
			<a href="meetings.php">Meetings</a>
		</li>
		<li <?php if ($page == 'mentee') echo 'class="selected"'; ?>>
			<a href="mentee.php">Mentee Info</a>
		</li>
<?php		
	}
?>
		<li <?php if ($page == 'edit') echo 'class="selected"'; ?>>
			<a href="user.php">My Info</a>
		</li>			
	</ul>
</div>