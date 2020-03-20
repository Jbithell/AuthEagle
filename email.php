<?php
/*SNEDING E-MAILS IN AUTHEAGLE
	1. require '../email.php';
	2. sendemail("TO EMAIL ADDRESS", "NAME OF PERSON E-MAIL BEING SENT TO (OPTIONAL)", "E-MAIL SUBJECT", "MESSAGE CONTENTS");
	3. That's it!
*/
function randString($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
	$str = '';
	$count = strlen($charset);
	while ($length--) {
		$str .= $charset[mt_rand(0, $count-1)];
	}
	return $str;
}
require_once 'emails/emailtemplate.php';
require_once 'dblogins.php';
date_default_timezone_set("Europe/London");
function sendemail($to_email, $to_name = null, $subject, $html) {
	global $db_hostname, $db_username, $db_password, $db_database;
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	// Check connection
	if ($conn->connect_error) {
		 die("Connection failed, please contact support");
	} 
	$uniqueid = randString(149);
	while (mysqli_num_rows(mysqli_query($conn,"SELECT id WHERE uniqueid='" . mysqli_real_escape_string($conn, $uniqueid) . "'")) > 0) {
		//Check for duplicate ids
		$uniqueid = randString(149);
	}
	if (!$sql = "INSERT INTO `mailings` (`id`, `uniqueid`, `sent`, `content`, `subject`, `sentto`) VALUES (NULL, '" . $uniqueid . "', '" . date('Y-m-d H:i:s') . "', '" . mysqli_real_escape_string($conn, $html) . "', '" . mysqli_real_escape_string($conn, $subject) . "', '" . mysqli_real_escape_string($conn, $to_email) . "');") return ("MySql Error");
	$conn->query($sql);
	$id = $conn->insert_id;
	$data = array(	'api_user' => '',
					'api_key' => '',
					'to' => $to_email,
					'subject' => $subject,
					'html' => outputemail($html, $uniqueid),
					'from' => 'support@autheagle.com',
					'fromname' => 'AuthEagle'
				);
	if ($to_name != null) $data += ['toname' => $to_name];

	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context  = stream_context_create($options);
	$result = file_get_contents("https://api.sendgrid.com/api/mail.send.json", false, $context);
	return;
}
?>