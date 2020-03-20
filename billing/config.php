<?php
require_once('libs/stripe/init.php');
$testing = true;
if ($testing) {
	//Testing Keys
	$stripe = array(
	  'secret_key'      => ('sk_test_vFGtyZMYXlAQXbwMmL4UiLLy'),
	  'publishable_key' => ('pk_test_r73duJAQybCl4fo0ogc2aioB')
	);
} else {
	//Live Keys
	$stripe = array(
	  'secret_key'      => ('sk_live_MFUx7kUb6xS2fb3H25H5mBs4'),
	  'publishable_key' => ('pk_live_zZtHxwy7r6zsMGIdHTVtB8If')
	);
}
unset($testing);
\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>