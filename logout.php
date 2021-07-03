<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

error_reporting(E_ALL);

/**
 * Standard includes
 */
require_once 'config/database.php';
require_once 'config/smarty.php';
require_once 'includes/auth.php';

global $zfsession;

// Clear the identity from the session
$zfsession->userData = $zfsession->identity = null;

unset($zfsession->userData);
unset($zfsession->identity);

//redirect to login page
header('Location: /login.php');
exit;
?>