<?php
require_once '../../../dash_auth.php';
if (!$admin) die('Sorry, you do not have access to this page');
?>
<html>
<head>
<title>AuthEagle Admin Chat</title>
<style>
body {
    background-image:url('matrix.gif');
    background-repeat:no-repeat;
    background-size:cover;
}
p {
    color: white;
	margin: 0px;
}
#footer {
    position: fixed;
    bottom: 0;
    width: 100%;
}
input { 
    border: 0px; 
    outline:0;
	color: #FFFFFF;
	background:rgba(0,0,0,0);
} 
</style> 

</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
function initial(){
	$("#loading").show();
	$.ajax({url: "/admin_chat/recieve.php?view=hacker&initial", success: function(result){
		$("#chat-box").html(result);
		$("#loading").hide();
	}});
}
function refresh(){
	$.ajax({url: "/admin_chat/time.php", success: function(result){
		$.ajax({url: ("/admin_chat/recieve.php?view=hacker&last=" + last), success: function(result){
			if (result !== '') {
				alertuser();
			}
			$("#chat-box").html($("#chat-box").html() + result);
		}});
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
$('#message').keydown(function (e){
    if(e.keyCode == 13){
        $("#loading").show();
		$.ajax({url: ("/admin_chat/send.php?message=" + encodeURI($("#message").val()))});
		$("#message").val(null);
    }
});
</script>
</head>
<body>
<p>AuthEagle Admin Chat<br/>
Version 1.0<br/><br/></p>
<div id="chat-box"></div>
<br/><br/><br/><br/>
<div id="footer">
<table border="0"><tr style="width: 100%;"><td style="min-width: 300px;"><p>EAGLE:\users\administrators\><?php echo $forename . ' ' . $surname; ?></p></td><td style="width: 100%;"><input class="form-control" id="message" autofocus style="width: 100%; height: 30px;" /></td></tr></table>
</div>
</body>
</html>