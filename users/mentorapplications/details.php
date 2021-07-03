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
require_once 'class/partner.php';
require_once 'class/user.php';
require_once 'class/mentorship.php';
require_once 'class/File.php';
require_once 'global_functions.php';

$mentorappObject 	= new class_mentorapp();
$partnerObject			= new class_partner();
$userObject				= new class_user();
$mentorshipObject		= new class_mentorship();
$fileObject 				= new File(array('gif', 'png', 'jpg', 'jpeg', 'gif'));

if(isset($_GET['action']) && trim($_GET['action']) == 'getmentor') {
	
	$response					= array();
	$response['result'] 	= true;
	$response['records']	= null;
	$response['error'] 		= '';
	$usercode 				= isset($_REQUEST['usercode']) && trim($_REQUEST['usercode']) != '' ? trim($_REQUEST['usercode']) : -1;
	
	$mentorData = $userObject->getUserToLink($usercode, '2');
		
	if($mentorData) {
		$response['records'] = $mentorData;
	} else {
		$response['result'] = false;
	}
	
	echo json_encode($response);
	die();		
}

$mentoshipData = $mentorshipObject->pairs();
if($mentoshipData) { $smarty->assign('mentoshipData', $mentoshipData); }

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$mentorappData = $mentorappObject->getByCode($reference);
	
	if($mentorappData) {
		$smarty->assign('mentorappData', $mentorappData);
	} else {
		header('Location: /users/mentorapplications/');
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
	$usercode			= isset($_POST['mentorcode']) && trim($_POST['mentorcode']) != '' ? trim($_POST['mentorcode']) : '';
	
	
	if(isset($_POST['mentorship_code']) && trim($_POST['mentorship_code']) == '') {
		$errorArray['mentorship_code'] = 'required';
		$formValid = false;
		
	} else {
		
		if(isset($_POST['mentorapp_name']) && trim($_POST['mentorapp_name']) == '') {
			$errorArray['mentorapp_name'] = 'required';
			$formValid = false;
		}
		
		if(isset($_POST['mentorapp_surname']) && trim($_POST['mentorapp_surname']) == '') {
			$errorArray['mentorapp_surname'] = 'required';
			$formValid = false;
		}	
		
		if(isset($_POST['mentorapp_dateofbirth']) && trim($_POST['mentorapp_dateofbirth']) != '' && trim($_POST['mentorapp_dateofbirth']) != '0000-00-00') {
			if(validateDate($_POST['mentorapp_dateofbirth']) == '') {
				$errorArray['mentorapp_dateofbirth'] = 'valid date required';
				$formValid = false;
			}
		}
		
		if(isset($_POST['mentorapp_idnumber']) && trim($_POST['mentorapp_idnumber']) != '') {
			if(validateID(trim($_POST['mentorapp_idnumber'])) == '') {
				$errorArray['mentorapp_idnumber'] = 'this must be a valid 13 digit number';
				$formValid = false;
			}
		}
		
		if(isset($_POST['mentorapp_email']) && trim($_POST['mentorapp_email']) != '') {
			if(validateEmail(trim($_POST['mentorapp_email'])) == '') {
				$errorArray['mentorapp_email'] = 'Enter valid email';
				$formValid = false;
			} else {
				$emailexists = isset($mentorappData) ? $mentorappObject->getByEmail(trim($_POST['mentorapp_email']), trim($_POST['mentorship_code']), $usercode, $mentorappData['mentorapp_code']) : $mentorappObject->getByEmail(trim($_POST['mentorapp_email']), trim($_POST['mentorship_code']), $usercode);
				
				if($emailexists) {
					$errorArray['mentorapp_email'] = 'Email already being used by someone else';
					$formValid = false;				
				}
			}		
		} else {
			$errorArray['mentorapp_email'] = 'Email required';
			$formValid = false;			
		}
		
		if(isset($_POST['mentorapp_cell']) && trim($_POST['mentorapp_cell']) != '') {
			if(validateCell(trim($_POST['mentorapp_cell'])) == '') {
				$errorArray['mentorapp_cell'] = 'Enter valid number/cell';
				$formValid = false;
			} else {
				$numberexists = isset($mentorappData) ? $mentorappObject->getByNumber(trim($_POST['mentorapp_cell']), trim($_POST['mentorship_code']), $usercode, $mentorappData['mentorapp_code']) : $mentorappObject->getByNumber(trim($_POST['mentorapp_cell']), trim($_POST['mentorship_code']), $usercode);
				
				if($numberexists) {
					$errorArray['mentorapp_cell'] = 'Number already being used by someone else';
					$formValid = false;				
				} else {
				
				}
			}				
		}
		
		if(isset($_POST['mentorapp_telephone']) && trim($_POST['mentorapp_telephone']) != '') {
			if(validateCell(trim($_POST['mentorapp_telephone'])) == '') {
				$errorArray['mentorapp_telephone'] = 'Enter valid telephone number';
				$formValid = false;
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
	
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data['area_code'] 						= trim($_POST['area_code']);						
		$data['mentorapp_name'] 				= trim($_POST['mentorapp_name']);				
		$data['mentorapp_surname'] 			= trim($_POST['mentorapp_surname']);				
		$data['mentorapp_dateofbirth'] 		= validateDate(trim($_POST['mentorapp_dateofbirth']));	
		$data['mentorapp_gender'] 			= trim($_POST['mentorapp_gender']);	
		
		$data['mentorapp_nationality'] 		= trim($_POST['mentorapp_nationality']);	
		$data['mentorapp_citizenship'] 		= trim($_POST['mentorapp_citizenship']);	
				
		$data['mentorapp_idnumber'] 		= trim($_POST['mentorapp_idnumber']);				
		$data['mentorapp_passport'] 			= trim($_POST['mentorapp_passport']);						
		$data['mentorapp_heardofus'] 		= trim($_POST['mentorapp_heardofus']);	
		$data['mentorapp_email'] 				= validateEmail(trim($_POST['mentorapp_email']));	
		$data['mentorapp_telephone'] 		= validateCell(trim($_POST['mentorapp_telephone']));	
		$data['mentorapp_cell'] 					= validateCell(trim($_POST['mentorapp_cell']));	
		$data['mentorapp_address'] 			= trim($_POST['mentorapp_address']);	
		$data['mentorapp_race'] 				= trim($_POST['mentorapp_race']);			
		$data['mentorapp_notes'] 				= htmlspecialchars_decode(stripslashes(trim($_POST['mentorapp_notes'])));
		$data['user_code']							= isset($_POST['mentorcode']) && trim($_POST['mentorcode']) != '' ? trim($_POST['mentorcode']) : null;
		$data['user_code']							= isset($mentorappData) && trim($mentorappData['user_code']) != '' ? $mentorappData['user_code'] : $data['user_code'];

		if(isset($mentorappData)) {
			
			/* Check for duplicate emails on user table. */
			if($data['mentorapp_email'] != '') {
				$checkEmail	= $userObject->checkEmail($data['mentorapp_email'], $mentorappData['user_code']) ;
				
				if($checkEmail) {
					$errorArray['mentorship_code'] = 'A user ('.$checkEmail['user_name'].' '.$checkEmail['user_surname'].') is already using the email address : '.$data['mentorapp_email'].'. Cannot have duplicate email addresses.';
					$formValid = false;							
				} 
			}

			if(count($errorArray) == 0 && $formValid == true) {
				/*Update. */
				$where = $mentorappObject->getAdapter()->quoteInto('mentorapp_code = ?', $mentorappData['mentorapp_code']);
				$success = $mentorappObject->update($data, $where);
				$success = $mentorappData['mentorapp_code'];
				
				if($mentorappData['mentorship_code'] == date('Y')) {
					/* update user details. */
					$userObject->updateFromMentorApplication($data, $data['user_code']);
				}
			}
		} else {
			/* check if there is nothing duplicate. */			
			$data['mentorship_code']	= (int)trim($_POST['mentorship_code']);
			
			if($data['user_code'] != null) {
				/* Check if not already added. */
				$tempdata = $mentorappObject->checkApplication($data['user_code'], $data['mentorship_code']);
				
				if($tempdata) {
					$errorArray['mentorship_code'] = 'You have already added this person for the '.$data['mentorship_code'].' program.';
					$formValid = false;						
				}
			}
			
			/* Check for duplicate emails on user table. */
			if($data['mentorapp_email'] != '') {
				$checkEmail	= $data['user_code'] == null ? $userObject->checkEmail($data['mentorapp_email']) : $userObject->checkEmail($data['mentorapp_email'], $data['user_code']) ;
				
				if($checkEmail) {
					$errorArray['mentorship_code'] = 'A user ('.$checkEmail['user_name'].' '.$checkEmail['user_surname'].') is already using the email address : '.$data['mentorapp_email'].'. Cannot have duplicate email addresses.';
					$formValid = false;							
				}				
			}
			
			/* If all is well, proceed to create new rows. user row will however be deleted = 1 and active = 0 */
			if(count($errorArray) == 0 && $formValid == true) {				
				
				$tempdata 							= $data;
				$tempdata['usertype_code']	= 2;
				
				if($data['user_code'] == null) {
					$data['user_code']	= $userObject->insertFromMentorApplication($tempdata);		
				} else {
					$userObject->updateFromMentorApplication($tempdata, $data['user_code']);
				}

				$success = $mentorappObject->insert($data);		
				
			}
		}
		
		if(count($errorArray) == 0 && $formValid == true) {
			/* Upload image if its added. */
			if((int)$_FILES['user_image']['size'] != 0 && trim($_FILES['user_image']['name']) != '') {
				
				$image = array();
				$image['user_image_name']	= $userObject->filename();
				$image['user_image_path']		= '';
				$image['user_image_ext']		= '';
				
				$usercode				= isset($mentorappData['user_code']) && trim($mentorappData['user_code']) != '' ? trim($mentorappData['user_code']) : $data['user_code'];
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
		}
		
		
		if(count($errorArray) == 0 && $formValid == true) {
			header('Location: /users/mentorapplications/application.php?code='.$success);
			exit;		
		}
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the mentorapplate  */	
$smarty->display('users/mentorapplications/details.tpl');

?>