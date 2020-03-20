<?php
$subdomain = array_shift((explode(".",$_SERVER['HTTP_HOST'])));
echo 'Domain: "' . $subdomain . '.autheagle.com" has not yet been setup. - Please check back later or contact our support team at support@autheagle.com!';
?>