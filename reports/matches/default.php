<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/match.php';
require_once 'class/partner.php';
require_once 'class/mentorship.php';

$matchObject			= new class_match();
$partnerObject 		= new class_partner();
$mentorshipObject	= new class_mentorship();

$mentorshipData = $mentorshipObject->pairs();
if($mentorshipData) { $smarty->assign('mentorshipData', $mentorshipData); }

$partnerData = $partnerObject->pairs();
if($partnerData) { $smarty->assign('partnerData', $partnerData); }


if((isset($_GET['action']) && trim($_GET['action']) == 'searchmatches') && (isset($_REQUEST['cvs']) && (int)trim($_REQUEST['cvs']) == 1)) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$smentorid 		= isset($_REQUEST['smentorid']) && trim($_REQUEST['smentorid']) != '' ? trim($_REQUEST['smentorid']) : '';
	$smenteeid 	= isset($_REQUEST['smenteeid']) && trim($_REQUEST['smenteeid']) != '' ? trim($_REQUEST['smenteeid']) : '';
	
	$partner 			= isset($_REQUEST['partner']) && trim($_REQUEST['partner']) != '' ? trim($_REQUEST['partner']) : '';
	$mentorship	= isset($_REQUEST['mentorship']) && trim($_REQUEST['mentorship']) != '' ? trim($_REQUEST['mentorship']) : '';

	$where = ' match.match_deleted = 0 ';

	if($smentorid != '') {
		$where .= ' and match.mentor_code = \''.$smentorid.'\' ';
	}

	if($smenteeid != '') {
		$where .= ' and match.mentee_code = \''.$smenteeid.'\' ';
	} 

	if($partner != '') {
		$where .= ' and partner.partner_code = \''.$partner.'\' ';
	} 

	if($mentorship != '') {
		$where .= ' and mentorship.mentorship_code = \''.$mentorship.'\' ';
	} 
	
	$matchData = $matchObject->getAll($where, 'match_added desc');

	$matchObject->download_send_headers("data_matches_export_" . date("Y-m-d") . ".csv");
	
	if($matchData) {
	
		$data = array();
		$i		= 0;
		
		foreach($matchData as $item) {
				
				$data[$i]['Mentorship']	= isset($item['mentorship_name']) && trim($item['mentorship_name']) != '' ? trim($item['mentorship_name']) : 'N/A';
				$data[$i]['Mentorname']	= $item['mentorapp_name'].' '.trim($item['mentorapp_surname']);
				$data[$i]['Email']			= isset($item['mentorapp_email']) && trim($item['mentorapp_email']) != '' ? trim($item['mentorapp_email']) : 'N/A';
				$data[$i]['Cellphone']		= isset($item['mentorapp_cell']) && trim($item['mentorapp_cell']) != '' ? trim($item['mentorapp_cell']) : 'N/A';
				$data[$i]['Mentee']			= isset($item['menteename']) && trim($item['menteename']) != '' ? trim($item['menteename']) : 'N/A';
				$data[$i]['Mentor']			= isset($item['mentorname']) && trim($item['mentorname']) != '' ? trim($item['mentorname']) : 'N/A';
				$data[$i]['Mentee']			= isset($item['menteename']) && trim($item['menteename']) != '' ? trim($item['menteename']) : 'N/A';
				$data[$i]['Status']			= isset($item['applicationstatus_code']) && trim($item['applicationstatus_code']) != '' ? trim($item['applicationstatus_code']) : 'N/A';
				$data[$i]['MentorApp_Gender']	= isset($item['mentorapp_gender']) && trim($item['mentorapp_gender']) != '' ? trim($item['mentorapp_gender']) : 'N/A';
				$data[$i]['MentorApp_Race']	= isset($item['mentorapp_race']) && trim($item['mentorapp_race']) != '' ? trim($item['mentorapp_race']) : 'N/A';
				$data[$i]['MentorApp_Nationality']	= isset($item['mentorapp_nationality']) && trim($item['mentorapp_nationality']) != '' ? trim($item['mentorapp_nationality']) : 'N/A';
				$data[$i]['MentorApp_Telephone']	= isset($item['mentorapp_telephone']) && trim($item['mentorapp_telephone']) != '' ? trim($item['mentorapp_telephone']) : 'N/A';
				$data[$i]['MentorApp_IDNumber']	= isset($item['mentorapp_idnumber']) && trim($item['mentorapp_idnumber']) != '' ? trim($item['mentorapp_idnumber']) : 'N/A';
				$data[$i]['MentorApp_Passport']	= isset($item['mentorapp_passport']) && trim($item['mentorapp_passport']) != '' ? trim($item['mentorapp_passport']) : 'N/A';
				$data[$i]['MentorApp_Citizenship']	= isset($item['mentorapp_citizenship']) && trim($item['mentorapp_citizenship']) != '' ? trim($item['mentorapp_citizenship']) : 'N/A';
				$data[$i]['MentorApp_Cell']	= isset($item['mentorapp_cell']) && trim($item['mentorapp_cell']) != '' ? trim($item['mentorapp_cell']) : 'N/A';
				$data[$i]['MentorApp_Email']	= isset($item['mentorapp_email']) && trim($item['mentorapp_email']) != '' ? trim($item['mentorapp_email']) : 'N/A';
				$data[$i]['MentorApp_Birthdate']	= isset($item['mentorapp_dateofbirth']) && trim($item['mentorapp_dateofbirth']) != '' ? trim($item['mentorapp_dateofbirth']) : 'N/A';
				$data[$i]['MentorApp_HeardFromUs']	= isset($item['mentorapp_heardofus']) && trim($item['mentorapp_heardofus']) != '' ? trim($item['mentorapp_heardofus']) : 'N/A';
				$data[$i]['MentorApp_Address']	= isset($item['mentorapp_address']) && trim($item['mentorapp_address']) != '' ? trim($item['mentorapp_address']) : 'N/A';
				$data[$i]['MentorApp_Notes']	= isset($item['mentorapp_notes']) && trim($item['mentorapp_notes']) != '' ? str_replace(',', '.', trim($item['mentorapp_notes'])) : 'N/A';
				$data[$i]['MentorApp_Presentation']	= isset($item['mentorapp_presentation']) && trim($item['mentorapp_presentation']) != '' ? trim($item['mentorapp_presentation']) : 'N/A';
				$data[$i]['MentorApp_PresentationAccepted']	= isset($item['mentorapp_presentationAcc']) && trim($item['mentorapp_presentationAcc']) != 0 ? 'Yes' : 'No';
				$data[$i]['MentorApp_Application']	= isset($item['mentorapp_application']) && trim($item['mentorapp_application']) != '' ? trim($item['mentorapp_application']) : 'N/A';
				$data[$i]['MentorApp_ApplicationAccepted']	= isset($item['mentorapp_applicationAcc']) && trim($item['mentorapp_applicationAcc']) != '' ? trim($item['mentorapp_applicationAcc']) : 'N/A';
				$data[$i]['MentorApp_CV']	= isset($item['mentorapp_cv']) && trim($item['mentorapp_cv']) != '' ? trim($item['mentorapp_cv']) : 'N/A';
				$data[$i]['MentorApp_ImageWaver']	= isset($item['mentorapp_imageWaiver']) && trim($item['mentorapp_imageWaiver']) != '' ? trim($item['mentorapp_imageWaiver']) : 'N/A';
				$data[$i]['MentorApp_DriversLicence']	= isset($item['mentorapp_driverLicence']) && trim($item['mentorapp_driverLicence']) != '' ? trim($item['mentorapp_driverLicence']) : 'N/A';
				$data[$i]['MentorApp_Form29ID']	= isset($item['mentorapp_form29Id']) && trim($item['mentorapp_form29Id']) != '' ? trim($item['mentorapp_form29Id']) : 'N/A';
				$data[$i]['MentorApp_Form29Sent']	= isset($item['mentorapp_form29sent']) && trim($item['mentorapp_form29sent']) != '' ? trim($item['mentorapp_form29sent']) : 'N/A';
				$data[$i]['MentorApp_Form29Clearance']	= isset($item['mentorapp_form29clearance']) && trim($item['mentorapp_form29clearance']) != '' ? trim($item['mentorapp_form29clearance']) : 'N/A';
				$data[$i]['MentorApp_sapsCLProof']	= isset($item['mentorapp_sapsClProof']) && trim($item['mentorapp_sapsClProof']) != '' ? trim($item['mentorapp_sapsClProof']) : 'N/A';
				$data[$i]['MentorApp_sapsClRefund']	= isset($item['mentorapp_sapsClRefund']) && trim($item['mentorapp_sapsClRefund']) != '' ? trim($item['mentorapp_sapsClRefund']) : 'N/A';
				$data[$i]['MentorApp_sapsClAmount']	= isset($item['mentorapp_sapsClAmount']) && trim($item['mentorapp_sapsClAmount']) != '' ? trim($item['mentorapp_sapsClAmount']) : 'N/A';
				$data[$i]['MentorApp_sapsCertAppSent']	= isset($item['mentorapp_sapsCertAppSent']) && trim($item['mentorapp_sapsCertAppSent']) != '' ? trim($item['mentorapp_sapsCertAppSent']) : 'N/A';
				$data[$i]['MentorApp_sapsCertAppRecieved']	= isset($item['mentorapp_sapsCertAppRecieved']) && trim($item['mentorapp_sapsCertAppRecieved']) != '' ? trim($item['mentorapp_sapsCertAppRecieved']) : 'N/A';
				$data[$i]['MentorApp_oversCertAppSent']	= isset($item['mentorapp_oversCertAppSent']) && trim($item['mentorapp_oversCertAppSent']) != '' ? trim($item['mentorapp_oversCertAppSent']) : 'N/A';
				$data[$i]['MentorApp_oversCertAppReceived']	= isset($item['mentorapp_oversCertAppReceived']) && trim($item['mentorapp_oversCertAppReceived']) != '' ? trim($item['mentorapp_oversCertAppReceived']) : 'N/A';
				$data[$i]['MentorApp_oversCertAppRefund']	= isset($item['mentorapp_oversCertAppRefund']) && trim($item['mentorapp_oversCertAppRefund']) != '' ? trim($item['mentorapp_oversCertAppRefund']) : 'N/A';
				$data[$i]['MentorApp_oversCertAppAmount']	= isset($item['mentorapp_oversCertAppAmount']) && trim($item['mentorapp_oversCertAppAmount']) != '' ? trim($item['mentorapp_oversCertAppAmount']) : 'N/A';
				$data[$i]['MentorApp_referenceOne']	= isset($item['mentorapp_referenceOne']) && trim($item['mentorapp_referenceOne']) != '' ? trim($item['mentorapp_referenceOne']) : 'N/A';
				$data[$i]['MentorApp_referenceTwo']	= isset($item['mentorapp_referenceTwo']) && trim($item['mentorapp_referenceTwo']) != '' ? trim($item['mentorapp_referenceTwo']) : 'N/A';
				$data[$i]['MentorApp_referenceThee']	= isset($item['mentorapp_referenceThee']) && trim($item['mentorapp_referenceThee']) != '' ? trim($item['mentorapp_referenceThee']) : 'N/A';
				$data[$i]['MentorApp_interview']	= isset($item['mentorapp_interview']) && trim($item['mentorapp_interview']) != '' ? trim($item['mentorapp_interview']) : 'N/A';
				$data[$i]['MentorApp_interviewAccepted']	= isset($item['mentorapp_interviewAcc']) && trim($item['mentorapp_interviewAcc']) != 0 ? 'Yes' : 'No';
				$data[$i]['MentorApp_training']	= isset($item['mentorapp_training']) && trim($item['mentorapp_training']) != '' ? trim($item['mentorapp_training']) : 'N/A';
				$data[$i]['MentorApp_trainingAccepted']	= isset($item['mentorapp_trainingAcc']) && trim($item['mentorapp_trainingAcc']) != 0 ? 'Yes' : 'No';
				$data[$i]['MentorApp_matchdate']	= isset($item['mentorapp_matchingDate']) && trim($item['mentorapp_matchingDate']) != '' ? trim($item['mentorapp_matchingDate']) : 'N/A';
				$data[$i]['MentorApp_matchingSession']	= isset($item['mentorapp_matchingSession']) && trim($item['mentorapp_matchingSession']) != 0 ? 'Yes' : 'No';
				$i++;
		}
		
		echo $matchObject->array2csv($matchData);
	}
	
	die();	

}

