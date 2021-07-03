<?php
	$startDate = $_GET['startDate'];
	$endDate = $_GET['endDate'];
	$allDates = $_GET['allDates'];
	$meetingStatus = $_GET['meetingStatus'];
	
	$results = $dbm -> doMeetingReport($startDate,$endDate,$allDates,$meetingStatus);
?>
<h2>Meeting Report</h2>
<div class="sectionContent">
	<?php	
		if (count($results) == 0) {
			echo '<p>No results found.</p>';
		} else {
			
			// get a row to pull out headers
			$headers = $results[0];
	?>
	<table id="results" class="display">
		<thead>
		<?php
		
			$headerLabels = array();
			$headerLabels['date'] = 'Date';
			$headerLabels['mentor'] = 'Mentor Name';
			$headerLabels['mentee'] = 'Mentee Name';
			$headerLabels['status'] = 'Meeting Status';
			$headerLabels['reason'] = 'Reason';
			
		
			foreach ($headers as $key=>$val) {
				echo "<th>$headerLabels[$key]</th>";
			}
		?>
		</thead>
		<tbody>
		<?php
			foreach ($results as $key=>$row) {
				echo '<tr>';
				foreach ($row as $prop=>$val) {
					
					// convert status to human readable form
					if ($prop == 'status') {
						if ($val == 1) {
							$val = 'Yes';
						} else {
							$val = 'No';
						}
					} 
					
					// convert 'with staff' to human readable form
					else if ($prop == 'staff') {
						if ($val == 1) {
							$val = 'Yes';
						} else {
							$val = 'No';
						}
					}
					
					// display mentor name
					else if ($prop == 'mentor') {
						$val = $dbm -> getDisplayName($val);
					}
					
					// display mentee name
					else if ($prop == 'mentee')	{
						$val = $dbm -> getDisplayName($val);
					}				
					
					echo "<td>$val</td>";
				}
				echo '</tr>';
			}
		?>
		</tbody>
	</table>
	<?php 
		}
	?>
</div>