<?php
require_once '../../dash_auth.php';
if (!$admin or !$support_team) die('<center><i>Sorry, you do not have access to this page</i></center>');
if (!isset($_GET['email'])) die('Requester E-Mail address invalid');
// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
// Check connection
if ($conn->connect_error) die("Connection failed, please contact support");
$sql = "SELECT * FROM dash_users WHERE email LIKE '%" . mysqli_real_escape_string($conn, $_GET['email']) . "%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table border=\"0\">";
	// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			if ($row["profilepicture"] != null) echo '<tr><td colspan="2"><center><img src="//dash.autheagle.com/images/profile_pictures/?image=' . $profilepicture . '" class="img-circle" style="max-height: 200px; max-width: 200px;" alt="User Profile Image"/></center></td></tr>';
			echo '<td colspan="2"><center>' . $row["forename"]. " " . $row["surname"]. ' (' . $row["username"] . ')</center></td>';
			echo '</tr>';
			if ($row["notes"] != null) echo '<tr><td><b>Notes: </b></td><td>' . $row["notes"] . '</td></tr>';
			if ($row["suspensionreason"] != null) echo '<tr><td><b>Suspension Reason: </b></td><td>' . $row["suspensionreason"] . '</td></tr>';
			if ($row["country"] != null) echo '<tr><td><b>Country: </b></td><td>' . $row["country"] . '</td></tr>';
			if ($row["currency"] != null) echo '<tr><td><b>Currency: </b></td><td>' . $row["currency"] . '</td></tr>';
			$sites_sql = "SELECT COUNT(`id`) FROM `sites` WHERE `userid`=" . $row["userid"];
			$sites_result = mysqli_fetch_row($conn->query($sites_sql));
			echo '<tr><td><b>Number of Sites: </b></td><td>' . $sites_result[0] . '</td></tr>';
		}
	echo "</table>";
} else die('<i>User not found on AuthEagle Database</i>');
$conn->close();
?>