<?php
$title = 'Theme';
require_once '../../dash_header.php';
if (!$admin) die('Sorry, you do not have access to this page');
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			AuthEagle Theme
			<!--<small>Template</small>-->
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Theme</li>
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<iframe src="/theme/" style="width: 100%; height: 500px;" frameborder="0"><p>iFrame error</p></iframe>
			</div>
			
		</div>
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

<?php  
require_once '../../dash_foot.php';
?>