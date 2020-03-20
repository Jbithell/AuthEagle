<?php
$title = 'Hasher';
require_once '../../dash_header.php';
if (!$admin) die('Sorry, you do not have access to this page');
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Hasher
			<small>For making passwords suitable for the mysql database</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Hasher</li>
		  </ol>
		</section>

		<!-- Main content -->
		<section class="content">
		<div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Password Hasher</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST">
                  <div class="box-body">
				  <i>To change your password use the profile page, not this system!</i>
				  <?php
					require_once '../../salts.php';
					if (isset($_POST['pass'])) {
						echo $_POST['pass'] . ' = ' . hash('sha256', ($salt1 . ($_POST['pass']) . $salt2));
					}
					?>
                    <div class="form-group">
                      <input type="text" class="form-control" name="pass" placeholder="Enter Password">
                    </div>
					</div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Hash!</button>
                  </div>
                </form>
			</div>
		</div>
	</div>
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

<?php  
require_once '../../dash_foot.php';
?>