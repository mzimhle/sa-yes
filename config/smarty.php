<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Show all errors. */
error_reporting(E_ALL);

/* 
	Setup Smarty Templating System.
*/

require_once('smarty/Smarty.class.php');

$smarty = new Smarty;

/* config smarty debug build setup. */
$smarty->debugging 		= false;

/* set smarty cache settings */
$smarty->caching 			= false;
$smarty->force_compile 	= true;

$smarty->compile_check 	= true; 	/* don't check for dependent file changes */
$smarty->cache_lifetime 	= 0; 		/* 2 = per template defined! 0=disabled */

/* set smarty folders */
$smarty->template_dir 	= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.'/';
$smarty->compile_dir 	= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.'/cache/smarty/compile/';
$smarty->config_dir 	= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.'/library/classes/smarty/config/';
$smarty->cache_dir 		= realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.'/cache/smarty/cache/';
$smarty->plugins_dir 	= array(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.'/library/classes/smarty/plugins/', realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.'/library/classes/smarty/smarty_custom_plugins/');

/* Get a random number for the images. */
$cachRandom = substr(md5(rand(123,9876123) . time()), 1, 10); $smarty->assign('nc',$cachRandom); 


date_default_timezone_set('Africa/Johannesburg');

?>