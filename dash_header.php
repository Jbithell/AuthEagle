<?php
require_once 'dash_auth.php';
echo '<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<title>';
	if (isset($title)) echo $title . ' | AuthEagle';
			else echo 'Auth Eagle Dashboard';
		echo '</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.2 -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Font Awesome Icons -->
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="//code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="//dash.autheagle.com/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
		  page. However, you can choose any other skin. Make sure you
		  apply the skin class to the body tag so the changes take effect.
	-->
	<link href="//dash.autheagle.com/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="//oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the 
  desired effect
  |---------------------------------------------------------|
  | SKINS		 | skin-blue							   |
  |			   | skin-black							  |
  |			   | skin-purple							 |
  |			   | skin-yellow							 |
  |			   | skin-red								|
  |			   | skin-green							  |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed								   |
  |			   | layout-boxed							|
  |			   | layout-top-nav						  |
  |			   | sidebar-collapse						|  
  |---------------------------------------------------------|
  
  -->
  <body class="skin-blue sidebar-collapse">
	<div class="wrapper">

	  <!-- Main Header -->
	  <header class="main-header">

		<!-- Logo -->
		<a href="/" class="logo"><b>AuthEagle</b></a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
		  <!-- Sidebar toggle button-->
		  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		  </a>
		  <!-- Navbar Right Menu -->
		  <div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
			  <!-- Messages: style can be found in dropdown.less-->
			  <li class="dropdown messages-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <i class="fa fa-envelope-o"></i>
				  <span class="label label-success">4</span>
				</a>
				<ul class="dropdown-menu">
				  <li class="header">Latest from the Blog</li>
				  <li>
					<!-- inner menu: contains the messages -->
					<ul class="menu">
					  <li>
						<a href="#">
						  <h4>							
							Support Team
							<small><i class="fa fa-clock-o"></i> 5 mins</small>
						  </h4>
						  <p>Why not buy a new awesome theme?</p>
						</a>
					  </li><!-- end message -->					  
					</ul><!-- /.menu -->
				  </li>
				  <li class="footer"><a href="#">See All Messages</a></li>
				</ul>
			  </li><!-- /.messages-menu -->

			  <!-- Notifications Menu -->
			  <li class="dropdown notifications-menu">
				<!-- Menu toggle button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <i class="fa fa-bell-o"></i>
				  <span class="label label-warning">10</span>
				</a>
				<ul class="dropdown-menu">
				  <li class="header">You have 10 notifications</li>
				  <li>
					<!-- Inner Menu: contains the notifications -->
					<ul class="menu">
					  <li><!-- start notification -->
						<a href="#">
						  <i class="fa fa-users text-aqua"></i> 5 new members joined today
						</a>
					  </li><!-- end notification -->					  
					</ul>
				  </li>
				  <li class="footer"><a href="#">View all</a></li>
				</ul>
			  </li>
			  <!-- Tasks Menu -->
			  <li class="dropdown tasks-menu">
				<!-- Menu Toggle Button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <i class="fa fa-flag-o"></i>
				  <span class="label label-danger">9</span>
				</a>
				<ul class="dropdown-menu">
				  <li class="header">You have 9 tasks</li>
				  <li>
					<!-- Inner menu: contains the tasks -->
					<ul class="menu">
					  <li><!-- Task item -->
						<a href="#">
						  <!-- Task title and progress text -->
						  <h3>
							Design some buttons
							<small class="pull-right">20%</small>
						  </h3>
						  <!-- The progress bar -->
						  <div class="progress xs">
							<!-- Change the css width attribute to simulate progress -->
							<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
							  <span class="sr-only">20% Complete</span>
							</div>
						  </div>
						</a>
					  </li><!-- end task item -->					  
					</ul>
				  </li>
				  <li class="footer">
					<a href="#">View all tasks</a>
				  </li>
				</ul>
			  </li>
			  <!-- User Account Menu -->
			  <li class="dropdown user user-menu">
				<!-- Menu Toggle Button -->
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				  <!-- The user image in the navbar-->';
				  if ($profilepicture != null) echo '<img src="//dash.autheagle.com/images/profile_pictures/?image=' . $profilepicture . '" class="user-image" alt="User Profile Image"/>';
				 echo '<!-- hidden-xs hides the username on small devices so only the image appears. -->
				  <span class="hidden-xs">' . $username . '</span>
				</a>
				<ul class="dropdown-menu">
				  <!-- The user image in the menu -->
				  <li class="user-header"> ';
				  if ($profilepicture != null) echo '<img src="//dash.autheagle.com/images/profile_pictures/?image=' . $profilepicture . '" class="img-circle" alt="User Profile Image"/>';
				 echo '<p>
					  ' . $forename . ' ' . $surname . '
					  <small>User since ' . date("M. Y", strtotime($created)) . '</small>
					</p>
				  </li>
				  <!-- Menu Body -->
				  <li class="user-body">
					<div class="col-xs-4 text-center">
					  <a href="#">Followers</a>
					</div>
					<div class="col-xs-4 text-center">
					  <a href="#">Sales</a>
					</div>
					<div class="col-xs-4 text-center">
					  <a href="#">Friends</a>
					</div>
				  </li>
				  <!-- Menu Footer-->
				  <li class="user-footer">
					<div class="pull-left">
					  <a href="//dash.autheagle.com/settings.php" class="btn btn-default btn-flat">Profile</a>
					</div>
					<div class="pull-right">
					  <a href="//dash.autheagle.com/login.php?logout" class="btn btn-default btn-flat">Sign out</a>
					</div>
				  </li>
				</ul>
			  </li>
			</ul>
		  </div>
		</nav>
	  </header>
	  <!-- Left side column. contains the logo and sidebar -->
	  <aside class="main-sidebar">

		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">

		  <!-- Sidebar user panel (optional) -->
		  <!--<div class="user-panel">
			<div class="pull-left image">
			  <img src="//placehold.it/160x160" class="img-circle" alt="User Image" />
			</div>
			<div class="pull-left info">
			  <p>Alexander Pierce</p>
			  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		  </div>-->

		  <!-- search form (Optional) -->
		  <form action="//dash.autheagle.com/search.php" method="get" class="sidebar-form">
			<div class="input-group">
			  <input type="text" name="q" class="form-control" placeholder="Search..."/>
			  <span class="input-group-btn">
				<button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			  </span>
			</div>
		  </form>
		  <!-- /.search form -->

		  <!-- Sidebar Menu -->
		  <ul class="sidebar-menu">
			<!--<li class="header">AuthEagle</li>-->
			<!-- Optionally, you can add icons to the links -->
			<li><a href="//dash.autheagle.com"><span>Dashboard</span></a></li>
			<li><a href="//dash.autheagle.com/sites.php"><span>My Sites</span></a></li>
			<li><a href="//support.autheagle.com"><span>Support</span></a></li>';
			if ($admin) {
				echo '<li class="treeview">
					  <a href="#"><span>Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
					  <ul class="treeview-menu">
						<li><a href="//admin.autheagle.com/theme.php">Theme</a></li>
						<li><a href="//admin.autheagle.com/mysql.php">MySQL</a></li>
						<li><a href="//admin.autheagle.com/hasher.php">Password Hasher</a></li>
						<li><a href="//admin.autheagle.com/logins.php">Logins</a></li>
						<li><a href="//admin.autheagle.com/admin-chat.php">Admin Chat</a></li>
					  </ul>
					</li>';
			}
			echo '
		  </ul><!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	  </aside>';
		function errormessage($title = 'Major Error', $message = 'AuthEagle has encountered a serious and unexpected error - Please contact our support team for more information.') {
			echo '<div class="content-wrapper">
					<section class="content">
						<div class="row">
							<div class="col-lg-12">';
			echo '<div class="callout callout-danger">
					<h4>' . $title . '</h4>
					<p>' . $message .'</p>
				</div>';
			echo '				</div>
							</div>
						</div>
					</div>';
			require 'dash_foot.php';
			exit;
		}
		function infomessage($title = 'Info', $message) {
			echo '<div class="alert alert-info alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> ' . $title . '</h4>
				' . $message . '
			  </div>';
		}
		function warningmessage($title = 'Warning', $message) {
			echo '<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> ' . $title . '</h4>
				' . $message . '
			  </div>';
		}
		function successmessage($title = 'Success', $message) {
			echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-info"></i> ' . $title . '</h4>
				' . $message . '
			  </div>';
		}
?>