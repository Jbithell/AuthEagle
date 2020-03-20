<?php 
require_once '../dash_header.php';
$demo = false;
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			<?php echo $forename . "'s "; ?>Account
			<small>Settings &amp; Profile</small>
		  </h1>
		  <!--<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Me</a></li>
			<li class="active">Here</li>
		  </ol>-->
		</section>
		<!-- Main content -->
		<section class="content">
		<div class="row">
			<div class="col-lg-6">
			
			<?php 
				// Create connection
				$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
				// Check connection
				if ($conn->connect_error) die("Connection failed, please contact support");
				//Conection Opened
				if(isset($_POST['currentpass']) and $_POST['currentpass'] != '' and isset($_POST['newpass1']) and $_POST['newpass1'] != '' and isset($_POST['newpass2']) and $_POST['newpass2'] != '' and $_POST['newpass2'] == $_POST['newpass2'] and !$demo) {
					//At this point it is clear the user wishes to change their password
					$pass = mysqli_real_escape_string($conn,htmlspecialchars(hash('sha256', ($salt1 . ($_POST['currentpass']) . $salt2))));
					$query = "SELECT * FROM dash_users WHERE username='$user' AND userid='$id' AND password='" . $pass  . "'";
					if (mysqli_num_rows(mysqli_query($conn,$query)) == 0) echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Current password incorrect - Please try again</div>';
					else {
						 $updatequery = ("UPDATE dash_users SET password='" . mysqli_real_escape_string($conn,htmlspecialchars(hash('sha256', ($salt1 . ($_POST['newpass1']) . $salt2)))) . "' WHERE username='$user' AND userid='$id'");
						 $resultofupdatequery = mysqli_query($conn,$updatequery);
						 if (!$resultofupdatequery) die ("Database access failed please contact support");
						 echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Password Successfully Changed!</div>'; 
					}
				}
				elseif (isset($_POST['usernamechange']) and !$demo) {
					if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dash_users WHERE username='" . mysqli_real_escape_string($conn,htmlspecialchars(strtolower($_POST['usernamechange']))) . "'"))) {
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Username already in use - Please try again</div>';
					}
					else {
						$updatequery = ("UPDATE dash_users SET username='" . strtolower($_POST['usernamechange']) . "' WHERE userid='$id'");
						$resultofupdatequery = mysqli_query($conn,$updatequery);
						if (!$resultofupdatequery) die ("Database access failed please contact support");
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Username Successfully Changed!</div>'; 
						$user = strtolower($_POST['usernamechange']);  
						$_SESSION['user'] = strtolower($_POST['usernamechange']);  
					}
				}
				elseif (isset($_POST['emailchange']) and !$demo) {
					if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM dash_users WHERE email='" . mysqli_real_escape_string($conn,htmlspecialchars(strtolower($_POST['emailchange']))) . "'"))) {
						 echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>E-Mail already in use - Please try again</div>';
					}
					else {
						if (strpos($_POST['emailchange'], '@autheagle.com') === false) {
							$updatequery = ("UPDATE dash_users SET email='" . mysqli_real_escape_string($conn,htmlspecialchars(strtolower($_POST['emailchange']))) . "' WHERE userid='$id'");
							$resultofupdatequery = mysqli_query($conn,$updatequery);
							if (!$resultofupdatequery) die ("Database access failed please contact support");
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>E-Mail Successfully Changed!</div>'; 
							$email = strtolower($_POST['emailchange']);	   
						}	
						else echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>E-Mail address already in use</div>';
					}
				}
				elseif (isset($_POST['fnamechange']) and isset($_POST['lnamechange']) and !$demo) {
					$updatequery = ("UPDATE dash_users SET forename='" . mysqli_real_escape_string($conn,htmlspecialchars(($_POST['fnamechange']))) . "', surname='" . mysqli_real_escape_string($conn,htmlspecialchars(($_POST['lnamechange']))) . "' WHERE userid='$id'");
					$resultofupdatequery = mysqli_query($conn,$updatequery);
					if (!$resultofupdatequery) die ("Database access failed please contact support");
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Name Successfully Changed!</div>'; 
					$forename = $_POST['fnamechange'];
					$surname = ($_POST['lnamechange']);
				}
				elseif (isset($_GET['deleteaccount']) and isset($_GET['id']) and !isset($_GET['confirmed']) and !$demo) {
					echo '<div class="alert alert-danger"><b>N.B.</b> Deleting you account is irreversible - Are you sure you wish to delete it?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="settings.php?deleteaccount=true&id=' . $id . '&confirmed=true" class="alert-link">I am sure - Delete My Account</a>&nbsp;<i>&nbsp;or&nbsp;</i>&nbsp;<a href="#" data-dismiss="alert" class="alert-link">Cancel Request</a></div>';
				}
				elseif (isset($_GET['deleteaccount']) and isset($_GET['id']) and isset($_GET['confirmed']) and !$demo) {
					if ($_GET['id'] != $id) {
						echo '<div class="alert alert-danger"><b>N.B.</b>Unauthorized Request</div>';
					}
					else {
						$updatequery = ("UPDATE dash_users SET type='3' WHERE userid='$id'");
						$resultofupdatequery = mysqli_query($conn,$updatequery);
						if (!$resultofupdatequery) die ("Database access failed please contact support");
						die('<meta http-equiv="refresh" content="0; url=http://dash.uptimeagle.com/login.php?logout" />');
					}
				} elseif (isset($_FILES["profileimage"])) {
					$target_dir = "../profilepics/";
					$imageFileType = pathinfo(basename($target_dir . $_FILES["profileimage"]["name"],PATHINFO_EXTENSION));
					$imageFileType = strtolower($imageFileType['extension']);
					$randomnumber = rand(500,5000000000);
					$target_file = $target_dir . ($userid . '_' . str_replace(' ', '_', $forename) . str_replace(' ', '_', $surname) . '_' . $randomnumber) . '.' . $imageFileType;
					$uploadOk = true;
					// Check if image file is a actual image or fake image
					$check = getimagesize($_FILES["profileimage"]["tmp_name"]);
					if($check !== false) $uploadOk = true;
					else $uploadOk = false;
					// Check file size
					if ($_FILES["profileimage"]["size"] > 500000) $uploadOk = false;
					
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") $uploadOk = false;

					// Check if $uploadOk is set to 0 by an error
					if (!$uploadOk) {
						echo '<div class="alert alert-danger alert-dismissable">Sorry, your file was not uploaded - It could be because it is not a JPG, JPEG, PNG or GIF or because it was too large</div>';
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["profileimage"]["tmp_name"], $target_file)) {
							$path = basename($_FILES["profileimage"]["name"]);
							$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
							// Check connection
							if ($conn->connect_error) {
								die("Connection failed, please contact support");
							}
							date_default_timezone_set("Europe/London");
							$sql = "INSERT INTO `dash_profile_pictures` (`id`, `userid`, `filename`, `extension`, `uploaded`) VALUES (NULL, '" . $userid . "', '" . mysqli_real_escape_string($conn, ($userid . '_' . str_replace(' ', '_', $forename) . str_replace(' ', '_', $surname) . '_' . $randomnumber)) . "', '" . $imageFileType . "', '" . date('Y-m-d G:i:s') . "');";
							$result = $conn->query($sql);
							$sql = "UPDATE `dash_users` SET `profilepicture` = '" . $conn->insert_id . "' WHERE userid='" . $userid . "'";
							$result = $conn->query($sql);
							echo '<div class="alert alert-success alert-dismissable">Profile Picture Updated</div>';
						} else echo '<div class="alert alert-danger alert-dismissable">Sorry - There was an error uploading your picture</div>';
					}
				} elseif (isset($_POST['notificationsound'])) {
					$updatequery = ("UPDATE dash_users SET sound='" . mysqli_real_escape_string($conn, $_POST['notificationsound']) . "' WHERE userid='$id'");
					$resultofupdatequery = mysqli_query($conn,$updatequery);
					if (!$resultofupdatequery) die ("Database access failed please contact support");
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Default Sound Successfully Changed!</div>'; 
						
					
				} elseif (isset($_GET['disable2step']) and !$demo) {
					$updatequery = ("UPDATE dash_users SET 2stepsecret = NULL WHERE userid='$id'");
					$resultofupdatequery = mysqli_query($conn,$updatequery);
					if (!$resultofupdatequery) die ("Database access failed please contact support");
					echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>2Step Verification Disabled</div>'; 
					$twostep = false;
				} elseif (isset($_GET['setup2step']) and !$demo) {
					//require_once 'loginwith/login_libs/Google-Authenticator/GoogleAuthenticatorLib.php';
					require_once 'loginwith/login_libs/GoogleAuthenticator/GoogleAuthenticator.php';
					//$twostepobject = new PHPGangsta_GoogleAuthenticator();
					$twostepobject = new GoogleAuthenticator();
					$twostep = $twostepobject->generateSecret();
					//$twostep = $twostepobject->createSecret();
					$updatequery = ("UPDATE dash_users SET 2stepsecret = '" . $twostep . "' WHERE userid='$id'");
					$resultofupdatequery = mysqli_query($conn,$updatequery);
					if (!$resultofupdatequery) die ("Database access failed please contact support");
					echo '<div class="modal show" id="myModal" role="dialog">
							<div class="modal-dialog">
							
							  <!-- Modal content-->
							  <div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Setup 2Step Verification</h4>
								</div>
								<div class="modal-body">
								  <ol>
									   <li>
										  Download the Google Authentication App from your App Store
										  <ul>
											 <li><b>Android:</b>&nbsp;<a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">Google Play</a></li>
											 <li><b>iOS:</b>&nbsp;<a href="https://itunes.apple.com/gb/app/google-authenticator/id388497605" target="_blank">App Store</a></li>
										  </ul>
									   <li>Tap the plus icon in the top right hand corner</li>
									   <li>Scan this barcode:<br/>' . '<img src="' . $twostepobject->getURL('AuthEagle',$twostep) . '" alt="Barcode" />' . '</li>
									   <li>Setup complete - Click "Close" below and changes will fully take effect next time you login, when you will be asked for a code</li>
									</ol>
									<p>Experience a problem? DO NOT close this page <i>(You will be locked out of your account)</i> - Click <a href="?disable2step">here to cancel</a></p>
								</div>
								<div class="modal-footer">
								  <a href="?disable2step"><button type="button" class="btn btn-danger" data-dismiss="modal">Undo</button></a>  <a href="?"><button type="button" class="btn btn-default" data-dismiss="modal">Done</button></a>
								</div>
							  </div>
							  
							</div>
						  </div> ';
				}
				?>
			<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-user fa-fw"></i> Profile Settings
						</div>
						 
					   
						<!-- .panel-heading -->
						<div class="panel-body">
						
							<div class="panel-group" id="accordion">
								<div class="panel panel-default">
								<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Username</a>
										</h4>
									</div>
								
									
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
										<form id="changeuser" action="settings.php" method="POST"><table border="0"><tr><td style="width: 98.5%;">
						<input type="text" required class="form-control" style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; width: 98.5%;" id="usernamechange"  name="usernamechange" placeholder="Please enter a username" value="<?php echo $user; ?>">
					   </td><td><button type="submit" <?php echo ($demo ? ' disabled' : ''); ?> style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px;" class="btn btn-default">Save</button></center></td></tr></table>
						</form>
											
									</div></div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Name</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											
						<form id="changename" action="settings.php" method="POST"><table border="0"><tr><td style="width: 50%;">
						<input type="text" required class="form-control" style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; width: 98.5%;" id="fnamechange"  name="fnamechange" placeholder="Please enter a first name" value="<?php echo $forename; ?>">
					   </td><td style="width: 50%;"><input required type="text" class="form-control" style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; width: 98.5%;" id="lnamechange"  name="lnamechange" placeholder="Please enter a last name" value="<?php echo $surname; ?>">
					   </td><td><button type="submit" <?php echo ($demo ? ' disabled' : ''); ?> style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px;" class="btn btn-default">Save</button></center></td></tr></table>
						</form>
									</div></div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">E-Mail Address</a>
										</h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
										<div class="panel-body">
											<form id="changeemail" action="settings.php" method="POST"><table border="0"><tr><td style="width: 98.5%;">
						<input type="text" required class="form-control" style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; width: 98.5%;" id="emailchange"  name="emailchange" placeholder="Please enter an email" value="<?php echo $email; ?>">
					   </td><td><button type="submit" <?php echo ($demo ? ' disabled' : ''); ?> style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px;" class="btn btn-default">Save</button></center></td></tr></table>
						</form></div></div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Password</a>
										</h4>
									</div>
									<div id="collapseFour" class="panel-collapse collapse">
										<div class="panel-body">
										 		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
												<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>		   
						<form id="changepass" action="settings.php" method="POST">
						<input type="password" required class="form-control" style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; width: 98.5%;" id="currentpass" name="currentpass" placeholder="Current Password">
						<input type="password" required class="form-control" style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; width: 98.5%;" id="newpass1" name="newpass1" placeholder="New Password">
						<input type="password" required class="form-control" style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px; width: 98.5%;" id="newpass2"  name="newpass2" placeholder="Confirm New Password">
						<center><label style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px;" class="control-label" for="newpass2" id="errordetailspassmatcher"></label>
						<button type="submit" <?php echo ($demo ? ' disabled' : ''); ?> style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px;" id="submitbuttonformpasschange" class="btn btn-default">Save</button></center>
						</form>
						</div>
						 <script>
						$("#submitbuttonformpasschange").hide(); 
						$(document).ready(function() {
						  $("#newpass2").keyup(validate);
						});
						function validate() {
						  var password1 = $("#newpass1").val();
						  var password2 = $("#newpass2").val();

	
 
							if(password1 == password2) {
								$("#submitbuttonformpasschange").show();  
								$("#errordetailspassmatcher").hide();  
							}
							else {
								$("#errordetailspassmatcher").text("Passwords do not match");  
								$("#submitbuttonformpasschange").hide();  

							}
	
						}
						</script>	
										
										</div>
								</div></div>
