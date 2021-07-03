<?php 
	require_once('models.php');
	
	session_start();
	
	$dbm = DBManager::getInstance();
	
	// get current user
	$currentUser = $_SESSION['user'];
	if (!isset($currentUser)) { header('Location: index.php'); }
	$currentUser = $dbm->getUser($currentUser);
	
	if (!$dbm->isAdmin($currentUser->getId())) {
		header('Location: index.php');
	}
	
	// define page so nav can highlight properly
	$page = 'reports';
	
	echo '<!DOCTYPE html>';
?>
<html>
	<head>
		<?php include_once('includes.php'); ?>
		<script type="text/javascript" src="js/reports.js"></script>
	</head>
	<body>
		<?php include_once ('header.php'); ?>
		<?php include_once('nav.php'); ?>
		
		<div id="mainContent" class="ui-widget">
			
			<h2>Meeting Status Report</h2>
			<div class="sectionContent">
				<h4>This report provides a summary and detailed list of mentor meeting records for the specified date range.</h4>
				<form name="meetingStatusReport" class="form" action="results.php" method="GET">
				<div>
					<div style="width: 450px; float: left">
						<p class="" style="font-weight:bold;font-size: 1.1em">Specify date range:</p>
						<p>
							<label style="font-weight:normal">Start Date</label>
							<input type="text" class="input" id="msrStartDate" name="startDate" />
						</p>
						<p>
							<label style="font-weight:normal">End Date</label>
							<input type="text" class="input" id="msrEndDate" name="endDate" />
						</p>
					</div>
				</div>
				<p>
					<input type="submit" class="button" value="Generate Report" />
				</p>
				<input type="hidden" name="report" value="Meeting Status Report" />
				</form>
			</div>
			
			<h2>Meeting Report</h2>
			<div class="sectionContent">
				<h4>This report retrieves all meetings in the specified date range that match the specified meeting status.</h4>
				<form name="meetingReport" class="form" action="results.php" method="GET">
				<div>
					<div style="width: 450px; float: left">
						<p class="" style="font-weight:bold;font-size: 1.1em">Specify date range:</p>
						<p>
							<label style="font-weight:normal">Start Date</label>
							<input type="text" class="input" id="startDate" name="startDate" />
						</p>
						<p>
							<label style="font-weight:normal">End Date</label>
							<input type="text" class="input" id="endDate" name="endDate" />
						</p>
					</div>
					<div style="padding-left: 450px">
						<span style="padding: 0 1em">&#0151OR&#0151</span> 
						<input type="checkbox" name="allDates" id="allDatesCheck" /> <label style="float:none">Search all dates</label>
					</div>
				</div>
				<p style="clear:both">
					<label>Meeting Occurred</label>
					<input type="radio" name="meetingStatus" checked="checked" value="0" /> No
					<input type="radio" name="meetingStatus" value="1" /> Yes
				</p>
				<p>
					<input type="submit" class="button" value="Generate Report" />
				</p>
				<input type="hidden" name="report" value="Meeting Report" />
				</form>
			</div>
			
			
		</div>
	</body>
</html>