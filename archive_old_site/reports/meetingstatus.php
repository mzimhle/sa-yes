<?php
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	
	$results = $dbm -> doMeetingStatusReport($startDate,$endDate);
?>
<h2>Meeting Status Report (<?php echo $startDate; ?> to <?php echo $endDate; ?>)</h2>
<div class="sectionContent">
	
	<?php
		if (count($results) == 0) {
			echo '<p>No results found.</p>';
		} else {

			// sort the results into lists of mentors who met, did not meet, and did not log in
			$arrMet = array();
			$arrDidNotMeet = array();
			$arrDidNotLogIn = array();
			foreach ($results as $key=>$row) {
				foreach ($row as $prop=>$val) {
					if ($prop === 'status') {
						if (!isset($val)) {
							// did not log in
							array_push($arrDidNotLogIn, $row);
						} else if ($val == 1) {
							// met
							array_push($arrMet, $row);
						} else if ($val == 0) {
							// did not meet
							array_push($arrDidNotMeet, $row);
						}
					}
				}
			}

	/*
			$numMet = 0;
			$numDidNotMeet = 0;
			$numDidNotLogIn = 0;
			
			$userTableRows = '';
			
			foreach ($results as $key=>$row) {
				$userTableRows .= '<tr>';
				
				foreach ($row as $prop=>$val) {
					// display mentor ID and name
					if ($prop == 'id') {
						$userTableRows .= "<td class=\"center\">$val</td>";
						
						$val = $dbm -> getDisplayName($val);
						$userTableRows .= "<td>$val</td>";
					}

					// convert status to human readable form
					else if ($prop == 'status') {
						
						// add columns based on meeting status					
						if (!isset($val)) {
							// did not log in
							$userTableRows .= '<td class="center"></td>';
							$userTableRows .= '<td class="center"></td>';
							$userTableRows .= '<td class="center">X</td>';
							
							$numDidNotLogIn++;
						} else if ($val == 1) {
							// met
							$userTableRows .= '<td class="center">X</td>';
							$userTableRows .= '<td class="center"></td>';
							$userTableRows .= '<td class="center"></td>';
							
							$numMet++;
						} else if ($val == 0) {
							// did not meet
							$userTableRows .= '<td class="center"></td>';
							$userTableRows .= '<td class="center">X</td>';
							$userTableRows .= '<td class="center"></td>';
							
							$numDidNotMeet++;
						}
					} 
				}
				$userTableRows .= '</tr>';
			}
	 */
	?>
	
	<br/>
	
	<h2 style="font-size: 1.2em; margin-bottom: 1em">Summary</h2>
	<table id="summary" class="display">
		<thead>
			<th style="text-align: left">Meeting Category</th>
			<th style="text-align: left">Number of Mentors</th>
		</thead>
		<tbody>
			<tr>
				<td>Mentors who met with mentees:</td>
				<td><?php echo count($arrMet); ?></td>
			</tr>
			<tr>
				<td>Mentors who did not meet with mentees:</td>
				<td><?php echo count($arrDidNotMeet); ?></td>
			</tr>
			<tr>
				<td>Mentors who did not log in:</td>
				<td><?php echo count($arrDidNotLogIn); ?></td>
			</tr>
		</tbody>
	</table>
	
	<br/><br/>

<!--
	<h2 style="font-size: 1.2em; margin-bottom: 1em">Mentor Entries</h2>	
	<table id="results" class="display">
		<thead>
			<th>ID</th>
			<th>Mentor Name</th>
			<th>Met</th>
			<th>Did Not Meet</th>
			<th>Did Not Log In</th>
		</thead>
		<tbody>
		<?php echo $userTableRows; ?>
		</tbody>
		<tfoot>
			<tr>
				<th><input type="text" name="search_ids" value="IDs" class="search_init" /></th>
				<th><input type="text" name="search_mentor" value="Mentors" class="search_init" /></th>
				<th><input type="text" name="search_met" value="Met" class="search_init" /></th>
				<th><input type="text" name="search_didnotmeet" value="Did Not Meet" class="search_init" /></th>
				<th><input type="text" name="search_didnotlogin" value="Did Not Log In" class="search_init" /></th>
			</tr>
		</tfoot>
	</table>
	
	<br/><br/>
-->
	
	<div style="background-color:#fff; padding: 5px 10px 25px 10px;">
	<h2 style="font-size: 1.2em; margin-bottom: 1em">Mentors who Met with Mentees</h2>	
	<table id="resultsMet" class="display">
		<thead>
			<th>ID</th>
			<th>Mentor Name</th>
		</thead>
		<tbody>
		<?php
			foreach ($arrMet as $key=>$row) {
				echo '<tr>';
				
				foreach ($row as $prop=>$val) {
					// display mentor ID and name
					if ($prop == 'id') {
						echo "<td class=\"center\">$val</td>";
						
						$val = $dbm -> getDisplayName($val);
						echo "<td>$val</td>";
					}
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th><input type="text" name="search_ids" value="IDs" class="search_init" /></th>
				<th><input type="text" name="search_mentor" value="Mentors" class="search_init" /></th>
			</tr>
		</tfoot>
	</table>
	</div>
	
	<br/><br/>
	
	<div style="background-color:#fff; padding: 5px 10px 25px 10px;">
	<h2 style="font-size: 1.2em; margin-bottom: 1em">Mentors who Did Not Meet with Mentees</h2>	
	<table id="resultsDidNotMeet" class="display">
		<thead>
			<th>ID</th>
			<th>Mentor Name</th>
		</thead>
		<tbody>
		<?php
			foreach ($arrDidNotMeet as $key=>$row) {
				echo '<tr>';
				
				foreach ($row as $prop=>$val) {
					// display mentor ID and name
					if ($prop == 'id') {
						echo "<td class=\"center\">$val</td>";
						
						$val = $dbm -> getDisplayName($val);
						echo "<td>$val</td>";
					}
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th><input type="text" name="search_ids" value="IDs" class="search_init" /></th>
				<th><input type="text" name="search_mentor" value="Mentors" class="search_init" /></th>
			</tr>
		</tfoot>
	</table>
	</div>
	
	<br/><br/>
	
	<div style="background-color:#fff; padding: 5px 10px 25px 10px;">
	<h2 style="font-size: 1.2em; margin-bottom: 1em">Mentors who Did Not Log In</h2>	
	<table id="resultsDidNotLogIn" class="display">
		<thead>
			<th>ID</th>
			<th>Mentor Name</th>
		</thead>
		<tbody>
		<?php
			foreach ($arrDidNotLogIn as $key=>$row) {
				echo '<tr>';
				
				foreach ($row as $prop=>$val) {
					// display mentor ID and name
					if ($prop == 'id') {
						echo "<td class=\"center\">$val</td>";
						
						$val = $dbm -> getDisplayName($val);
						echo "<td>$val</td>";
					}
				}
			}
		?>
		</tbody>
		<tfoot>
			<tr>
				<th><input type="text" name="search_ids" value="IDs" class="search_init" /></th>
				<th><input type="text" name="search_mentor" value="Mentors" class="search_init" /></th>
			</tr>
		</tfoot>
	</table>
	</div>
	<?php } ?>
</div>