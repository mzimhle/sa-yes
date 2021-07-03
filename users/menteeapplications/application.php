<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Standard includes */
require_once 'config/database.php';
require_once 'config/smarty.php';

//error_reporting(!E_ALL);

/* Check for login */
require_once 'includes/auth.php';
require_once 'class/menteeapp.php';
require_once 'class/usermentorship.php';
require_once 'class/user.php';
require_once 'class/applicationstatus.php';
require_once 'global_functions.php';
require_once 'class/File.php';

$menteeappObject 		= new class_menteeapp();
$userObject 					= new class_user();
$usermentorshipObject	= new class_usermentorship();
$applicationstatusObject	= new class_applicationstatus();
$fileObject 					= new File(array('doc', 'pdf', 'docx', 'txt', 'jpg', 'jpeg', 'png'));

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$menteeappData = $menteeappObject->getByCode($reference);
	
	if($menteeappData) {
		$smarty->assign('menteeappData', $menteeappData);
	} else {
		header('Location: /users/menteeapplications/');
		exit;		
	}
} else {
	header('Location: /users/menteeapplications/');
	exit;		
}

$applicationstatusData = $applicationstatusObject->pairs();
if($applicationstatusData) { $smarty->assign('applicationstatusData', $applicationstatusData); }

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
	
	if(isset($_POST['menteeapp_application']) && $_POST['menteeapp_application'] != '') {
		if(validateDate($_POST['menteeapp_application']) == '') {
			$errorArray['menteeapp_application'] = 'required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['menteeapp_interview']) && $_POST['menteeapp_interview'] != '') {
		if(validateDate($_POST['menteeapp_interview']) == '') {
			$errorArray['menteeapp_interview'] = 'required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['menteeapp_training']) && $_POST['menteeapp_training'] != '') {
		if(validateDate($_POST['menteeapp_training']) == '') {
			$errorArray['menteeapp_training'] = 'required';
			$formValid = false;
		}
	}
	
	if(isset($_POST['menteeapp_matchDate']) && $_POST['menteeapp_matchDate'] != '') {
		if(validateDate($_POST['menteeapp_matchDate']) == '') {
			$errorArray['menteeapp_matchDate'] = 'required';
			$formValid = false;
		}
	}
	
	if(isset($_FILES['menteeapp_file'])) {
		/* Check validity of the CV. */
		if((int)$_FILES['menteeapp_file']['size'] != 0 && trim($_FILES['menteeapp_file']['name']) != '') {
			/* Check if its the right file. */
			$ext = array_search($_FILES['menteeapp_file']['type'], $fileObject->mime_types); 
			
			if($ext != '') {
				if(!$fileObject->valideExt($ext)) { 
					$errorArray['menteeapp_file'] = 'Invalid file type';
					$formValid = false;						
				}
			} else {
				$errorArray['menteeapp_file'] = 'Invalid file type';
				$formValid = false;									
			}
		}
	}	
		
	if(count($errorArray) == 0 && $formValid == true) {
				
		$data['applicationstatus_code']				= trim($_POST['applicationstatus_code']);		
		$data['menteeapp_presentation']			= isset($_POST['menteeapp_presentation']) && (int)trim($_POST['menteeapp_presentation']) == 1 ? 1 : 0;		
		$data['menteeapp_presentationAcc']		= isset($_POST['menteeapp_presentationAcc']) && (int)trim($_POST['menteeapp_presentationAcc']) == 1 ? 1 : 0;		
		$data['menteeapp_application']				= validateDate(trim($_POST['menteeapp_application']));		
		$data['menteeapp_applicationAcc']			= isset($_POST['menteeapp_applicationAcc']) && (int)trim($_POST['menteeapp_applicationAcc']) == 1 ? 1 : 0;		
		$data['menteeapp_interview']					= validateDate(trim($_POST['menteeapp_interview']));		
		$data['menteeapp_interviewAcc']			= isset($_POST['menteeapp_interviewAcc']) && (int)trim($_POST['menteeapp_interviewAcc']) == 1 ? 1 : 0;	
		$data['menteeapp_training']					= validateDate(trim($_POST['menteeapp_training']));		
		$data['menteeapp_trainingAcc']				= isset($_POST['menteeapp_trainingAcc']) && (int)trim($_POST['menteeapp_trainingAcc']) == 1 ? 1 : 0;	
		$data['menteeapp_matchDate']				= validateDate(trim($_POST['menteeapp_matchDate']));		
		$data['menteeapp_matchingSession']		= isset($_POST['menteeapp_matchingSession']) && (int)trim($_POST['menteeapp_matchingSession']) == 1 ? 1 : 0;	
				
		/*Update. */
		$where = null; $where = $menteeappObject->getAdapter()->quoteInto('menteeapp_code = ?', $menteeappData['menteeapp_code']);
		$success = $menteeappObject->update($data, $where);
		
		if($data['applicationstatus_code'] == 'matched') {				
			
			/* User has been accepted, add them to the system as users. */
			$user = array();
			$user['user_active']	= 1;
			$user['user_deleted']	= 0;
			
			$where = null; $where = $userObject->getAdapter()->quoteInto('user_code = ?', $menteeappData['user_code']);
			$success = $userObject->update($user, $where);			
			
			/* If above successful, add usermentorship row. */
			if(is_numeric($success)) {
				
				$usermentorshipData = $usermentorshipObject->getUserMentorship($menteeappData['user_code'], $menteeappData['mentorship_code'], null);
				
				if(!$usermentorshipData) {
					
					$usermentorship = array();
					$usermentorship['mentorship_code']	= $menteeappData['mentorship_code'];
					$usermentorship['user_code']				= $menteeappData['user_code'];
					
					$usermentorshipObject->insert($usermentorship);
				}
			}			
		} else {
		
			/* Check if its the current year's program and deactivate the user if so. */
			if(date('Y') == $menteeappData['mentorship_code']) {
				$user = array();
				$user['user_active']	= 0;
				$user['user_deleted']	= 0;
				
				$where = null; $where = $userObject->getAdapter()->quoteInto('user_code = ?', $menteeappData['user_code']);
				$success = $userObject->update($user, $where);	
			}
			
			$usermentorshipData = $usermentorshipObject->getUserMentorship($menteeappData['user_code'], $menteeappData['mentorship_code'], null);
			
			if($usermentorshipData) {
				
				$usermentorship = array();
				$usermentorship['usermentorship_deleted']	= 1;
				$usermentorship['usermentorship_active']	=	0;
				
				$where = null; $where = array();
				$where[] = $usermentorshipObject->getAdapter()->quoteInto('user_code = ?', $menteeappData['user_code']);
				$where[] = $usermentorshipObject->getAdapter()->quoteInto('mentorship_code = ?', $menteeappData['mentorship_code']);
				
				$success = $usermentorshipObject->update($usermentorship, $where);	
			}						
		}
		
		/* Upload image if its added. */
		if((int)$_FILES['menteeapp_file']['size'] != 0 && trim($_FILES['menteeapp_file']['name']) != '') {
			
			$ext 						= strtolower($fileObject->file_extention($_FILES['menteeapp_file']['name']));					
			$filename				= $fileObject->getRandomFileName().'.'.$ext;			
			$directory				= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/media/application/mentee/'.$menteeappData['menteeapp_code'].'/';
			$file						= $directory.'/'.$filename;	
			
			if(!is_dir($directory)) mkdir($directory, 0777, true);

			/* Upload file. here. */
			if(!move_uploaded_file($_FILES['menteeapp_file']['tmp_name'],  $file)) {
				$errorArray['menteeapp_file'] = 'Could not upload file, please try again.';
				$formValid = false;							
			} else {
				$doc = array();
				$doc['menteeapp_file']	= '/media/application/mentee/'.$menteeappData['menteeapp_code'].'/'.$filename;
				
				$where = null; $where = $menteeappObject->getAdapter()->quoteInto('menteeapp_code = ?', $menteeappData['menteeapp_code']);
				$success = $menteeappObject->update($doc, $where);	
			}
		}
		
		if(count($errorArray) == 0 && $formValid == true) {
			/* Check if accepted and add new user. */		
			header('Location: /users/menteeapplications/');
			exit;		
		}
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the menteeapplate  */	
$smarty->display('users/menteeapplications/application.tpl');

?>