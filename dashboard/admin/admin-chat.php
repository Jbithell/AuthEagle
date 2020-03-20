<?php
$title = 'AdminChat';
require_once '../../dash_header.php';
if (!$admin) die('Sorry, you do not have access to this page');
?>
 <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			AdminChat
			<small>Internal Secure Admin Chat</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> Admin</a></li>
			<li class="active">Chat</li>
		  </ol>
		</section>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
		function alertuser() {
			$(document).ready(function() {
				var audioElement = document.createElement('audio');
				audioElement.setAttribute('src', '//dash.autheagle.com/sounds/<?php $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database); echo mysqli_fetch_row(mysqli_query($conn,"SELECT sound FROM `dash_users` WHERE userid='" . $userid . "'"))[0]; ?>.mp3');
				audioElement.setAttribute('autoplay', 'autoplay');
				//audioElement.load()
				audioElement.play();
			});
		}
		function notify(text) {
			if (!Notification) {
				alert('Please us a modern version of Chrome, Firefox, Opera or Firefox. I and this website despise internet explorer, as its terrible.');
				return;
			}
			if (Notification.permission !== "granted")
				Notification.requestPermission();
			var notification = new Notification('New Message', {
				icon: 'admin_chat/notificationlogo.png',
				body: text
			});
			notification.onclick = function () {
				window.open("<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>");
			}
		}
		function initial(){
			$("#loading").show();
			$.ajax({url: "/admin_chat/recieve.php?initial", success: function(result){
				$("#chat-box").html(result);
				$("#loading").hide();
			}});
		}
		function refresh(){
			$.ajax({url: "/admin_chat/time.php", success: function(result){
				$.ajax({url: ("/admin_chat/recieve.php?last=" + last), success: function(result){
					if (result !== '') {
						alertuser();
						notify('New message in AuthEagle admin chat');
					}
					$("#chat-box").html($("#chat-box").html() + result);
				}});
				/*$.ajax({url: ("/admin_chat/recieve_notify.php?last=" + last), success: function(result){
					var parsed = JSON.parse(result);
					var arrayresult = [];
					for(var x in parsed){
					  arrayresult.push(parsed[x]);
					}
					console.log(arrayresult);
					
					//notify();
				}});*/
				last = result;
				$("#loading").hide();
			}});
		}
		initial(); // This will run on page load
		var last = 0;
		$.ajax({url: "/admin_chat/time.php", success: function(result){
			last = result;
		}});
		setInterval(function(){
			refresh() // this will run after every 5 seconds
		}, 3000);
		
		
		
		function send() {
			$("#loading").show();
			$.ajax({url: ("/admin_chat/send.php?message=" + encodeURI($("#message").val()))});
			$("#message").val(null);
		}
		$('#message').keydown(function (e){
			if(e.keyCode == 13){
				send();
			}
		});
		</script>
		<!-- Main content -->
		<section class="content">
		<div class="row">
		   <div class="col-lg-12">
		   <!-- Chat box -->
			  <div class="box box-success">
				<div class="box-header">
				  <i class="fa fa-comments-o"></i>
				  <h3 class="box-title">Chat</h3>
				  <div class="box-tools pull-right" data-toggle="tooltip" title="Chat Category">
					<div class="btn-group">
					  <button type="button" class="btn btn-default btn-sm active"><!--<i class="fa fa-square text-green"></i>-->Standard View</button>
					  <script>
					  function hackerview() {
						window.open ('admin_chat/hackerview.php', 'AdminChat Hacker View', config='height=500,width=500, toolbar=no, menubar=no, scrollbars=no, resizable=no,location=no, directories=no, status=no');
					  }
					  </script>
					<button onclick="hackerview();" type="button" class="btn btn-default btn-sm"><!--<i class="fa fa-square text-red"></i>-->Matrix View</button>
					</div>
				  </div>
				</div>
				
				<div class="box-body chat" id="chat-box">
				  <!--Chat Window-->
				  <!--As found in response.txt-->
				  <!--End Chat Window-->
				</div><!-- /.chat -->
				<!--Loading Box-->
				<!--<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>-->
				<!--EndLoading Box-->
				<div class="box-footer">
				  <div class="input-group">
					<input class="form-control" id="message" placeholder="Type message..."/>
					<div class="input-group-btn">
					  <button class="btn btn-default" onclick="send()">Send</button>
					</div>
				  </div>
				</div>
				<div class="overlay" id="loading">
				  <i class="fa fa-refresh fa-spin"></i>
				</div>
			  </div><!-- /.box (chat box) -->
			</div>
		</div>
		</section><!-- /.content -->
	  </div><!-- /.content-wrapper -->

<?php  
$gotjquery = true;
require_once '../../dash_foot.php';
?>