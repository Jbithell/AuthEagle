<?php
require_once '../../../dash_auth.php';
//Check you have required dblogins!
// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) die("Connection failed, please contact support");
date_default_timezone_set("Europe/London");
$sql = "INSERT INTO `admin_chat_messages` (`userid`, `id`, `message`, `sent`) VALUES ('" . $userid . "', NULL, '" . mysqli_real_escape_string($conn, htmlspecialchars(urldecode($_GET['message']))) . "', '" . date('Y-m-d H:i:s') . "')";
mysqli_query($conn, $sql);
$conn->close();
?>
