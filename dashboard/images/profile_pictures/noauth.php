<?php
require_once '../../../dblogins.php';
if (!isset($_GET['image'])) die('404 - Image not Found!');
// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) die("Connection failed, please contact support");
$sql = "SELECT * FROM dash_profile_pictures WHERE id='" . mysqli_real_escape_string($conn, $_GET['image']) . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) $data = mysqli_fetch_row($result);
else die("404 - Image not Found!");
$conn->close();
// open the file in a binary mode
$filename = '../../../profilepics/' . $data[2] . '.' . $data[3];
$fp = fopen($filename, 'rb');

// send the right headers
header("Content-Type: image/" . $data[3]);
header("Content-Length: " . filesize($filename));

// dump the picture and stop the script
fpassthru($fp);
exit;
?>