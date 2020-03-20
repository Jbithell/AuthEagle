<?php
$db_hostname = '';
$db_database = '';
$db_username = '';
$db_password = '';
try {
	session_set_cookie_params(0, '/', '.autheagle.com');
}
catch (Exception $e) {
	//Do Nothing
}
//require_once 'dblogins.php';
//$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
?>