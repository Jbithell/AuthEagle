<?php
$title = 'My Websites';
require_once '../dash_header.php';
?>
<?php 
	echo '<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			My Websites
			<small></small>
		  </h1>
		  <!--<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
			<li class="active">Here</li>
		  </ol>-->
		</section>
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-xs-12">
			  <div class="box">
				<div class="box-header">
				  <h3 class="box-title">List View</h3>
				  <div class="box-tools">
					 <form action="search.php" method="get">
					<div class="input-group">
					  <input type="text" name="q" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
					  <div class="input-group-btn">
						<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
					  </div>
					  </div>
					</form>
				  </div>
				</div><!-- /.box-header -->
				<div class="box-body table-responsive no-padding">
				  <table class="table table-hover">
					<tr>
					  <th>Name</th>
					  <th>Domain</th>
					  <th>URL</th>
					  <th></th>
					</tr>';
					//Check you have required dblogins!
					// Create connection
					$conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
					// Check connection
					if ($conn->connect_error) die("Connection failed, please contact support"); 
					$sql = "SELECT * FROM sites WHERE userid='" . $userid . "'";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo '<tr><td>' . $row['name']. '</td><td>' . $row['domain']. '</td><td>' . $row['url']. '</td><td><a href="/sites/' . $row['domain'] . '"><i class="fa fa-cog"></i></a></td></tr>';
					}
					} else {
					echo '<tr><td colspan="3"><center><i>You haven\'t setup any sites yet - <a href="/sites/?new">Add new site</a></i></center></td></tr>';
					}
					$conn->close();
					echo '</table>
				  
				</div><!-- /.box-body -->
				<div class="box-body">
					<center><a href="/sites/?new"><button class="btn btn-sm btn-default"><i class="fa fa-plus"></i> Add New Site</button></a></center>
				</div>
			  </div><!-- /.box -->
			</div>
		  </div>
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->';
require_once '../dash_foot.php';

?>