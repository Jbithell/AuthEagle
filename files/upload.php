<?php
function error($message) {
	error_log($message);
	header("Content-Type: text/plain");
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	die($message);
}
if (isset($_FILES['file'])) {
	$target_dir = "files/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = true;
	$extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	require_once '../dblogins.php';
	// Create connection
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	// Check connection
	if ($conn->connect_error) error("Connection failed, please contact support");
	$newname = rand(500,2147483647);
	$sql = "INSERT INTO `files` (`id`, `extension`, `name`, `owner`, `filename`) VALUES (NULL, '" . $extension . "', '" . (isset($_POST['name']) ? htmlentities(mysqli_real_escape_string($conn, $_POST['name'])) : 'NULL') . "', '" . (isset($_POST['userid']) ? htmlentities(mysqli_real_escape_string($conn, $_POST['userid'])) : 'NULL') . "', '" . $newname . "')";
	if (!mysqli_query($conn,$sql)) {
		//Retry!
		$newname = rand(500,2147483647);
		$sql = "INSERT INTO `files` (`id`, `extension`, `name`, `owner`, `filename`) VALUES (NULL, '" . $extension . "', '" . (isset($_POST['name']) ? htmlentities(mysqli_real_escape_string($conn, $_POST['name'])) : 'NULL') . "', '" . (isset($_POST['userid']) ? htmlentities(mysqli_real_escape_string($conn, $_POST['userid'])) : 'NULL') . "', '" . $newname . "')";
		if (!mysqli_query($conn,$sql)) error('Sorry, there was an error - Please try again later');
	}
	$conn->close();
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $newname . '.' . $extension)) {
		//Success - File was uploaded! - Nothing really to do now :(
		
	} else error("Sorry, there was an error uploading your file.");
}
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css" rel="stylesheet" />

<form action="//files.autheagle.com/upload.php" class="dropzone">
  <div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form>