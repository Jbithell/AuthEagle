<?php
require_once '../../../dash_auth.php';
//Check you have required dblogins!
// Create connection
date_default_timezone_set("Europe/London");
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) die("Connection failed, please contact support");
if (isset($_GET['last'])) $last = urldecode($_GET['last']);
$sql = "SELECT * FROM admin_chat_messages LEFT JOIN dash_users ON admin_chat_messages.userid=dash_users.userid WHERE admin_chat_messages.sent >= '";
if (isset($last)) {
	$sql .= date('Y-m-d H:i:s', $last);
} else {
	$sql .= date('Y-m-d H:i:s', strtotime("-3 hours"));
}
$sql .= "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$data[] = $row["forename"]. " " . $row["surname"]. ':' . $row["message"];
	} 
}
$conn->close();
header('Content-Type: application/json');
die(json_encode($response));
?>