if((isset($_GET['action']) && trim($_GET['action']) == 'searchmatches') && !isset($_REQUEST['cvs'])) {

	$response				= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';

	$smentorid 		= isset($_REQUEST['smentorid']) && trim($_REQUEST['smentorid']) != '' ? trim($_REQUEST['smentorid']) : '';
	$smenteeid 	= isset($_REQUEST['smenteeid']) && trim($_REQUEST['smenteeid']) != '' ? trim($_REQUEST['smenteeid']) : '';
	
	$partner 			= isset($_REQUEST['partner']) && trim($_REQUEST['partner']) != '' ? trim($_REQUEST['partner']) : '';
	$mentorship	= isset($_REQUEST['mentorship']) && trim($_REQUEST['mentorship']) != '' ? trim($_REQUEST['mentorship']) : '';

	$where = ' match.match_deleted = 0 ';

	if($smentorid != '') {
		$where .= ' and match.mentor_code = \''.$smentorid.'\' ';
	}

	if($smenteeid != '') {
		$where .= ' and match.mentee_code = \''.$smenteeid.'\' ';
	} 

	if($partner != '') {
		$where .= ' and partner.partner_code = \''.$partner.'\' ';
	} 

	if($mentorship != '') {
		$where .= ' and mentorship.mentorship_code = \''.$mentorship.'\' ';
	} 
	
	$matchData = $matchObject->getAll($where, 'match_added desc');

	if($matchData) {
		$response['records'] = $matchData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();	
}

/* End Pagination Setup. */
$smarty->display('reports/matches/default.tpl');

?>