<form action="settings.php" method="GET">
	
<input type="hidden" value="true" name="deleteaccount" />
<input type="hidden" value="<?php echo $id; ?>" name="id" />
<center><button type="submit"  style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px; margin-right: 5px;"  <?php echo ($demo ? ' disabled' : ''); ?>  class="btn btn-default">Delete Account</button></center>
			   </form>			 
						</div>
						
					</div>
			<!-- End Accordian -->
					
			


   </div>


		
		<!-- /#page-wrapper -->
		
		

	   
					  
						  <div class="col-lg-3">
						<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-facebook-square fa-fw"></i> Facebook
						</div>
						<div class="panel-body">
						<?php
						if ($facebookid == '') {
							echo '<a href="loginwith/facebook/connect.php"><img src="images/connect%20with%20icons/facebook.png" style="max-height: 60px;" /></a>';
						}
						else {
							echo 'Account is connected to Facebook - <a href="loginwith/facebook/disconnect.php">Revoke</a>';
						}
						?>
						
						 </div>
						 </div>
						  </div>
						  
						  <div class="col-lg-3">
						<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-twitter-square fa-fw"></i> Twitter
						</div>
						<div class="panel-body">
						<?php
						/*
						if ($twitterusername == '') {
							echo '<a href="loginwith/twitter/connect.php"><img src="images/connect%20with%20icons/twitter.png" style="max-height: 60px;" /></a>';
						}
						else {
							echo 'Account is connected to Twitter - <a href="loginwith/twitter/disconnect.php">Revoke</a>';
						}*/
						echo '<i>Twitter Connection Coming Soon</i>';
						?>
						
						 </div>
						 </div>
						  </div>
						  
						  <div class="col-lg-3">
							<div class="panel panel-default">
								<div class="panel-heading">
									2Step Verification
								</div>
								<div class="panel-body">
									<center><?php
									if ($twostep != false) {
										echo '2Step Verification Enabled - <a href="?disable2step"><i>Disable</i></a>
											<br/><br/>
											<i>Device lost or stolen? <a href="?setup2step">Disable previous app QR code and generate a new one</a></i>';
									}
									else {
										echo '<a href="?setup2step">
												<img src="images/connect%20with%20icons/Google-Authenticator-icon.png" alt="Setup 2 step" style="width: 50px;" />
												<p>Setup 2Step</p>
											</a>';
									}
									?></center>
								</div>
								<div class="box-footer">
									<p>2Step Verification keeps your account secure by requiring a second step to login to your account, after you have entered your username and password</p>
									<ol>
										<li>You login as normal with your username and password</li>
										<li>AuthEagle asks you for a code generated using your phone</li>
									</ol>
									<a href="https://en.wikipedia.org/wiki/Two-factor_authentication"><i>Read more about it on Wikipedia</i></a>
								 </div>
							 </div>
						  </div>
						  
						    <div class="col-lg-6">
						<div class="panel panel-default">
						<div class="panel-heading">
							Profile Picture
						</div>
						<div class="panel-body">
						<?php
						$profilepicture = mysqli_fetch_row(mysqli_query($conn,"SELECT profilepicture FROM `dash_users` WHERE userid='" . $userid . "'"))[0];
						if ($profilepicture != null) echo '<img src="images/profile_pictures/?image=' . $profilepicture . '" style="max-height: 250px; max-width: 250px;" alt="User Profile Image" />';
						?>
						<h4>Update you Profile Picture:</h4>
						  <form class="form" enctype="multipart/form-data" method="post">
							<div class="input-group text-center">
								<input name="profileimage" type="file" accept="image/*" required class="form-control input-lg" placeholder="Profile Picture">
								<span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit">Upload</button></span>
							</div>
						</form>
						</div>
						 </div>
						  </div>
						  <div class="col-lg-6">
						<div class="panel panel-default">
						<div class="panel-heading">
							Default Alert Sound
						</div>
						<div class="panel-body">
						<p>From time to time AuthEagle may need to alert you with a sound. To hear the sound you must have the dashboard open.</p>
						<h4>Choose your default sound:</h4>
						<script>
						function alertuser() {
							$(document).ready(function() {
								var audioElement = document.createElement('audio');
								audioElement.setAttribute('src', '/sounds/' + '<?php echo mysqli_fetch_row(mysqli_query($conn,"SELECT sound FROM `dash_users` WHERE userid='" . $userid . "'"))[0]; ?>' + '.mp3');
								audioElement.setAttribute('autoplay', 'autoplay');
								//audioElement.load()
								audioElement.play();
							});
						}
						function customalertuser(filenumber) {
							$(document).ready(function() {
								var audioElement = document.createElement('audio');
								audioElement.setAttribute('src', '/sounds/' + filenumber + '.mp3');
								audioElement.setAttribute('autoplay', 'autoplay');
								//audioElement.load()
								audioElement.play();
							});
						}
						</script>
						  <form class="form" method="post">
							<?php
							$sound = mysqli_fetch_row(mysqli_query($conn,"SELECT sound FROM `dash_users` WHERE userid='" . $userid . "'"))[0];
							echo '<input type="radio" name="notificationsound" value="1" ' . ($sound == 1 ? 'checked="checked"' : null) . '>Windows Alert Sound - <a onclick="customalertuser(1)">Preview</a><br/>
								<input type="radio" name="notificationsound" value="2" ' . ($sound == 2 ? 'checked="checked"' : null) . '>Facebook Ping - <a onclick="customalertuser(2)">Preview</a><br/>
								<input type="radio" name="notificationsound" value="3" ' . ($sound == 3 ? 'checked="checked"' : null) . '>Air Horn - <a onclick="customalertuser(3)">Preview</a><br/>
								<input type="radio" name="notificationsound" value="4" ' . ($sound == 4 ? 'checked="checked"' : null) . '>MacOSX Error - <a onclick="customalertuser(4)">Preview</a><br/>
								<input type="radio" name="notificationsound" value="5" ' . ($sound == 5 ? 'checked="checked"' : null) . '>Door Bell - <a onclick="customalertuser(5)">Preview</a><br/>
								<input type="radio" name="notificationsound" value="6" ' . ($sound == 6 ? 'checked="checked"' : null) . '>SpaceAge - <a onclick="customalertuser(6)">Preview</a><br/>
								<input type="radio" name="notificationsound" value="7" ' . ($sound == 7 ? 'checked="checked"' : null) . '>Alarm - <a onclick="customalertuser(7)">Preview</a><br/>
								<input type="radio" name="notificationsound" value="8" ' . ($sound == 8 ? 'checked="checked"' : null) . '>vogonJeltz - Word Cannon - <a onclick="customalertuser(8)">Preview</a><br/>';
							?>
							<input type="submit" class="form-control" value="Save" />
							
						</form>
						</div>
						 </div>
						  </div>
						  		</div>
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

<?php
$gotbootstrap = true;
$gotjquery = true;
require_once '../dash_foot.php';
?>