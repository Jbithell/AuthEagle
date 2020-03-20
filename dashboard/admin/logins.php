<?php
$title = 'Logins';
require_once '../../dash_header.php';
if (!$admin) die('Sorry, you do not have access to this page');
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Logins
			<small>A list of logins</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Logins</li>
		  </ol>
		</section>
		<!-- Main content -->
		<section class="content">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">List of Logins to AuthEagle</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
						<?php
							$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
							// Check connection
							if ($conn->connect_error) {
								die("Connection failed");
							} 
							$sql = "SELECT * FROM dash_tokens LEFT JOIN dash_users ON dash_tokens.userid=dash_users.userid ORDER BY dash_tokens.created DESC";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								echo '<table class="table table-bordered table-striped" id="tokens">
							<thead>
								<tr>
									<th>Type</th>
									<th>Date</th>
									<th>Time</th>
									<th>User</th>
									<th>IP address</th>
									<th>Location</th>
									<th>Operating System</th>
									<th>Browser</th>
								</tr>
							</thead>
							<tbody>';
							while($row = $result->fetch_assoc()) {
								echo '<tr><td>';
								echo $row["devicetype"];
								echo "</td><td>".date("d/m/y", strtotime($row["created"]))."</td><td>".date("h:i:sa", strtotime($row["created"]))."</td><td>".$row["ip"]."</td><td>".$row["forename"].' '.$row["surname"].' (' . $row["username"] . ' - ' . $row["userid"] . ')'."</td><td>".$row["location"]."</td><td>".$row["os"].'</td>' . "<td>".$row["browser"].'</td>';
							}
							echo '</tr></tbody><tfoot>
								<tr>
									<th>Type</th>
									<th>Date</th>
									<th>Time</th>
									<th>User</th>
									<th>IP address</th>
									<th>Location</th>
									<th>Operating System</th>
									<th>Browser</th>
								</tr>
							</tfoot></table>';
						} else {
							echo "<center><i>Error</i></center>";
						}
						$conn->close();
							?>
					</div>
					</div>
				</div>
			</div>
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->
	  <!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.6/css/jquery.dataTables.min.css">
	   <link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.css">-->
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
	  <script src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.min.js"></script>
	   <script src="//cdn.datatables.net/plug-ins/1.10.6/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script>
      $(function () {
        $('#tokens').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": false,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
<?php  
$gotjquery = true;
$gotbootstrap = true;
require_once '../../dash_foot.php';
?>