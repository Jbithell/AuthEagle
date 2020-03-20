<?php
require_once '../../../dash_auth.php';
//Check you have required dblogins!
// Create connection
date_default_timezone_set("Europe/London");
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) die("Connection failed, please contact support");
if (isset($_GET['view'])) {
	if ($_GET['view'] == 'hacker') {
		if (isset($_GET['last'])) $last = urldecode($_GET['last']);
		$sql = "SELECT * FROM admin_chat_messages LEFT JOIN dash_users ON admin_chat_messages.userid=dash_users.userid WHERE admin_chat_messages.sent >= '";
		if (isset($_GET['initial'])) {
			$sql .= date('Y-m-d H:i:s' , strtotime("-1 day"));
		} else {
			if (isset($last)) {
				$sql .= date('Y-m-d H:i:s', $last);
			} else {
				$sql .= date('Y-m-d H:i:s', strtotime("-3 hours"));
			}
		}
		$sql .= "'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<p>EAGLE:\users\administrators\>' . $row["forename"]. " " . $row["surname"]. ': ' . $row["message"] . '</p><br/>';
			}
		}
	}
} else {
	if (isset($_GET['last'])) $last = urldecode($_GET['last']);
	$sql = "SELECT * FROM admin_chat_messages LEFT JOIN dash_users ON admin_chat_messages.userid=dash_users.userid WHERE admin_chat_messages.sent >= '";
	if (isset($_GET['initial'])) {
		$sql .= date('Y-m-d H:i:s' , strtotime("-1 day"));
	} else {
		if (isset($last)) {
			$sql .= date('Y-m-d H:i:s', $last);
		} else {
			$sql .= date('Y-m-d H:i:s', strtotime("-3 hours"));
		}
	}
	$sql .= "'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<div class="item">';
			if ($row["profilepicture"] != null) echo '<img src="//dash.autheagle.com/images/profile_pictures/?image=' . $row["profilepicture"] . '" alt="user image" />';
			else echo '<img src="//admin.autheagle.com/admin_chat/defaultprofilepicture.png" alt="user image" />';
				echo '<p class="message">
				  <a class="name">
					<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> ' . date('h:m', strtotime($row["sent"])) . '</small>
					' . $row["forename"]. " " . $row["surname"]. '
				  </a>';
				  echo str_replace("(Y)",'<img src="admin_chat/thumbs.png" alt="Thumbs Up" />',$row["message"]);
				echo '</p>';
				if (isset($row["attachment"])) {
					echo '<div class="attachment">
							<h4>Attachments:</h4>
							<p class="filename">
								Theme-thumbnail-image.jpg
							</p>
							<div class="pull-right">
								<button class="btn btn-primary btn-sm btn-flat">Open</button>
							</div>
						</div>';
				} 
			echo '</div>';
		}
	}
}
$conn->close();
/*echo '<!-- chat item -->
				  <div class="item">
					<img src="dist/img/user4-128x128.jpg" alt="user image" class="online"/>
					<p class="message">
					  <a href="#" class="name">
						<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
						Mike Doe
					  </a>
					  I would like to meet you to discuss the latest news about
					  the arrival of the new theme. They say it is going to be one the
					  best themes on the market
					</p>
					<!-- /.attachment -->
				  </div><!-- /.item -->
				  <!-- chat item -->
				  <div class="item">
					<img src="dist/img/user3-128x128.jpg" alt="user image" class="offline"/>
					<p class="message">
					  <a href="#" class="name">
						<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
						Alexander Pierce
					  </a>
					  I would like to meet you to discuss the latest news about
					  the arrival of the new theme. They say it is going to be one the
					  best themes on the market
					</p>
				  </div><!-- /.item -->
				  <!-- chat item -->
				  <div class="item">
					<img src="dist/img/user2-160x160.jpg" alt="user image" class="offline"/>
					<p class="message">
					  <a href="#" class="name">
						<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
						Susan Doe
					  </a>
					  I would like to meet you to discuss the latest news about
					  the arrival of the new theme. They say it is going to be one the
					  best themes on the market
					</p>
				  </div><!-- /.item -->';*/
				  
?>