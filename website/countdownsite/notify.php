<?php
if (!isset($_POST['email'])) header('Location: https://autheagle.com');
$file = fopen("notify.csv", "a");
fputcsv($file, array($_POST['email'],$_SERVER["HTTP_CF_CONNECTING_IP"],$_SERVER["HTTP_CF_IPCOUNTRY"]));
fclose($file);
echo 'Thanks for signing up! We will let you know when we go live.';
?>