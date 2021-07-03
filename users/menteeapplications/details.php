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
require_once 'class/partner.php';
require_once 'class/user.php';
require_once 'class/mentorship.php';
require_once 'class/File.php';
require_once 'global_functions.php';

$menteeappObject 	= new class_menteeapp();
$partnerObject			= new class_partner();
$userObject				= new class_user();
$mentorshipObject		= new class_mentorship();
$fileObject 				= new File(array('gif', 'png', 'jpg', 'jpeg', 'gif'));

if(isset($_GET['action']) && trim($_GET['action']) == 'getmentee') {
	
	$response					= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';
	$usercode 				= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : -1;
	
	$menteeData = $userObject->getUserToLink($usercode, '3');
		
	if($menteeData) {
		$response['records'] = $menteeData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();		
}

$mentoshipData = $mentorshipObject->pairs();
if($mentoshipData) { $smarty->assign('mentoshipData', $mentoshipData); }

$partnerData = $partnerObject->pairs();
if($partnerData) { $smarty->assign('partnerData', $partnerData); }

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$menteeappData = $menteeappObject->getByCode($reference);
	
	if($menteeappData) {
		$smarty->assign('menteeappData', $menteeappData);
	} else {
		header('Location: /users/menteeapplications/');
		exit;		
	}
}

