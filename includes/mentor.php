<?php

//error_reporting(!E_DEPRECATED);

//standard config include.
require_once 'config/database.php';
require_once 'config/smarty.php';

//include the Zend class for Authentification
require_once 'Zend/Session.php';

// Set up the namespace
$zfsession = new Zend_Session_Namespace('MentorLogin');

// Check if logged in, otherwise redirect
if (!isset($zfsession->identity) || is_null($zfsession->identity) || $zfsession->identity == '') {
	header('Location: /login.php');
	exit();
} else {
	//instantiate the users class
	require_once 'class/user.php';
	$users = new class_user();
	
	//get user details by username
	$usersData = $users->getByCode($zfsession->identity);
	
	$smarty->assign('userData', $usersData);
}

?>