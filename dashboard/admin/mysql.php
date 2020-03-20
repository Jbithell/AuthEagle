<?php
$title = 'MySQL Access';
require_once '../../dash_header.php';
if (!$admin) die('Sorry, you do not have access to this page');
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			MySQL
			<small>phpMyAdmin</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">MySQL</li>
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-lg-12">
			<div class="well">
			<p>Enter the following details on the next page to access phpMyAdmin:</p>
			<b>Username:</b> <?php echo $db_username; ?><br/>
			<b>Password:</b> <?php echo $db_password; ?><br/>
			<a href="http://admin.autheagle.com/mysql/"><button class="btn btn-block btn-primary">Login to phpMyAdmin</button></a>
			</div>
			</div>
		</div>
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

<?php  
require_once '../../dash_foot.php';
?>