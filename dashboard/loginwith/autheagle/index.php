<?php
require_once '../../../dblogins.php';
require_once '../../../salts.php';
require_once '../../../dash_tokengen.php';
//require_once '../login_libs/Google-Authenticator/GoogleAuthenticatorLib.php';
require_once '../login_libs/GoogleAuthenticator/GoogleAuthenticator.php';
session_set_cookie_params(0, '/', '.autheagle.com');
session_start();
header("Content-Type: text/plain");

$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($conn->connect_error) {
	die("Connection failed - contact support");
} 
function sanitizeString($var) {
   $var = strip_tags($var);
   $var = htmlentities($var);
   $var = stripslashes($var);
   global $conn;
   return mysqli_real_escape_string($conn, $var);
}
if (isset($_POST['user'])) {
	$user = sanitizeString($_POST['user']);
	$pass = hash('sha256', ($salt1 . sanitizeString($_POST['pass']) . $salt2));
	
	if ($user == "" || $pass == "") $error = "Not all fields were entered";
	else {
		if (strpos($user,'@') !== false) {
			$email = $user;
			$sql = "SELECT email,password FROM dash_users WHERE email='" . strtolower($email) . "' AND password='" . $pass  . "'";
			$sqlresult = $conn->query($sql);
			if (!$sqlresult) $error = "2";
			elseif ($sqlresult->num_rows == 0) $error = "2";
			else {
				//Get Username
				$sql = "SELECT userid, 2stepsecret FROM dash_users WHERE email='" . strtolower($email) . "'";
				$sqlresult = $conn->query($sql);
				if (!$sqlresult) $error = "2";
				elseif ($sqlresult->num_rows == 0) $error = "2";
				else {
					$result = mysqli_fetch_array($sqlresult);
					if ($result["2stepsecret"] != "") {
						//User has two step enabled
						if (isset($_POST["2stepcode"])) {
							$ga = new PHPGangsta_GoogleAuthenticator();
							if (!$ga->verifyCode($result["2stepsecret"], $_POST["2stepcode"], 2)) {
								die("4"); //Incorrect 2 step code
							} else {
								if (generatetoken(null, $result['userid'], false)) die("1");
								else die("4");
							}
						} else die("3");
					}
					if (isset($_SESSION['returnurl'])) {
						$urlreturn = urldecode($_SESSION['returnurl']);
						if (generatetoken($urlreturn, $result['userid'], false)) die("1");
					} else {
						if (generatetoken(null, $result['userid'], false)) die("1");
					}
				}
			}
	   }
	   else {
			$sql = "SELECT userid,password, 2stepsecret FROM dash_users WHERE username='" . strtolower($user) . "' AND password='" . $pass  . "'";
			$sqlresult = $conn->query($sql);
			if (!$sqlresult) $error = "2";
			elseif ($sqlresult->num_rows == 0) $error = "2";
			else {
				$result = mysqli_fetch_array($sqlresult);
				if ($result["2stepsecret"] != "") {
					$twostepsecret = $result["2stepsecret"];
					//User has two step enabled
					if (isset($_POST["2stepcode"])) {
						//$ga = new PHPGangsta_GoogleAuthenticator();
						$ga = new GoogleAuthenticator();
						//if ($ga->verifyCode($twostepsecret, $_POST["2stepcode"], 2)) {
						if ($ga->checkCode($twostepsecret,$_POST["2stepcode"])) {
							//Code looks good
							if (generatetoken(null, $result['userid'], false)) die("1");
							else die("4");
						} else {
							die("4"); //Incorrect 2 step code
						}
					} else die("3");
				}
				if (isset($_SESSION['returnurl'])) {
					$urlreturn = urldecode($_SESSION['returnurl']);
					if (generatetoken($urlreturn, $result['userid'], false)) die("1");
				} else {
					if (generatetoken(null, $result['userid'], false)) die("1");
				}
			}
		}
   }
}
else {
	print_r($_POST);
	die("I think you are in the wrong place!");
}
if (isset($error)) {
	die($error);
}
?>