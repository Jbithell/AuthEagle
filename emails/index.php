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
	 echo '<title>Verified Message from AuthEagle</title><link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">';
	 echo '<center><iframe id="email" src="iframe_email_content.php?id=' . $row[1] . '" style="width: 97%; height: 800px; border:10px groove #EAC117;"></iframe></center>';
	 echo '<center><h1 id="verify">Verification</h1></center>';
	 echo '<center><p>&#10004; This E-Mail is a valid AuthEagle E-Mail</p></center>';
} else {
	 echo '<title>UnVerified Message from AuthEagle</title><center><h3>The E-Mail you have been sent is probably not authentic - Please <a href="mailto:support@autheagle.com">contact us</a> as soon as possible</h3></center>';
}
$conn->close();
?>