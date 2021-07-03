<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/**
 * Standard includes
 */
require_once 'config/database.php';

require_once 'class/calendar.php';

$calendarObject	= new class_calendar();

$calendar		= array();
$classes					= array('customevent1', 'customevent2', 'customevent3', 'customevent4', 'customevent5', 'customevent6', 'customevent7', 'customevent8', 'customevent9', 'customevent10', 'customevent11');
$i								= 0;
$calendarData	= $calendarObject->getAll('calendar_deleted = 0 and calendar_active = 1', 'calendar_added desc');

if($calendarData) {
	foreach($calendarData as $item) {
		
		$colour	= rand(0, (count($classes) - 1));
		
		$calendar[$i]['id']				= $i;
		$calendar[$i]['start'] 			= $item['calendar_startdate'];
		$calendar[$i]['end'] 			= $item['calendar_enddate'];
		$calendar[$i]['title']				= $item['user_name'].' '.$item['user_surname'].' ('.$item['attendeesnumber'].'): '.$item['calendar_name'].', in '.$item['calendar_address'];
		$calendar[$i]['url']				= '/calendar/schedules/details.php?code='.$item['calendar_code'];
		$calendar[$i]['allDay']			= false;
		$calendar[$i]['className']	= $classes[$colour].' iframe';		
		$i++;
	}
}

$json = json_encode($calendar);

echo "var bookings = $json;";

?>