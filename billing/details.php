<?php
try {
	require 'config.php';
	$customer = \Stripe\Customer::retrieve("cus_65YCoDR41gnFgo");
	echo $customer;
	$customer = json_decode($customer, true);
	print_r('<pre>' . $customer . '</pre>');
}catch(Exception $e){
	echo $e->getMessage();  
}
?>