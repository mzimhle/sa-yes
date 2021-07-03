<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/mentorapp.php';
require_once 'class/usermentorship.php';
require_once 'class/user.php';
require_once 'class/match.php';
require_once 'class/applicationstatus.php';
require_once 'global_functions.php';
require_once 'class/File.php';

$mentorappObject 		= new class_mentorapp();
$userObject 					= new class_user();
$usermentorshipObject	= new class_usermentorship();
$matchObject		 		= new class_match();
$applicationstatusObject	= new class_applicationstatus();
$fileObject 					= new File(array('doc', 'pdf', 'docx', 'txt', 'jpg', 'jpeg', 'png'));

$applicationstatusData = $applicationstatusObject->pairs();
if($applicationstatusData) { $smarty->assign('applicationstatusData', $applicationstatusData); }

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$mentorappData = $mentorappObject->getByCode($reference);

	if($mentorappData) {
		$smarty->assign('mentorappData', $mentorappData);
	} else {
		header('Location: /users/mentorapplications/');
		exit;		
	}
} else {
	header('Location: /users/mentorapplications/');
	exit;		
}

$matchData = $matchObject->getByMentor($mentorappData['user_code'], $mentorappData['mentorship_code']);

if($matchData) $smarty->assign('matchData', $matchData);

if(isset($_GET['action']) && trim($_GET['action']) == 'updatematch' && $matchData != false) {
	
	$response					= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';	
	
	$data = array();
	$data['match_date']	= trim($_POST['match_date']);

	$where		= $matchObject->getAdapter()->quoteInto('match_code = ?', $matchData['match_code']);
	$success 	= $matchObject->update($data, $where);
	
	echo json_encode($response);
	die();		
}

if(isset($_GET['action']) && trim($_GET['action']) == 'deletematch' && $matchData != false) {
	
	$response					= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';	
	
	$data = array();
	$data['match_deleted'] = 1;

	$where		= $matchObject->getAdapter()->quoteInto('match_code = ?', $matchData['match_code']);
	$success 	= $matchObject->update($data, $where);
	
	echo json_encode($response);
	die();		
}

if(isset($_GET['action']) && trim($_GET['action']) == 'match') {
	
	require_once 'class/menteeapp.php';
	
	
	$response					= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';
	$menteecode 			= isset($_REQUEST['menteecode']) && trim($_REQUEST['menteecode']) != '' ? trim($_REQUEST['menteecode']) : -1;
	$menteeappObject 	= new class_menteeapp();
	
	
	$menteeData = $menteeappObject->getToMatch($menteecode, $mentorappData['mentorship_code']);
		
	if($menteeData) {
		
		$data = array();
		$data['mentorship_code'] 	= $mentorappData['mentorship_code'];
		$data['mentor_code'] 		= $mentorappData['user_code'];
		$data['mentee_code'] 		= $menteeData['user_code'];
		$data['match_date']			= trim($_POST['match_date']);
		
		$matchObject->insert($data);
		
	} else {
		$response['result'] = false;
		$response['message'] = 'Mentee not active for the '.$mentorappData['mentorship_code'].' mentorship program or already matched with another mentor.';
	}
	
	echo json_encode($response);
	die();		
}

