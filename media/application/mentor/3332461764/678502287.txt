<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

require_once 'class/calendarattend.php';

$calendarattendObject	= new class_calendarattend();

if((!empty($_GET['dep']) && $_GET['dep'] != '') && isset($_GET['response'])) {

	$reference = trim($_GET['dep']);

	$attendeeData = $calendarattendObject->getByHashCode($reference);
	
	if($attendeeData) {
		$smarty->assign('attendeeData', $attendeeData);
	} else {
		header('Location: http://sa-yes.com/');
		exit;
	}
} else {
	header('Location: http://sa-yes.com/');
	exit;
}

$data = array();
$data['calendarattend_response'] = (int)trim($_GET['response']) == 1 ? 'accepted' : 'declined';

$where = array();
$where[] = $calendarattendObject->getAdapter()->quoteInto('calendar_code = ?', $attendeeData['calendar_code']);
$where[] = $calendarattendObject->getAdapter()->quoteInto('calendarattend_hascode = ?', $attendeeData['calendarattend_hascode']);
$success = $calendarattendObject->update($data, $where);
	
if((int)trim($_GET['response']) == 0) {
	$message = '<span style="color: red;">We are sorry to hear that you will not be joining us for the <b>'.$attendeeData['calendar_name'].'</b> event/meeting.</span>';
} else {
	$message = '<span style="color: green;">We are happy to hear that you will be joining us for the <b>'.$attendeeData['calendar_name'].'</b> event/meeting.</span>';
}

$smarty->assign('message', $message);

$display = $smarty->fetch('mailers/email_response.html');

echo $display; exit;

?>