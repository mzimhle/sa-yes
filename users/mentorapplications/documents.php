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
require_once 'class/documents.php';
require_once 'class/File.php';

$mentorappObject	= new class_mentorapp();
$documentsObject	= new class_documents();
$fileObject 		= new File(array('doc', 'pdf', 'docx', 'txt', 'jpg', 'jpeg', 'png'));

if (!empty($_GET['code']) && $_GET['code'] != '') {

	$code = trim($_GET['code']);

	$mentorappData = $mentorappObject->getByCode($code);

	if($mentorappData) {
		$smarty->assign('mentorappData', $mentorappData);
		
		/* Get documents */
		$documentData = $documentsObject->getByMentor($code);
		
		if($documentData) $smarty->assign('documentData', $documentData);
	} else {
		header('Location: /users/mentorapplications/');
		exit;		
	}
} else {
	header('Location: /users/mentorapplications/');
	exit;		
}

if((isset($_REQUEST['deleteitem']) && trim($_REQUEST['deleteitem']) != '')) {
	
	$response				= array();
	$response['result'] 	= false;
	$response['message'] 	= '';
	
	$document	= isset($_REQUEST['deleteitem']) && trim($_REQUEST['deleteitem']) != '' ? trim($_REQUEST['deleteitem']) : '';
	
	if($document != '') {
		$data = array();
		$data['documents_deleted'] = 1;
		
		/*Update. */
		$where = array();
		$where[] = $documentsObject->getAdapter()->quoteInto('documents_code = ?', $document);
		$where[] = $documentsObject->getAdapter()->quoteInto('mentorapp_code = ?', $code);
		$success = $documentsObject->update($data, $where);
		$response['result'] 	= true;
		
	} else {
		$response['message'] 	= 'Please select a document to delete.';
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
	
	if(isset($_POST['document_name']) && trim($_POST['document_name']) == '') {
		$errorArray['document_name'] = 'Please add file description';
		$formValid = false;			
	}
	
	if(isset($_FILES['app_file'])) {
		/* Check validity of the CV. */
		if((int)$_FILES['app_file']['size'] != 0 && trim($_FILES['app_file']['name']) != '') {
			/* Check if its the right file. */
			$ext = $fileObject->getValidateExtention('app_file', strtolower($fileObject->file_extention($_FILES['app_file']['name'])));
			if(!$ext) {
				$errorArray['app_file'] = 'Invalid file type, please another type.';
				$formValid = false;									
			}
		}
	}
	
	if(count($errorArray) == 0 && $formValid == true) {

		/* Upload image if its added. */
		if((int)$_FILES['app_file']['size'] != 0 && trim($_FILES['app_file']['name']) != '') {
			
			$ext 		= strtolower($fileObject->file_extention($_FILES['app_file']['name']));					
			$filename	= $fileObject->getRandomFileName().'.'.$ext;			
			$directory	= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/media/documents/mentor/'.$mentorappData['mentorapp_code'].'/';
			$file		= $directory.'/'.$filename;	
			
			if(!is_dir($directory)) mkdir($directory, 0777, true);

			/* Upload file. here. */
			if(!move_uploaded_file($_FILES['app_file']['tmp_name'],  $file)) {
				$errorArray['app_file'] = 'Could not upload file, please try again.';
				$formValid = false;							
			} else {				
				$doc = array();
				$doc['documents_path']	= '/media/documents/mentor/'.$mentorappData['mentorapp_code'].'/'.$filename;
				$doc['documents_name']	= trim($_POST['document_name']);
				$doc['mentorapp_code']	= $code;
				
				$success = $documentsObject->insert($doc);	
			}
		}
		
		/* Check if accepted and add new user. */		
		header('Location: /users/mentorapplications/documents.php?code='.$mentorappData['mentorapp_code']);
		exit;		
		
	}
	
	/* if we are here there are errors. */
	$smarty->assign('errorArray', $errorArray);	
}

 /* Display the mentorapplate  */	
$smarty->display('users/mentorapplications/documents.tpl');

?>