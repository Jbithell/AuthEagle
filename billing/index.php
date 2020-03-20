<?php require_once '../dash_auth.php'; ?>
<html>
<head>
	<title>AuthEagle</title>
</head>
<body>
<h1>AuthEagle</h1>
<?php
require_once('config.php');
$amount = 10;
$description = 'A test payment';
echo '<form action="charge.php" method="post">
		<script src="https://checkout.stripe.com/checkout.js"
			class="stripe-button"
			data-key="' . $stripe['publishable_key'] . '"
			data-amount="' . $amount . '"
			data-description="' . $description . '"></script>
	</form>';
	echo '<form action="" method="POST">
		  <script
			src="https://checkout.stripe.com/checkout.js" class="stripe-button"
			data-key="' . $stripe['publishable_key'] . '"
			data-amount="' . $amount . '"
			data-name="AuthEagle"
			data-description="' . $description . '"
			data-image="/1024_logo.png">
		  </script>
		</form>';
?>
</body>
<html>