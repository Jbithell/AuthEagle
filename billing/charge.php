<?php
  try {
	   require 'config.php';
	  //require_once('../dash_auth.php');
	  $token  = $_POST['stripeToken'];
	  $customer = \Stripe\Customer::create(array(
		  'card'  => $token
	  ));
	  echo $customer->id;
		$charge = \Stripe\Charge::create(array(
		  'customer' => $customer->id,
		  'amount'   => 5000, //1000 = £1, 1110 = £1.11
		  'currency' => 'usd' //usd, gbp or eur 
	  ));
	   echo '<h1>Successfully charged $5!</h1>';
		print_r('<pre>' . $charge . '</pre>');
	}catch(Exception $e){
		echo $e->getMessage();  
	}
  
?>