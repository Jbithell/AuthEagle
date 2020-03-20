<?php
$title = 'Search results for ' . $_GET['q'];
require_once '../dash_header.php';
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Search
			<small>Showing results for <?php echo $_GET['q']; ?></small>
		  </h1>
		  <!--<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
			<li class="active">Here</li>
		  </ol>-->
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-lg-6">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Users</h3>
						</div><!-- /.box-header -->
						<div class="box-body no-padding">
						  <table class="table table-striped">
							<tr>
							  <th style="width: 10px">#</th>
							  <th>Name</th>
							  <th>Username</th>
							  <th>E-Mail</th>
							</tr>
							
						  <?php
							$keyword = mysqli_real_escape_string($conn, $_GET['q']);
							// Check connection
							if ($conn->connect_error) errormessage('SQL Connection Error', 'Please contact support');
							$sql = "SELECT forename, surname, username, email FROM engine_users INNER JOIN sites ON engine_users.site=sites.id WHERE sites.userid='" . $userid . "' AND (engine_users.forename LIKE '%" . $keyword . "%' OR engine_users.surname LIKE '%" . $keyword ."%' OR engine_users.username LIKE '%" . $keyword ."%' OR engine_users.email LIKE '%" . $keyword ."%')";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$counter = 1;
								while($row = $result->fetch_assoc()) {
									echo '<tr><td>' . $counter . '</td>';
									echo '<td>' . $row['forename'] . ' ' . $row['surname'] . '</td><td>' . $row['username'] . '</td><td>' . $row['email'] . '</td></tr>';
									$counter ++;
								}
							} else {
								echo '<tr><td colspan="4"><center><i>No Results</i></center></td></tr>';
							}
							?>
							</table>
						</div><!-- /.box-body -->
					  </div><!-- /.box -->
			</div>
			<div class="col-lg-6">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Websites</h3>
						</div><!-- /.box-header -->
						<div class="box-body no-padding">
						  <table class="table table-striped">
							<tr>
							  <th style="width: 10px">#</th>
							  <th>Name</th>
							  <th>URL</th>
							  <th></th>
							</tr>
							
						  <?php
							$sql = "SELECT * FROM sites WHERE userid='" . $userid . "' AND (name LIKE '%" . $keyword . "%' OR url LIKE '%" . $keyword ."%')";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$counter = 1;
								while($row = $result->fetch_assoc()) {
									echo '<tr><td>' . $counter . '</td>';
									echo '<td>' . $row['name'] . '</td><td>' . $row['url'] . '</td><td><a href="/sites/' . $row['domain'] . '">Settings</a></td></tr>';
									$counter ++;
								}
							} else {
								echo '<tr><td colspan="3"><center><i>No Results</i></center></td></tr>';
							}
							?>
							</table>
						</div><!-- /.box-body -->
					</div><!-- /.box -->
			</div>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php  
require_once '../dash_foot.php';

?>