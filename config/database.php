<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

/* Setup Database Connection. */
require_once('Zend/Db.php');
require_once('Zend/Db/Table.php');

try {

	$conn = Zend_Db::factory('Mysqli', array(
		'host'     	=> 'sayesmeetings.db.5503218.hostedresource.com',
		'username' 	=> 'sayesmeetings', 
		'password' 	=> 'UvvVwFv9BZ3bu!',
		'dbname'   	=> 'sayesmeetings'
	));
	
	$conn->getConnection();
} catch (Zend_Db_Adapter_Exception $e) {
	/* perhaps a failed login credential, or perhaps the RDBMS is not running */
} catch (Zend_Exception $e) {
	/* perhaps factory() failed to load the specified Adapter class */
	echo 'Failed to connect to database.';
}

/* set the fetchmode to object (this enables you to choose fetchAssoc as well as object */
$conn->setFetchMode(Zend_Db::FETCH_ASSOC);

/* set $conn as the default adapter for all abstracted tables */
Zend_Db_Table_Abstract::setDefaultAdapter($conn);

// 'mysql://sayesmeetings:xLwUaweJy6wj4J@sayesmeetings.db.5503218.hostedresource.com/sayesmeetings
?>