<?php
if (!isset($_GET['url'])) die('Please enter a valid url');
$url = $_GET['url'];
echo '<iframe frameborder="0" style="width: 100%; height: 100%" src="' . $url . '" ></iframe>';
?>