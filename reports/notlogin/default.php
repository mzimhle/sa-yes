<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/user.php';
require_once 'class/usertype.php';
require_once 'class/mentorship.php';

$userObject 			= new class_user();
$usertypeObject		= new class_usertype();
$mentorshipObject	= new class_mentorship();

$usertypeData = $usertypeObject->pairs();
if($usertypeData) { $smarty->assign('usertypeData', $usertypeData); }

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

if((isset($_GET['action']) && trim($_GET['action']) == 'searchusers') && (isset($_REQUEST['cvs']) && (int)trim($_REQUEST['cvs']) == 1)) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$usercode 	= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : '';
	$type 		= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';
	$mentorship	= isset($_REQUEST['mentorship']) && trim($_REQUEST['mentorship']) != '' ? trim($_REQUEST['mentorship']) : '';
	
	$where = ' user.user_deleted = 0 and user.usertype_code = 2 and  usermentorship.mentorship_code = \''.date('Y').'\'';
	$where .= ' and user_last_login not between DATE_ADD(CURDATE(), INTERVAL -10 DAY) and CURDATE()';
	
	$userData = $userObject->getReport($where, 'user.user_added desc');

	$userObject->download_send_headers("data_users_export_" . date("Y-m-d") . ".csv");
	
	if($userData) {
	
		$data = array(); 
		$i		= 0;
		
		foreach($userData as $item) {
				
				$data[$i]['Mentorship']		= isset($item['mentorship_name']) && trim($item['mentorship_name']) != '' ? trim($item['mentorship_name']) : 'N/A';
				$data[$i]['Added']			= isset($item['user_added']) && trim($item['user_added']) != '' ? trim($item['user_added']) : 'N/A';
				$data[$i]['ID']				= isset($item['user_idnumber']) && trim($item['user_idnumber']) != '' ? trim($item['user_idnumber']) : 'N/A';
				$data[$i]['Dateofbirth']	= isset($item['user_dateofbirth']) && trim($item['user_dateofbirth']) != '' ? trim($item['user_dateofbirth']) : 'N/A';
				$data[$i]['Type']			= isset($item['usertype_name']) && trim($item['usertype_name']) != '' ? trim($item['usertype_name']) : 'N/A';
				$data[$i]['Partner']		= isset($item['partner_name']) && trim($item['partner_name']) != '' ? trim($item['partner_name']) : 'N/A';
				$data[$i]['Area']			= isset($item['area_shortPath']) && trim($item['area_shortPath']) != '' ? trim($item['area_shortPath']) : 'N/A';
				$data[$i]['Fullname']		= trim($item['user_name']).' '.trim($item['user_surname']);
				$data[$i]['Email']			= isset($item['user_email']) && trim($item['user_email']) != '' ? trim($item['user_email'])  : 'N/A';
				$data[$i]['Telephone']		= isset($item['user_telephone']) && trim($item['user_telephone']) != '' ? trim($item['user_telephone'])  : 'N/A';
				$data[$i]['Cell']			= isset($item['user_cell']) && trim($item['user_cell']) != '' ? trim($item['user_cell'])  : 'N/A';
				$data[$i]['Race']			= isset($item['user_race']) && trim($item['user_race']) != '' ? trim($item['user_race'])  : 'N/A';
				$data[$i]['Notes']			= isset($item['user_notes']) && trim($item['user_notes']) != '' ? trim($item['user_notes'])  : 'N/A';
				
				$i++;
		}
		
		echo $userObject->array2csv($data);
	}
	
	die();	

}

if((isset($_GET['action']) && trim($_GET['action']) == 'searchusers') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$usercode 		= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : '';
	$type 				= isset($_REQUEST['type']) && trim($_REQUEST['type']) != '' ? trim($_REQUEST['type']) : '';
	$mentorship	= isset($_REQUEST['mentorship']) && trim($_REQUEST['mentorship']) != '' ? trim($_REQUEST['mentorship']) : '';
	
	$where = ' user.user_deleted = 0 and user.usertype_code = 2 and  usermentorship.mentorship_code = \''.date('Y').'\'';
	$where .= ' and user.user_last_login not between \''.date('Y-m-d h:i:s', strtotime("-10 days")).'\' and \''.date('Y-m-d h:i:s').'\'';
	
	$userData = $userObject->getReport($where, 'user.user_added desc');

	if($userData) {
		$response['records'] = $userData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('reports/notlogin/default.tpl');

?>