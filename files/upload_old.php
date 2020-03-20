<?php
$captcha = true; //captcha is required
if (isset($_POST['g-recaptcha-response'])) {
	$ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'secret=' . '6LeoMgUTAAAAAEvl6A8AXT_tTdhXZeybSU6YTPxA' . '&response=' . $_POST['g-recaptcha-response']);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	if (json_decode($response,true)['success'] != 1 and $captcha) die('Sorry, Google thinks you might be a robot :(');
	//User is a human!
	
	$target_dir = "files/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$uploadOk = true;
	$extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	require_once '../dblogins.php';
	// Create connection
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	// Check connection
	if ($conn->connect_error) die("Connection failed, please contact support");
	$newname = rand(500,2147483647);
	$sql = "INSERT INTO `files` (`id`, `extension`, `name`, `owner`, `filename`) VALUES (NULL, '" . $extension . "', '" . htmlentities(mysqli_real_escape_string($conn, $_POST['name'])) . "', NULL, '" . $newname . "')";
	if (!mysqli_query($conn,$sql)) {
		//Retry!
		$newname = rand(500,2147483647);
		$sql = "INSERT INTO `files` (`id`, `extension`, `name`, `owner`, `filename`) VALUES (NULL, '" . $extension . "', '" . htmlentities(mysqli_real_escape_string($conn, $_POST['name'])) . "', NULL, '" . $newname . "')";
		if (!mysqli_query($conn,$sql)) die('Sorry, there was an error - Please try again later');
	}
	$conn->close();
	if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $newname . '.' . $extension)) {
		//Success
		echo "The file has been uploaded.";
	} else die("Sorry, there was an error uploading your file.");
} else {
	echo '<!DOCTYPE html>
		<html lang="en">
		<head>
			<title>AuthEagle File Upload</title>
			<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" />
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
			<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.3.0/bootbox.min.js"></script>
			<script src="//www.google.com/recaptcha/api.js"></script>
			<style>
				.btn-file {
					position: relative;
					overflow: hidden;
				}
				.btn-file input[type=file] {
					position: absolute;
					top: 0;
					right: 0;
					min-width: 100%;
					min-height: 100%;
					font-size: 100px;
					text-align: right;
					filter: alpha(opacity=0);
					opacity: 0;
					outline: none;
					background: white;
					cursor: inherit;
					display: block;
				}
			</style>
		</head>
		<body>
			<script>
			bootbox.dialog({
						title: "Upload a file to AuthEagle",
						message: ' . "'" . '<form action="upload.php" method="post" enctype="multipart/form-data" id="uploadform"><input type="text" class="form-control" name="name" placeholder="File Name" required/><br/><div class="input-group"><span class="input-group-btn"><span class="btn btn-primary btn-file">Browse&hellip;<input type="file" name="file" required /></span></span><input type="text" class="form-control" readonly></div><span class="help-block">Try selecting one or more files and watch the feedback</span><br/><center><div class="g-recaptcha" hl="en" data-sitekey="6LeoMgUTAAAAAFtX5AqKOP7CHlI-zo96W-LGp5Wq"></div></center></form>' . "'" .',
						buttons: {
							success: {
								label: "Upload",
								className: "btn-success",
								callback: function () {
									$("uploadform").submit();
								}
							}
						}
					}
				);
			</script>
		</body>
		</html>';
}
?>