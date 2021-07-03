<?php
require_once('models.php');

/**
 * Returns a connection to the database
 *
 * @return MDB2 connection to the database
 */
function getConnection() {
	$dsn = 'mysql://root@localhost/sayes_meetings';

	$mdb2 = &MDB2::connect($dsn);
	checkForError($mdb2);

	return $mdb2;
}

/**
 * Performs the given query on the database
 *
 * @param sql the sql statement to execute
 * @return the query result
 */
function doQuery($sql) {
	$mdb2 = getConnection();
	$res = &$mdb2 -> query($sql);

	checkForError($res);

	return $res;
}

/**
 * Checks for errors in the given PEAR object
 *
 * @param obj PEAR object to check
 */
function checkForError($obj) {
	if (PEAR::isError($obj)) {
		die($obj -> getMessage());
	}
}
?>