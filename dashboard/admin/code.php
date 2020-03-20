<?php
$title = 'Admin Template';
require_once '../../dash_header.php';
if (!$admin) die('Sorry, you do not have access to this page');
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Auth Eagle Admin
			<small>Template</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Template</li>
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-6">
				  <div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title">MySQL<sup>i</sup></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<pre>
//Check you have required dash_header.php!
// Create connection
$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($conn->connect_error) errormessage('SQL Connection Error', 'Please contact support');
$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<table><tr><th>ID</th><th>Name</th></tr>";
// output data of each row
while($row = $result->fetch_assoc()) {
	echo "<tr><td>" . $row["id"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td></tr>";
}
	echo "</table>";
} else {
	echo "0 results";
}
					</pre>
					</div>
				</div>
			</div>
		</div>

		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

<?php  
require_once '../../dash_foot.php';
?>