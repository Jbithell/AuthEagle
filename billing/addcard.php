<?php
//require_once('../dash_auth.php');

	require 'config.php';
	//require_once('../dash_auth.php');
	$token  = $_POST['stripeToken'];
	$customer = \Stripe\Customer::create(array(
		'card'  => $token
	));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>AuthEagle</title>
 
  <!-- Stripe lib -->
  <script type="text/javascript" src="//js.stripe.com/v2/"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 
  <script type="text/javascript">
    // This identifies your website in the createToken call below
    Stripe.setPublishableKey('<?php require_once('config.php'); echo $stripe['publishable_key']; ?>');

    var stripeResponseHandler = function(status, response) {
      var $form = $('#payment-form');

      if (response.error) {
        // Show the errors on the form
        $form.find('.payment-errors').text(response.error.message);
        $form.find('button').prop('disabled', false);
      } else {
        // token contains id, last4, and card type
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and re-submit
        $form.get(0).submit();
      }
    };

    jQuery(function($) {
      $('#payment-form').submit(function(e) {
        var $form = $(this);

        // Disable the submit button to prevent repeated clicks
        $form.find('button').prop('disabled', true);

        Stripe.card.createToken($form, stripeResponseHandler);

        // Prevent the form from submitting with the default action
        return false;
      });
    });
  </script>
</head>
<body>
  <h1>AuthEagle - Add a card to your account</h1>
 
  <form action="" method="POST" id="payment-form">
    <span class="payment-errors"></span>
 
    <div class="form-row">
      <label>
        <span>Card Number</span>
        <input type="text" size="20" data-stripe="number"/>
      </label>
    </div>
 
    <div class="form-row">
      <label>
        <span>CVC</span>
        <input type="text" size="4" data-stripe="cvc"/>
      </label>
    </div>
 
    <div class="form-row">
      <label>
        <span>Expiration (MM/YYYY)</span>
        <input type="text" size="2" data-stripe="exp-month"/>
      </label>
      <span> / </span>
      <input type="text" size="4" data-stripe="exp-year"/>
    </div>
    <button type="submit">Submit Payment</button>
  </form>
</body>
</html>