/* Check posted data. */
if(count($_POST) > 0) {
	
	$errorArray		= array();
	$data 				= array();
	$formValid		= true;
	$success			= NULL;
	$areaByName	= NULL;
	$usercode			= isset($_POST['menteecode']) && trim($_POST['menteecode']) != '' ? trim($_POST['menteecode']) : '';
	
	
	if(isset($_POST['mentorship_code']) && trim($_POST['mentorship_code']) == '') {
		$errorArray['mentorship_code'] = 'required';
		$formValid = false;
		
	} else {
		
		if(isset($_POST['menteeapp_name']) && trim($_POST['menteeapp_name']) == '') {
			$errorArray['menteeapp_name'] = 'required';
			$formValid = false;
		}
		
		if(isset($_POST['menteeapp_surname']) && trim($_POST['menteeapp_surname']) == '') {
			$errorArray['menteeapp_surname'] = 'required';
			$formValid = false;
		}
		
		if(isset($_POST['menteeapp_gender']) && trim($_POST['menteeapp_gender']) == '') {
			$errorArray['menteeapp_gender'] = 'required';
			$formValid = false;
		}
		
		if(isset($_POST['menteeapp_dateofbirth']) && trim($_POST['menteeapp_dateofbirth']) != '') {
			if(isset($_POST['menteeapp_dateofbirth']) && validateDate($_POST['menteeapp_dateofbirth']) == '') {
				$errorArray['menteeapp_dateofbirth'] = 'required';
				$formValid = false;
			}
		}
		
		if(isset($_POST['menteeapp_exitDate']) && trim($_POST['menteeapp_exitDate']) != '') {
			if(isset($_POST['menteeapp_exitDate']) && validateDate($_POST['menteeapp_exitDate']) == '') {
				$errorArray['menteeapp_exitDate'] = 'required';
				$formValid = false;
			}
		}
		
		if(isset($_POST['partner_code']) && trim($_POST['partner_code']) == '') {
			$errorArray['partner_code'] = 'required';
			$formValid = false;
		}
		
		if(isset($_POST['area_code']) && trim($_POST['area_code']) == '') {
			$errorArray['area_code'] = 'required';
			$formValid = false;
		}
		
		/* Validate if entered. */
		if(isset($_POST['menteeapp_idnumber']) && trim($_POST['menteeapp_idnumber']) != '') {
			if(validateID(trim($_POST['menteeapp_idnumber'])) == '') {
				$errorArray['menteeapp_idnumber'] = 'Enter valid ID number';
				$formValid = false;
			} else {
				
				$emailexists = isset($menteeappData) ? $menteeappObject->getByID(trim($_POST['menteeapp_idnumber']), trim($_POST['mentorship_code']), $usercode, $menteeappData['menteeapp_code']) : $menteeappObject->getByID(trim($_POST['menteeapp_idnumber']), trim($_POST['mentorship_code']), $usercode);
				
				if($emailexists) {
					$errorArray['menteeapp_idnumber'] = 'ID already being used by someone else';
					$formValid = false;				
				}
			}	
		}
		
		if(isset($_POST['menteeapp_email']) && trim($_POST['menteeapp_email']) != '') {
			if(validateEmail(trim($_POST['menteeapp_email'])) == '') {
				$errorArray['menteeapp_email'] = 'Enter valid email';
				$formValid = false;
			} else {
				$emailexists = isset($menteeappData) ? $menteeappObject->getByEmail(trim($_POST['menteeapp_email']), trim($_POST['mentorship_code']), $usercode, $menteeappData['menteeapp_code']) : $menteeappObject->getByEmail(trim($_POST['menteeapp_email']), trim($_POST['mentorship_code']), $usercode);
				
				if($emailexists) {
					$errorArray['menteeapp_email'] = 'Email already being used by someone else';
					$formValid = false;				
				}
			}		
		}
		
		if(isset($_POST['menteeapp_number']) && trim($_POST['menteeapp_number']) != '') {
			if(validateCell(trim($_POST['menteeapp_number'])) == '') {
				$errorArray['menteeapp_number'] = 'Enter valid number/cell';
				$formValid = false;
			} else {
				$numberexists = isset($menteeappData) ? $menteeappObject->getByNumber(trim($_POST['menteeapp_number']), trim($_POST['mentorship_code']), $usercode, $menteeappData['menteeapp_code']) : $menteeappObject->getByNumber(trim($_POST['menteeapp_number']), trim($_POST['mentorship_code']), $usercode);
				
				if($numberexists) {
					$errorArray['menteeapp_number'] = 'Number already being used by someone else';
					$formValid = false;				
				}
			}				
		}
		
		if(isset($_FILES['user_image'])) {
			/* Check validity of the CV. */
			if((int)$_FILES['user_image']['size'] != 0 && trim($_FILES['user_image']['name']) != '') {
				/* Check if its the right file. */
				$ext = array_search($_FILES['user_image']['type'], $fileObject->mime_types); 
				
				if($ext != '') {
					if(!$fileObject->valideExt($ext)) { 
						$errorArray['user_image'] = 'Invalid file type';
						$formValid = false;						
					}
				} else {
					$errorArray['user_image'] = 'Invalid file type';
					$formValid = false;									
				}
			}
		}		
	}

	if(isset($_POST['menteeapp_address']) && trim($_POST['menteeapp_address']) == '') {
		$errorArray['menteeapp_address'] = 'required';
		$formValid = false;
	}	
		
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data['partner_code'] 					= trim($_POST['partner_code']);		
		$data['area_code'] 						= trim($_POST['area_code']);						
		$data['menteeapp_name'] 				= trim($_POST['menteeapp_name']);				
		$data['menteeapp_surname'] 			= trim($_POST['menteeapp_surname']);				
		$data['menteeapp_dateofbirth'] 		= validateDate(trim($_POST['menteeapp_dateofbirth']));	
		$data['menteeapp_exitDate'] 			= validateDate(trim($_POST['menteeapp_exitDate']));	
		$data['menteeapp_gender'] 			= trim($_POST['menteeapp_gender']);	
		$data['menteeapp_idnumber'] 		= validateID(trim($_POST['menteeapp_idnumber']));				
		$data['menteeapp_heardofus'] 		= trim($_POST['menteeapp_heardofus']);	
		$data['menteeapp_email'] 				= validateEmail(trim($_POST['menteeapp_email']));	
		$data['menteeapp_number'] 			= validateCell(trim($_POST['menteeapp_number']));	
		$data['menteeapp_address'] 			= trim($_POST['menteeapp_address']);	
		$data['menteeapp_race'] 				= trim($_POST['menteeapp_race']);			
		$data['menteeapp_notes'] 				= htmlspecialchars_decode(stripslashes(trim($_POST['menteeapp_notes'])));
		$data['user_code']							= isset($_POST['menteecode']) && trim($_POST['menteecode']) != '' ? trim($_POST['menteecode']) : null;
		$data['user_code']							= isset($menteeappData) && trim($menteeappData['user_code']) != '' ? $menteeappData['user_code'] : $data['user_code'];
		$data['menteeapp_children'] 			= isset($_POST['menteeapp_children']) && (int)trim($_POST['menteeapp_children']) == 1 ? 1 : 0;
		
		if(isset($menteeappData)) {
			
			/* Check for duplicate emails on user table. */
			if($data['menteeapp_email'] != '') {
				$checkEmail	= $userObject->checkUpdateEmail($data['menteeapp_email'], $menteeappData['user_code']) ;
				
				if($checkEmail) {
					$errorArray['mentorship_code'] = 'A user is already using the email address : '.$data['menteeapp_email'].'. Cannot have duplicate email addresses.';
					$formValid = false;							
				} 
			}
			
			if(count($errorArray) == 0 && $formValid == true) {
				/*Update. */
				$where = $menteeappObject->getAdapter()->quoteInto('menteeapp_code = ?', $menteeappData['menteeapp_code']);
				$success = $menteeappObject->update($data, $where);
				$success = $menteeappData['menteeapp_code'];
				
				if(date('Y') == $menteeappData['mentorship_code']) {
					/* update user details. */
					$userObject->updateFromMenteeApplication($data, $data['user_code']);
				}
			}
		} else {
			/* check if there is nothing duplicate. */			
			$data['mentorship_code']	= (int)trim($_POST['mentorship_code']);
			
			if($data['user_code'] != null) {
				/* Check if not already added. */
				$tempdata = $menteeappObject->checkApplication($data['user_code'], $data['mentorship_code']);
				
				if($tempdata) {
					$errorArray['mentorship_code'] = 'You have already added this person for the '.$data['mentorship_code'].' program.';
					$formValid = false;						
				}
			}
			
			/* Check for duplicate emails on user table. */
			if($data['menteeapp_email'] != '') {
				$checkEmail	= $data['user_code'] == null ? $userObject->checkEmail($data['menteeapp_email']) : $userObject->checkUpdateEmail($data['menteeapp_email'], $data['user_code']) ;
				
				if($checkEmail) {
					$errorArray['mentorship_code'] = 'A user is already using the email address : '.$data['menteeapp_email'].'. Cannot have duplicate email addresses.';
					$formValid = false;							
				}				
			}
			
			/* If all is well, proceed to create new rows. user row will however be deleted = 1 and active = 0 */
			if(count($errorArray) == 0 && $formValid == true) {				
				
				$tempdata 							= $data;
				$tempdata['usertype_code']	= 3;
				
				if($data['user_code'] == null) {
					$data['user_code']	= $userObject->insertFromMenteeApplication($tempdata);		
				} else {
					$userObject->updateFromMenteeApplication($tempdata, $data['user_code']);
				}

				$success = $menteeappObject->insert($data);		
				
			}
		}
		
		/* Upload image if its added. */
		if((int)$_FILES['user_image']['size'] != 0 && trim($_FILES['user_image']['name']) != '') {
			
			$image = array();
			$image['user_image_name']	= $userObject->filename();
			$image['user_image_path']		= '';
			$image['user_image_ext']		= '';
			
			$usercode				= isset($menteeappData['user_code']) && trim($menteeappData['user_code']) != '' ? trim($menteeappData['user_code']) : $data['user_code'];
			$ext 						= strtolower($fileObject->file_extention($_FILES['user_image']['name']));					
			$filename				= $image['user_image_name'].'.'.$ext;			
			$directory				= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/media/user/'.$usercode.'/';
			$file						= $directory.'/'.$filename;	
			
			if(!is_dir($directory)) mkdir($directory, 0777, true);

			/* Create files for this product type. */
			foreach($fileObject->image as $item) {
				
				$newfilename = str_replace($filename, $item['code'].$filename, $file);
				
				/* Create new file and rename it. */
				$uploadObject	= PhpThumbFactory::create($_FILES['user_image']['tmp_name']);
				$uploadObject->resize($item['width'], $item['height']);
				$uploadObject->save($newfilename);
			
			}

			$image['user_image_path']	= '/media/user/'.$usercode.'/';
			$image['user_image_ext']	= '.'.$ext;

			$where = $userObject->getAdapter()->quoteInto('user_code = ?', $usercode);
			$userObject->update($image, $where);			
		
		}
		
		if(count($errorArray) == 0 && $formValid == true) {
			header('Location: /users/menteeapplications/application.php?code='.$success);
			exit;		
		}	
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the menteeapplate  */	
$smarty->display('users/menteeapplications/details.tpl');

?>