if(isset($_GET['action']) && trim($_GET['action']) == 'getmentee') {
	
	require_once 'class/menteeapp.php';
	
	
	$response					= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';
	$menteecode 			= isset($_REQUEST['menteecode']) && trim($_REQUEST['menteecode']) != '' ? trim($_REQUEST['menteecode']) : -1;
	$menteeappObject 	= new class_menteeapp();
	
	$menteeData = $menteeappObject->getToMatch($menteecode, $mentorappData['mentorship_code']);
		
	if($menteeData) {
		$response['records'] = $menteeData;
	} else {
		$response['result'] = false;
		$response['message'] = 'Mentee not active for the '.$mentorappData['mentorship_code'].' mentorship program or already matched with another mentor';
	}
	
	echo json_encode($response);
	die();		
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	$areaByName	= NULL;
	
	if(isset($_POST['applicationstatus_code']) && trim($_POST['applicationstatus_code']) == '') {
		$errorArray['applicationstatus_code'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['mentorapp_application']) && $_POST['mentorapp_application'] != '') {
		if(validateDate($_POST['mentorapp_application']) == '') {
			$errorArray['mentorapp_application'] = 'date required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['mentorapp_presentation']) && $_POST['mentorapp_presentation'] != '') {
		if(validateDate($_POST['mentorapp_presentation']) == '') {
			$errorArray['mentorapp_presentation'] = 'date required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['mentorapp_cv']) && $_POST['mentorapp_cv'] != '') {
		if(validateDate($_POST['mentorapp_cv']) == '') {
			$errorArray['mentorapp_cv'] = 'date required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['mentorapp_id']) && $_POST['mentorapp_id'] != '') {
		if(validateDate($_POST['mentorapp_id']) == '') {
			$errorArray['mentorapp_id'] = 'date required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['mentorapp_form29sent']) && $_POST['mentorapp_form29sent'] != '') {
		if(validateDate($_POST['mentorapp_form29sent']) == '') {
			$errorArray['mentorapp_form29sent'] = 'date required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_form29clearance']) && $_POST['mentorapp_form29clearance'] != '') {
		if(validateDate($_POST['mentorapp_form29clearance']) == '') {
			$errorArray['mentorapp_form29clearance'] = 'date required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_sapsClProof']) && $_POST['mentorapp_sapsClProof'] != '') {
		if(validateDate($_POST['mentorapp_sapsClProof']) == '') {
			$errorArray['mentorapp_sapsClProof'] = 'date required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_sapsClRefund']) && $_POST['mentorapp_sapsClRefund'] != '') {
		if(validateDate($_POST['mentorapp_sapsClRefund']) == '') {
			$errorArray['mentorapp_sapsClRefund'] = 'date required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_sapsCertAppSent']) && $_POST['mentorapp_sapsCertAppSent'] != '') {
		if(validateDate($_POST['mentorapp_sapsCertAppSent']) == '') {
			$errorArray['mentorapp_sapsCertAppSent'] = 'date required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['mentorapp_sapsCertAppRecieved']) && $_POST['mentorapp_sapsCertAppRecieved'] != '') {
		if(validateDate($_POST['mentorapp_sapsCertAppRecieved']) == '') {
			$errorArray['mentorapp_sapsCertAppRecieved'] = 'required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_oversCertAppSent']) && $_POST['mentorapp_oversCertAppSent'] != '') {
		if(validateDate($_POST['mentorapp_oversCertAppSent']) == '') {
			$errorArray['mentorapp_oversCertAppSent'] = 'required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_oversCertAppRefund']) && $_POST['mentorapp_oversCertAppRefund'] != '') {
		if(validateDate($_POST['mentorapp_oversCertAppRefund']) == '') {
			$errorArray['mentorapp_oversCertAppRefund'] = 'required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_interview']) && $_POST['mentorapp_interview'] != '') {
		if(validateDate($_POST['mentorapp_interview']) == '') {
			$errorArray['mentorapp_interview'] = 'required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_training']) && $_POST['mentorapp_training'] != '') {
		if(validateDate($_POST['mentorapp_training']) == '') {
			$errorArray['mentorapp_training'] = 'required';
			$formValid = false;
		}
	}

	if(isset($_POST['mentorapp_matchingDate']) && $_POST['mentorapp_matchingDate'] != '') {
		if(validateDate($_POST['mentorapp_matchingDate']) == '') {
			$errorArray['mentorapp_matchingDate'] = 'required';
			$formValid = false;
		}
	}

	if(isset($_FILES['mentorapp_file'])) {
		/* Check validity of the CV. */
		if((int)$_FILES['mentorapp_file']['size'] != 0 && trim($_FILES['mentorapp_file']['name']) != '') {
			/* Check if its the right file. */
			$ext = array_search($_FILES['mentorapp_file']['type'], $fileObject->mime_types); 
			
			if($ext != '') {
				if(!$fileObject->valideExt($ext)) { 
					$errorArray['mentorapp_file'] = 'Invalid file type';
					$formValid = false;						
				}
			} else {
				$errorArray['mentorapp_file'] = 'Invalid file type';
				$formValid = false;									
			}
		}
	}		
	if(count($errorArray) == 0 && $formValid == true) {
				
		$data['applicationstatus_code']								= trim($_POST['applicationstatus_code']);		
		$data['mentorapp_presentation']						= validateDate(trim($_POST['mentorapp_presentation'])) == '' ? null : validateDate(trim($_POST['mentorapp_presentation']));	
		$data['mentorapp_presentationAcc']				= isset($_POST['mentorapp_presentationAcc']) && (int)trim($_POST['mentorapp_presentationAcc']) == 1 ? 1 : 0;		
		$data['mentorapp_application']						= validateDate(trim($_POST['mentorapp_application'])) != '' ? validateDate(trim($_POST['mentorapp_application'])) : null;		
		$data['mentorapp_applicationAcc']					= isset($_POST['mentorapp_applicationAcc']) && (int)trim($_POST['mentorapp_applicationAcc']) == 1 ? 1 : 0;		
		$data['mentorapp_cv']									= validateDate(trim($_POST['mentorapp_cv'])) != '' ? validateDate(trim($_POST['mentorapp_cv'])) : null;		
		$data['mentorapp_imageWaiver']					= isset($_POST['mentorapp_imageWaiver']) && (int)trim($_POST['mentorapp_imageWaiver']) == 1 ? 1 : 0;		
		$data['mentorapp_form29Id']							= validateDate(trim($_POST['mentorapp_form29Id'])) != '' ? validateDate(trim($_POST['mentorapp_form29Id'])) : null;	
		$data['mentorapp_form29sent']						= validateDate(trim($_POST['mentorapp_form29sent'])) != '' ? validateDate(trim($_POST['mentorapp_form29sent'])) : null;		
		$data['mentorapp_form29clearance']				= validateDate(trim($_POST['mentorapp_form29clearance'])) != '' ? validateDate(trim($_POST['mentorapp_form29clearance'])) : null;		
		$data['mentorapp_sapsClProof']						= validateDate(trim($_POST['mentorapp_sapsClProof'])) != '' ? validateDate(trim($_POST['mentorapp_sapsClProof'])) : null;		
		$data['mentorapp_sapsClRefund']					= validateDate(trim($_POST['mentorapp_sapsClRefund'])) != '' ? validateDate(trim($_POST['mentorapp_sapsClRefund'])) : null;	
		$data['mentorapp_sapsClAmount']					= (int)trim(trim($_POST['mentorapp_sapsClAmount']));	
		$data['mentorapp_sapsCertAppSent']				= validateDate(trim($_POST['mentorapp_sapsCertAppSent'])) != '' ? validateDate(trim($_POST['mentorapp_sapsCertAppSent'])) : null;	
		$data['mentorapp_sapsCertAppRecieved']		= validateDate(trim($_POST['mentorapp_sapsCertAppRecieved'])) != '' ? validateDate(trim($_POST['mentorapp_sapsCertAppRecieved'])) : null;		
		$data['mentorapp_oversCertAppSent']			= validateDate(trim($_POST['mentorapp_oversCertAppSent'])) != '' ? validateDate(trim($_POST['mentorapp_oversCertAppSent'])) : null;	
		$data['mentorapp_oversCertAppReceived']		= validateDate(trim($_POST['mentorapp_oversCertAppReceived'])) != '' ? validateDate(trim($_POST['mentorapp_oversCertAppReceived'])) : null;	
		$data['mentorapp_oversCertAppRefund']			= validateDate(trim($_POST['mentorapp_oversCertAppRefund'])) != '' ? validateDate(trim($_POST['mentorapp_oversCertAppRefund'])) : null;		
		$data['mentorapp_oversCertAppAmount']		= (int)trim(trim($_POST['mentorapp_oversCertAppAmount']));	
		$data['mentorapp_referenceOne']					= trim($_POST['mentorapp_referenceOne']);	
		$data['mentorapp_referenceTwo']					= trim($_POST['mentorapp_referenceTwo']);	
		$data['mentorapp_referenceThee']					= trim($_POST['mentorapp_referenceThee']);	
		$data['mentorapp_interview']							= validateDate(trim($_POST['mentorapp_interview'])) != '' ? validateDate(trim($_POST['mentorapp_interview'])) : null;	
		$data['mentorapp_interviewAcc']						= isset($_POST['mentorapp_interviewAcc']) && (int)trim($_POST['mentorapp_interviewAcc']) == 1 ? 1 : 0;		
		$data['mentorapp_training']							= validateDate(trim($_POST['mentorapp_training'])) != '' ? validateDate(trim($_POST['mentorapp_training'])) : null;	
		$data['mentorapp_trainingAcc']						= isset($_POST['mentorapp_trainingAcc']) && (int)trim($_POST['mentorapp_trainingAcc']) == 1 ? 1 : 0;		
		$data['mentorapp_matchingDate']					= validateDate(trim($_POST['mentorapp_matchingDate'])) != '' ? validateDate(trim($_POST['mentorapp_matchingDate'])) : null;	
		$data['mentorapp_matchingSession']				= isset($_POST['mentorapp_matchingSession']) && (int)trim($_POST['mentorapp_matchingSession']) == 1 ? 1 : 0;	
		
		/*Update. */
		$where = null; $where = $mentorappObject->getAdapter()->quoteInto('mentorapp_code = ?', $mentorappData['mentorapp_code']);
		$success = $mentorappObject->update($data, $where);
		
		if($data['applicationstatus_code'] == 'matched') {
			
			/* User has been accepted, add them to the system as users. */
			$user = array();
			$user['user_active']	= 1;
			$user['user_deleted']	= 0;
			
			$where = null; $where = $userObject->getAdapter()->quoteInto('user_code = ?', $mentorappData['user_code']);
			$success = $userObject->update($user, $where);			
			
			/* If above successful, add usermentorship row. */
			if(is_numeric($success)) {
				
				$usermentorshipData = $usermentorshipObject->getUserMentorship($mentorappData['user_code'], $mentorappData['mentorship_code'], null);
				
				if(!$usermentorshipData) {
					
					$usermentorship = array();
					$usermentorship['mentorship_code']	= $mentorappData['mentorship_code'];
					$usermentorship['user_code']				= $mentorappData['user_code'];
					
					$usermentorshipObject->insert($usermentorship);
				}
			}			
		} else {
		
			/* Check if its the current year's program and deactivate the user if so. */
			if(date('Y') == $mentorappData['mentorship_code']) {
				$user = array();
				$user['user_active']	= 0;
				$user['user_deleted']	= 0;
				
				$where = null; $where = $userObject->getAdapter()->quoteInto('user_code = ?', $mentorappData['user_code']);
				$success = $userObject->update($user, $where);	
			}
			
			$usermentorshipData = $usermentorshipObject->getUserMentorship($mentorappData['user_code'], $mentorappData['mentorship_code'], null);
			
			if($usermentorshipData) {
				
				$usermentorship = array();
				$usermentorship['usermentorship_deleted']	= 1;
				$usermentorship['usermentorship_active']	=	0;
				
				$where = null; $where = array();
				$where[] = $usermentorshipObject->getAdapter()->quoteInto('user_code = ?', $mentorappData['user_code']);
				$where[] = $usermentorshipObject->getAdapter()->quoteInto('mentorship_code = ?', $mentorappData['mentorship_code']);
				
				$success = $usermentorshipObject->update($usermentorship, $where);	
			}						
		}
		
		/* Upload image if its added. */
		if((int)$_FILES['mentorapp_file']['size'] != 0 && trim($_FILES['mentorapp_file']['name']) != '') {
			
			$ext 						= strtolower($fileObject->file_extention($_FILES['mentorapp_file']['name']));					
			$filename				= $fileObject->getRandomFileName().'.'.$ext;			
			$directory				= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/media/application/mentor/'.$mentorappData['mentorapp_code'].'/';
			$file						= $directory.'/'.$filename;	
			
			if(!is_dir($directory)) mkdir($directory, 0777, true);

			/* Upload file. here. */
			if(!move_uploaded_file($_FILES['mentorapp_file']['tmp_name'],  $file)) {
				$errorArray['mentorapp_file'] = 'Could not upload file, please try again.';
				$formValid = false;							
			} else {
				$doc = array();
				$doc['mentorapp_file']	= '/media/application/mentor/'.$mentorappData['mentorapp_code'].'/'.$filename;
				
				$where = null; $where = $mentorappObject->getAdapter()->quoteInto('mentorapp_code = ?', $mentorappData['mentorapp_code']);
				$success = $mentorappObject->update($doc, $where);	
			}
		}
		
		/* Check if accepted and add new user. */		
		header('Location: /users/mentorapplications/');
		exit;		
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the mentorapplate  */	
$smarty->display('users/mentorapplications/application.tpl');

?>