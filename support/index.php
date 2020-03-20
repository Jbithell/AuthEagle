<?php
define('FRESHDESK_SHARED_SECRET','25d764b7adc59e3333cf192724e71935');
define('FRESHDESK_BASE_URL','https://autheagle.freshdesk.com/');	//With Trailing slashes
require_once '../dash_auth.php';
function getSSOUrl($strName, $strEmail) {
	date_default_timezone_set('UTC');
	$timestamp = time();
	date_default_timezone_set("Europe/London");
	$to_be_hashed = $strName . $strEmail . $timestamp;
	$hash = hash_hmac('md5', $to_be_hashed, FRESHDESK_SHARED_SECRET);
	$url = FRESHDESK_BASE_URL."login/sso/?name=".urlencode($strName)."&email=".urlencode($strEmail)."&timestamp=".$timestamp."&hash=".$hash;
	return $url;
}
header("Location: ".getSSOUrl(((isset($forename) ? $forename : 'NULL') . " " . (isset($surname) ? $surname : 'NULL')),(isset($email) ? $email : 'null@null.com')));
?>