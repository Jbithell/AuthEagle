<?php
//require_once '../dash_auth.php';
require_once 'dblogins.php';
require_once 'salts.php';
session_start();

function authfail() {
	$url = ('https://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
	header("Location: " . 'https://' . 'dash.autheagle.com' . '/login.php' . '?return=' . urlencode($url));
	die('<meta http-equiv="refresh" content="0; url=' . 'https://' . 'dash.autheagle.com' . '/login.php' . '?return=' . urlencode($url) . '" />');
}
if (isset($_SESSION['token'])) {
	//Check token          
	//Check token is integer  
	if (filter_var($_SESSION['token'], FILTER_VALIDATE_INT) === false) authfail();
	//Token is integer
		
	//Time to check whether it is valid
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if ($conn->connect_error) {
		authfail();
		die("Connection failed - contact support");
	} 
	$tokenchecksql = "SELECT * FROM dash_tokens WHERE token='" . $_SESSION['token'] . "'";
	$tokencheckresult = $conn->query($tokenchecksql);
	if ($tokencheckresult->num_rows > 0) {
	   while($tokencheckrow = $tokencheckresult->fetch_assoc()) {
			//Force token to expire after 1 hour!
			/*
			if ($tokencheckrow["created"] >= date("d-m-Y H:i:s", strtotime($row['data'])+3600)) {
			//Token is expired
			$_SESSION['token'] = 'expired';
			} */
			//End Force token to expire after 1 hour
			
			//Check if the IP matches that preset in table
			if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
			  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];//Cloudflare Fix
			}
			if ($tokencheckrow["ip"] != $_SERVER['REMOTE_ADDR']) authfail();
			//The ip matches that in the table
			
			if ($tokencheckrow["admin-viewsiteas_token"] == 1) $adminviewsiteastoken=true;
			$userid = $tokencheckrow["userid"];
			
			//The token looks good!
			//Get user data
			$datasql = "SELECT * FROM dash_users WHERE userid='" . $userid  . "'";    
			$dataresult = $conn->query($datasql);
			if ($dataresult->num_rows == 0) authfail();
			$dataresult=mysqli_fetch_array($dataresult);
			
			$forename = $dataresult['forename'];        
			$surname = $dataresult['surname'];
			$email = $dataresult['email'];
			$type = $dataresult['type'];
			$admin = ($dataresult['admin'] != 1 ? false : true);
			if (array_shift((explode(".",$_SERVER['HTTP_HOST']))) == 'admin') {
				//The user is in the admin.autheagle.com subdomain
				if (!$admin) {
					header("Location: " . 'https://' . 'dash.autheagle.com');
					die('<meta http-equiv="refresh" content="0; url=' . 'https://' . 'dash.autheagle.com" />');
				}
			}
			$support_team = ($dataresult['support_team'] != 1 ? false : true);
			//Example usage: if (!$admin or !$support_team) die('<i>Sorry, you do not have access to this page</i>');
			$id = $dataresult['userid'];
			//$credit = $dataresult['credit'];
			$currency = $dataresult['currency'];
			$facebookid = $dataresult['facebookid'];
			$twitterusername = $dataresult['twitterusername'];
			$profilepicture = $dataresult['profilepicture'];
			$userid = $id;
			$created = $dataresult['created'];
			$user = $dataresult['username'];
			if ($user == 'demo') $demo = True;
			$username     = $dataresult['username'];
			$twostep = ($dataresult['2stepsecret'] != "" ? $dataresult['2stepsecret'] : false);
			
			if ($type == 2) die('<meta http-equiv="refresh" content="0; url=suspended.php" />');
			elseif ($type == 3) die('<meta http-equiv="refresh" content="0; url=deleted.php" />');
			elseif ($user == '') authfail();
		}
	} else authfail();
} else authfail();
?>