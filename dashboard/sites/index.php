<?php
header("Status: 200");
$title = 'Website Settings';
require_once '../../dash_header.php';
if (isset($_GET['addnewsite'])) {
	//Add the new site and confirm it looks ok!
	//url,type,name,domain DONT FORGET STRING TO LOWER!
	
	die('Site Settings/Add with the correct number');
} elseif (isset($_GET['new'])) $new = true;
else {
	$new = false;
	$domain = str_replace("/sites/","",strtolower($_SERVER['REQUEST_URI']));
	$sql = "SELECT * FROM sites WHERE domain='" . mysqli_real_escape_string($conn, $domain) . "'";
	$result = $conn->query($sql);
	if ($result->num_rows != 1) errormessage('Site not Found', 'Sorry - It appears that this site no longer exists, please contact support using the links below if you have any quires.');
	$data = mysqli_fetch_row($result);
	if ($data[1] != $userid) errormessage('Incorrect Permissions', 'Sorry - It appears that you do not have permission to access this site, please contact support using the links below if you have any quires.');
}
echo '<!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>';
		  if ($new) echo 'Add New <small>Add a new website to your collection</small>';
		  else echo $data[5] . '<small>Manage your site</small>';
		  echo '</h1>
		  <ol class="breadcrumb">
			<li><a href="sites.php"><i class="fa fa-dashboard"></i> My Sites</a></li>';
			if ($new) echo '<li class="active">Add New</li>';
			else echo '<li class="active">' . $data[5] . '</li>';
		echo '</ol>
		</section>

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<!-- left column -->
			<div class="col-lg-6">
			  <!-- general form elements -->
			  <div class="box box-primary">
				<div class="box-header">
				  <h3 class="box-title">Site Details</h3>
				</div><!-- /.box-header -->
				<!-- form start -->
				<form role="form" method="post">
				<input type="hidden" name="addnewsite" value="true" />
				  <div class="box-body">
					<div class="form-group">
					  <label for="name">Name</label>
					  <input type="name" class="form-control" name="name" id="name" placeholder="Site Name"' . (!$new ? 'value="' . $data[5] . '"' : null) . '>
					</div>
					<div class="form-group" id="domain_field_verification">
						<!--form-group has-success/form-group has-warning/form-group has-error"-->
						<label for="domain">Domain</label>
						<input type="url" class="form-control" name="domain" id="domain" placeholder="Site Domain" ' . (!$new ? 'value="' . $data[2] . '"' : null) . '>
					</div>
					<script>
					document.getElementById("domain_field_verification").className = "MyClass";
					</script>
					<div class="form-group" id="url_field_verification">
					  <label for="url_input">URL</label>
					   <table border="0" style="width: 100%;">
							<tr style="width: 100%;">
								<td style="width: 95px;">
									<select name="type" class="form-control" style="width: 95px;">
										<option value="http"';
										if (!$new and $data[6] == 'http') echo 'selected';
										echo '>http://</option>
										<option value="https"';
										if (!$new and $data[6] == 'https') echo 'selected';
										echo '>https://</option>
									</select>
								</td>
								<td style="width: 100%;">
									<input type="url" name="url" class="form-control" id="url_input" placeholder="Site URL" ' . (!$new ? 'value="' . $data[3] . '"' : null) . '>
								</td>
							</tr>
						</table>
					</div>
					<script>
					function myFunction() {
						if (document.getElementById("url_field_verification").value) {
							document.getElementById("url_field_verification").className = "form-group has-error";
						} else {
							document.getElementById("url_field_verification").className = "form-group has-success";
						}
					}
					</script>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
					<button type="submit" class="btn btn-primary">Add</button>
				  </div>
				</form>
			  </div><!-- /.box -->
			  		  
			</div>
			<div class="col-lg-6">
			  <!-- general form elements -->
			  <div class="box box-default">
				<div class="box-header">
				  <h3 class="box-title">Preview</h3>
				</div><!-- /.box-header -->
				<div class="box-body">
				<iframe frameborder="0" id="preview" style="width: 100%; height: 500px;"><p>Site preview error</p></iframe>
				
				</div>
				</div><!-- /.box-body -->
				</form>
			  </div><!-- /.box -->
			</div>
		
			</div><!-- /.row -->
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->';
require_once '../../dash_foot.php';

?>