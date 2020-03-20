<?php

$url = 'https://'.$_SERVER['HTTP_HOST'] .explode("?", $_SERVER['REQUEST_URI'])[0];
require_once '../../../dash_auth.php';
if ($facebookid == '') die('Please login again using Facebook - <a href="login.php">Login</a>');
define('FACEBOOK_SDK_V4_SRC_DIR','fbsdk/src/Facebook/');
require_once("fbsdk/autoload.php");
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;
use Facebook\FacebookRedirectLoginHelper;
require_once '../../../fblogins.php';
FacebookSession::setDefaultApplication($FBAPPID, $FBAPPSECRET);
$helper = new FacebookRedirectLoginHelper($url);
try {
  $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
  die('Error');
} catch(\Exception $ex) {
  die('Error');
}
if ($session) {
  $request = new FacebookRequest(
	  $session,
	  'DELETE',
	  '/' . $facebookid . '/permissions'
	);
	$response = $request->execute();
	//Account has been disconnected
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed");
	} 
	$sql = "UPDATE `dash_users` SET `facebookid` = NULL WHERE `userid` = " . $id;
	$result = $conn->query($sql);
	header('Location: https://dash.autheagle.com/settings.php');
} else {
	header('Location: ' . $helper->getLoginUrl());
}
?>
