<?php
require_once 'dblogins.php';
date_default_timezone_set("Europe/London");
//Begin get browser and OS
$user_agent     =   $_SERVER["HTTP_USER_AGENT"];
function getOS() { 
	global $user_agent;
	$os_platform    =   "Unknown OS Platform";
	$os_array       =   array(
							'/windows nt 6.3/i'     =>  'Windows 8.1',
							'/windows nt 6.2/i'     =>  'Windows 8',
							'/windows nt 6.1/i'     =>  'Windows 7',
							'/windows nt 6.0/i'     =>  'Windows Vista',
							'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
							'/windows nt 5.1/i'     =>  'Windows XP',
							'/windows xp/i'         =>  'Windows XP',
							'/windows nt 5.0/i'     =>  'Windows 2000',
							'/windows me/i'         =>  'Windows ME',
							'/win98/i'              =>  'Windows 98',
							'/win95/i'              =>  'Windows 95',
							'/win16/i'              =>  'Windows 3.11',
							'/macintosh|mac os x/i' =>  'Mac OS X',
							'/mac_powerpc/i'        =>  'Mac OS 9',
							'/linux/i'              =>  'Linux',
							'/ubuntu/i'             =>  'Ubuntu',
							'/iphone/i'             =>  'iPhone',
							'/ipod/i'               =>  'iPod',
							'/ipad/i'               =>  'iPad',
							'/android/i'            =>  'Android',
							'/blackberry/i'         =>  'BlackBerry',
							'/webos/i'              =>  'Mobile'
						);

	foreach ($os_array as $regex => $value) { 
		if (preg_match($regex, $user_agent)) {
			$os_platform    =   $value;
		}

	}   
	return $os_platform;
}
function getBrowser() {
	global $user_agent;
	$browser        =   "Unknown Browser";
	$browser_array  =   array(
							'/msie/i'       =>  'Internet Explorer',
							'/firefox/i'    =>  'Firefox',
							'/safari/i'     =>  'Safari',
							'/chrome/i'     =>  'Chrome',
							'/opera/i'      =>  'Opera',
							'/netscape/i'   =>  'Netscape',
							'/maxthon/i'    =>  'Maxthon',
							'/konqueror/i'  =>  'Konqueror',
							'/mobile/i'     =>  'Mobile'
						);

	foreach ($browser_array as $regex => $value) { 
		if (preg_match($regex, $user_agent)) {
			$browser    =   $value;
		}
	}
	return $browser;
}
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
  $_SERVER["REMOTE_ADDR"] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}
$user_os        =   getOS();
$user_browser   =   getBrowser();
/* End Get Browser and OS */
//Generate Token
function generatetoken($urlreturn, $userid, $redirect = true) {
	global $db_hostname;
	global $db_username;
	global $db_password;
	global $db_database;
	global $user_os;
	global $user_browser;
	$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
	if ($conn->connect_error) die("Connection failed - contact support");
	
	$tokenquery = "INSERT INTO dash_tokens VALUES ('','" . date('Y-m-d G:i:s') . "','" . $userid . "','" . $_SERVER["REMOTE_ADDR"] .  "', '1', '0', '', 'WebDash - " . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] .  "', '" . $_SERVER["HTTP_CF_IPCOUNTRY"] . "', '" . $_SERVER["HTTP_USER_AGENT"] . "', '" . $user_os . "', '" . $user_browser . "');";
	$resultoftokenquery = $conn->query($tokenquery);
	if (mysqli_error($conn)) die('Error Generating Token - Please contact support');
	$token = $conn->insert_id;
	if (mysqli_error($conn)) die('Error Generating Token - Please contact support');
	
	$_SESSION['token'] = $token;
	if ($redirect) {
		//If the function call has asked for a redirect
		if ($urlreturn != null) {
			try {
				header('Location: '. $urlreturn);
			}
			catch(Exception $e) {
				die('<meta http-equiv="refresh" content="0; url=' . $urlreturn . '" />');
			}
		} else {
			try {
				header('Location: /');
			}
			catch(Exception $e) {
				die('<meta http-equiv="refresh" content="0;url=/" />');
			}
		}
	}
	else return true;
} 
?>