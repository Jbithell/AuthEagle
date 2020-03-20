<?php
require_once '../dblogins.php';
require_once 'emailtemplate.php';
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) die("Connection failed, please contact support");

$sql = "SELECT * FROM mailings WHERE uniqueid='" . mysqli_real_escape_string($conn, $_GET["id"]) . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	 $row = mysqli_fetch_row($result);
	 echo outputemail($row[3], $row[1], true);
}
$conn->close();
?>