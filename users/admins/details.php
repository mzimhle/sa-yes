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
require_once 'class/File.php';

require_once 'global_functions.php';

$userObject 		= new class_user();
$fileObject 		= new File(array('gif', 'png', 'jpg', 'jpeg'));

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$reference = trim($_GET['code']);

	$tempData = $userObject->getAdmin($reference);
	
	if($tempData) {
		$smarty->assign('tempData', $tempData);
	} else {
		header('Location: /users/admins/');
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
	
	if(isset($_POST['user_name']) && trim($_POST['user_name']) == '') {
		$errorArray['user_name'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['user_surname']) && trim($_POST['user_surname']) == '') {
		$errorArray['user_surname'] = 'required';
		$formValid = false;
	}
	
	if(isset($_POST['user_race']) && trim($_POST['user_race']) == '') {
		$errorArray['user_race'] = 'required';
		$formValid = false;
	}

	if(isset($_POST['user_telephone']) && trim($_POST['user_telephone']) != '') {
		if(validateCell(trim($_POST['user_telephone'])) == '') {
			$errorArray['user_telephone'] = 'enter valid number';
			$formValid = false;	
		} 	
	}

	if(isset($_POST['user_cell']) && trim($_POST['user_cell']) != '') {
		if(validateCell(trim($_POST['user_cell'])) == '') {
			$errorArray['user_cell'] = 'enter valid cell';
			$formValid = false;	
		} else {
			
			$cellData = isset($tempData) ? $userObject->checkUpdateEmail(trim($_POST['user_cell']), $tempData['user_code']) : $userObject->getByCell($_POST['user_cell']);
			
			if($cellData) {
				$errorArray['user_cell'] = 'Cell number already taken';
				$formValid = false;				
			}
		} 	
	}
		
		
	if(isset($_POST['user_email']) && trim($_POST['user_email']) == '') {
		$errorArray['user_email'] = 'required';
		$formValid = false;
	} else {
		if(validateEmail(trim($_POST['user_email'])) == '') {
			$errorArray['user_email'] = 'enter valid email';
			$formValid = false;
		} else {
								
				$checkEmail = isset($tempData) ? $userObject->checkUpdateEmail(trim($_POST['user_email']), $tempData['user_code']) : $userObject->checkEmail(trim($_POST['user_email']));
				
				if($checkEmail) {
					$errorArray['user_email'] = 'email already used by someone';
					$formValid = false;				
				}					
		}		
	}
	
	if(validateCell(trim($_POST['user_cell'])) == '') {
		$errorArray['user_cell'] = 'enter valid cell';
		$formValid = false;	
	} else {
	
		$cellData = isset($tempData)  ? $userObject->getByCell(trim($_POST['user_cell']), $tempData['user_code']) : $userObject->getByCell(trim($_POST['user_cell']));
		
		if($cellData) {
			$errorArray['user_cell'] = 'Cell number already taken';
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
		
	if(count($errorArray) == 0 && $formValid == true) {
		
		$data['usertype_code']		= 1;
		$data['area_code'] 			= isset($_POST['area_code']) ? trim($_POST['area_code']) : null;			
		$data['user_dateofbirth'] 	= isset($_POST['user_dateofbirth']) ? trim($_POST['user_dateofbirth']) : null;			
		$data['user_name'] 			= isset($_POST['user_name']) ? trim($_POST['user_name']) : null;				
		$data['user_surname'] 		= isset($_POST['user_surname']) ? trim($_POST['user_surname']) : null;				
		$data['user_idnumber'] 		= isset($_POST['user_idnumber']) ? trim($_POST['user_idnumber']) : null;				
		$data['user_email'] 			= isset($_POST['user_email']) ? validateEmail(trim($_POST['user_email'])) : null;	
		$data['user_telephone'] 		= isset($_POST['user_telephone']) ? validateCell(trim($_POST['user_telephone'])) : null;	
		$data['user_cell'] 				= isset($_POST['user_cell']) ? validateCell(trim($_POST['user_cell'])) : null;	
		$data['user_race'] 				= isset($_POST['user_race']) ? trim($_POST['user_race']) : null;			
		$data['user_notes'] 			= htmlspecialchars_decode(stripslashes(trim($_POST['user_notes'])));
		
		if(isset($tempData)) {
			/*Update. */
			$where = $userObject->getAdapter()->quoteInto('user_code = ?', $tempData['user_code']);
			$success = $userObject->update($data, $where);	
		} else {
			$success = $userObject->insert($data);		
		}
		
		/* Upload image if its added. */
		if((int)$_FILES['user_image']['size'] != 0 && trim($_FILES['user_image']['name']) != '') {
			
			$image = array();
			$image['user_image_name']	= $userObject->filename();
			$image['user_image_path']		= '';
			$image['user_image_ext']		= '';
			
			$usercode				= isset($tempData['user_code']) && trim($tempData['user_code']) != '' ? trim($tempData['user_code']) : $success;
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
		
		
		header('Location: /users/admins/');
		exit;		
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);
	
}

 /* Display the template  */	
$smarty->display('users/admins/details.tpl');

?>