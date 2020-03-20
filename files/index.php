<?php
require_once '../dblogins.php';
// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) {
	die("Connection failed, please contact support");
}//owner="" AND 
$sql = "SELECT * FROM files WHERE (id='" . (isset($_GET['id']) ? htmlentities(mysqli_real_escape_string($conn, $_GET['id'])) : null) . "' OR filename='" . (isset($_GET['name']) ? htmlentities(mysqli_real_escape_string($conn, $_GET['name'])) : null) . "')";
$result = $conn->query($sql);
if (mysqli_num_rows($result) == 1) {
	$result = mysqli_fetch_row($result);
	$conn->close();
	if (isset($_GET['download'])) {
		$file = 'files/' . $result[4] . '.' . $result[1];
		header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
		//header("Cache-Control: public"); // needed for i.e.
		header("Content-Type: application/" . $result[1]);
		header("Content-Transfer-Encoding: Binary");
		header("Content-Length:".filesize($file));
		header("Content-Disposition: attachment; filename=" . $result[4] . '.' . $result[1]);
		readfile($file);
		die();      
	} else {
		if (file_exists('file_type_thumbnails/' . $result[1] .  '.png')) echo '<a href="' . "https://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "&download" . '"><img src="file_type_thumbnails/' . $result[1] .  '.png" /> Download File</a>';
		else echo '<a href="' . "https://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI] . "&download" . '">Download ' . $result[1] . ' File</a>';
	}
} else {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	echo '404 - File not found - Sorry!';
}
?>