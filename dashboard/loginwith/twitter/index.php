<?php
session_start();
require_once('lib/twitteroauth.php');
require_once '../../../twitterlogins.php';
if(isset($_GET['oauth_token']))
{
	$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($access_token)
	{
			$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
			$params =array();
			$params['include_entities']='false';
			$content = $connection->get('account/verify_credentials',$params);

			if($content && isset($content->screen_name) && isset($content->name))
			{
				//$content->profile_image_url = Profile Image
				$_SESSION['twitter_id']=$content->screen_name;
				//User info ok? Let's print it (Here we will be adding the login and registering routines)
				$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
				// Check connection
				if ($conn->connect_error) die("Connection failed - Please contact Support");
				$sql = "UPDATE `dash_users` SET `twitterusername` = '" . $content->name . "' WHERE userid = " . $id;
				$result = $conn->query($sql);
				$conn->close();
				header("Location: https://" . $_SERVER['SERVER_NAME'] . '/settings.php');
				die();
			}
			else
			{
				echo "<h4> Login Error </h4>";
			}
	}

else
{

	echo "<h4> Login Error </h4>";
}

}
else {
	if(isset($_SESSION['twitter_id'])) //check whether user already logged in with twitter
	{

		echo "Name :".$_SESSION['name']."<br>";
		echo "Twitter ID :".$_SESSION['twitter_id']."<br>";
		echo "Image :<img src='".$_SESSION['image']."'/><br>";
		echo "<br/><a href='logout.php'>Logout</a>";


	}
	else // Not logged in
	{

		$connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
		$request_token = $connection->getRequestToken($OAUTH_CALLBACK); //get Request Token

		if(	$request_token)
		{
			$token = $request_token['oauth_token'];
			$_SESSION['request_token'] = $token ;
			$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
			
			switch ($connection->http_code) 
			{
				case 200:
					$url = $connection->getAuthorizeURL($token);
					//redirect to Twitter .
					header('Location: ' . $url); 
					break;
				default:
					echo "Coonection with twitter Failed";
					break;
			}

		}
		else //error receiving request token
		{
			echo "Error Receiving Request Token";
		}
		

	}
}
?>