<?php
$title = 'Admin';
require_once '../../dash_header.php';
if (!$admin) die('Sorry, you do not have access to this page');
date_default_timezone_set("Europe/London");
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Auth Eagle Admin
		  </h1>
		  <ol class="breadcrumb">
			<li class="active"><i class="fa fa-dashboard"></i> Admin</a></li>
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
		  <!-- Small boxes (Stat box) -->
		  <div class="row">
		  <?php
		  $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
		// Check connection
		if ($conn->connect_error) die("Connection failed, please contact support");
		  echo '
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <h3>';
					$curl = curl_init('https://autheagle.freshdesk.com/helpdesk/tickets/filter/new_and_my_open?format=json');
					curl_setopt($curl, CURLOPT_FAILONERROR, true);
					curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_USERPWD, '3tIXgUeAsAceDyZp7df:X');
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					$result = curl_exec($curl);
					$result = count(json_decode($result, true));
					echo $result;
				  echo '</h3>
				  <p>Open Support Ticket' . ($result > 1 ? 's' : null) . '</p>
				</div>
				<div class="icon">
				  <i class="ion ion-email-unread"></i>
				</div>
				<a href="//support.autheagle.com" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <h3>';
					$loginscount = number_format(mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM dash_tokens WHERE `created` > '" . date('Y-m-d G:i:s', strtotime("-1 hour")) . "'"))[0]);
					echo $loginscount;
					echo '</h3>
				  <p>Login' . ($loginscount > 1 ? 's' : null) . ' in the last hour</p>
				</div>
				<div class="icon">
				  <i class="ion ion-stats-bars"></i>
				</div>
				<a href="logins.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h3>' . number_format(mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM dash_users"))[0]) . '</h3>
				  <p>Users</p>
				</div>
				<div class="icon">
				  <i class="ion ion-person-add"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div><!-- ./col -->
			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-red">
				<div class="inner">
				  <h3>65</h3>
				  <p>Unique Visitors</p>
				</div>
				<div class="icon">
				  <i class="ion ion-pie-graph"></i>
				</div>
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			  </div>
			</div><!-- ./col -->';
			?>
		  </div><!-- /.row -->
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

<?php  
require_once '../../dash_foot.php';
?>