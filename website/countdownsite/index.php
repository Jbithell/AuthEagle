
<!DOCTYPE html>
<!--[if lt IE 8 ]><html class="no-js ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 8)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
<head>

   <!--- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
   <?php
   if (isset($base)) echo $base;
   ?>
	<title>AuthEagle - The free website auth and membership system</title>
	<meta name="description" content="AuthEagle is a free website auth and membership system, designed for use in conjuntion with Weebly, Wix, Wordpress &amp; more!">
	<meta name="author" content="James Bithell, Freddie Poser and Matthew Ross Rachar">

   <!-- Mobile Specific Metas
   ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
    ================================================== -->
   <link rel="stylesheet" href="css/default.css">
	<link rel="stylesheet" href="css/layout.css">
   <link rel="stylesheet" href="css/media-queries.css">    

   <!-- Script
   ================================================== -->
	<script src="js/modernizr.js"></script>

   <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="favicon.ico" >

</head>

<body>

	<!--<div id="preloader">      
      <div id="status">
         <img src="images/preloader.gif" height="64" width="64" alt="">
      </div>
   </div>-->

   <!-- Intro Section
   ================================================== -->
   <section id="intro">

   	<header class="row">	 

			<div id="logo" >
				<!--<a href="#" >
                 <img src="images/logo.png" alt="AuthEagle Logo">                  
              </a>-->				
			</div>

		   <nav id="nav-wrap">

		      <a class="menu-btn" href="#nav-wrap" title="Show navigation">Show navigation</a>
			   <a class="menu-btn" href="#" title="Hide navigation">Hide navigation</a>

		      <ul id="nav" class="nav">
		         <li class="current"><a class="smoothscroll" href="#home">Home</a></li>
		         <li><a class="smoothscroll" href="#about">About</a></li>			         
			      <li><a class="smoothscroll" href="#location">Team</a></li>
		      </ul> <!-- end #nav -->

		   </nav> <!-- end #nav-wrap --> 	        

   	</header> <!-- Header End -->   	

   	<div  id="main" class="row">

	   	<div class="twelve columns">
	   			
	   		<h1>We are currently working on something awesome. Stay tuned!</h1>

	   		<p>AuthEagle is a free website auth and membership system, designed for use in conjuntion with Weebly, Wix, Wordpress &amp; more!</p>

	   		<!--<h4>Time Left Until Launching</h4>-->
<?php
$rem = strtotime('2015-11-01 16:00:00') - time();
$day = floor($rem / 86400);
$hr  = floor(($rem % 86400) / 3600);
$min = floor(($rem % 3600) / 60);
$sec = ($rem % 60);
echo '<div id="counter" class="cf">';
if($day) echo "<span>" . $day . "<em>days</em></span> ";
if($hr) echo "<span>" . $hr . " <em>hours</em></span>";
if($min) echo "<span>" . $min . " <em>minutes</em></span>";
if($sec) echo "<span>" . $sec . " <em>seconds</em></span> ";
echo "</div>";
?>
	<!-- Begin MailChimp Signup Form -->
	         <div id="mc_embed_signup">
	            <form action="notify.php" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	                  
	               <input type="email" value="" name="email" class="email" id="mce-EMAIL" placeholder="E-mail address" required>
	               
	               <!-- <div class="clear"> --><input type="submit" value="Get Notified!" name="subscribe" id="mc-embedded-subscribe" class="button"><!-- </div> -->
	               
	          	</form>
	         </div>

	         <ul class="social">
	            <li><a href="https://www.facebook.com/autheagle"><i class="fa fa-facebook"></i></a></li>
	            <li><a href="https://twitter.com/AuthEagle"><i class="fa fa-twitter"></i></a></li>
	            <!--<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
	            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
	            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
	            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
	            <li><a href="#"><i class="fa fa-skype"></i></a></li>-->
            </ul>

         </div> 

      </div> <!-- main end -->    	

   </section> <!-- end intro section -->


   <!-- About Section
   ================================================== -->
   <section id="about">

      <div class="row section-header">

      	<div class="twelve columns">	

      		<div class="icon-wrap">
            	<i class="fa fa-group"></i>
         	</div>

	         <h1>About</h1>

	         <p class="lead">AuthEagle, started by three up and coming web developers is the way to keep your site and membership secure. It lets you make parts of your site members only, requiring a username and password to login, or parts of your site password protected - Perfect for family areas and wedding sites. 
	         </p>

         </div>

      </div> <!-- end section-header -->             	

     <!-- <div class="row section-content">
				
			<div class="six columns">
		      <h3>Our Process.</h3>

		      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam,
		      eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
		      </p>
	      </div>

	      <div class="six columns">
		      <h3>Our Approach.</h3>

		      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam,
		      eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
		      </p>
	      </div>            

      </div>--> <!-- end section-content -->  

     <!-- <div class="row section-content">
				
			<div class="six columns">
		      <h3>Our Vision.</h3>

		      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam,
		      eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
		      </p>
	      </div>

	      <div class="six columns">
		      <h3>Our Objective.</h3>

		      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam,
		      eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
		      </p>
	      </div>      

      </div>   -->    <!-- end section-content -->       

      <!--<div id="call-to-action">	       

		   <div class="row section-ads">

		      <div class="twelve columns">		         		

			      <h2><a href="http://www.dreamhost.com/r.cgi?287326|STYLESHOUT">Host This Template on Dreamhost.</a></h2>

			      <p class="lead">
			      Looking for an awesome and reliable webhosting? Try <a href="http://www.dreamhost.com/r.cgi?287326|STYLESHOUT"><span>DreamHost</span></a>.
					Get <span>$50 off</span> when you sign up with the promocode <span>styleshout</span>. 							
					</p>

					<div class="action">
			         <a href="http://www.dreamhost.com/r.cgi?287326|STYLESHOUT" class="button">Sign Up Now</a>
	         	</div>

			   </div>

		   </div>        

	   </div>--> <!-- end call-to-action -->		   	

   </section> <!-- About Section End-->    


   <!-- Location Section
   ================================================== -->
	<section id="location">

		<div class="contacts">		
			
			<div class="row contact-details">
			   <div class="columns">

				   <h3>James Bithell</h3>
				   <p>Web Developer behind <br/><a href="//uptimeagle.com">Uptime Eagle</a>, <a href="//sapiensoptio.com">Sapiens Optio</a> &amp; <a href="//port-tides.com">PortTides</a>
					</p>
				<a href="//twitter.com/BithellJames"><i class="fa fa-twitter fa-2x"></i></a>
				<a href="//stackoverflow.com/users/3088158"><i class="fa fa-stack-overflow fa-2x"></i></a>
				<a href="//jbithell.com"><i class="fa fa-external-link fa-2x"></i></a>
			   </div> 

			   <div class="columns">

				   <h3>Freddie Poser</h3>
				   <p>Backend Engineer behind <br/><a href="//getvotr.uk">Votr</a>, politics for the Twitter generation. 
				   </p>
				<a href="//twitter.com/vogonjeltz101"><i class="fa fa-twitter fa-2x"></i></a>
				<a href="//stackoverflow.com/users/3140358"><i class="fa fa-stack-overflow fa-2x"></i></a>
				<a href="//github.com/vogon101"><i class="fa fa-github fa-2x"></i></a>
				<a href="http://vogonjeltz.com"><i class="fa fa-external-link fa-2x"></i></a>
			   </div>	 

			   <div class="columns end">

				   <h3>Matthew Ross Rachar</h3>
				   <p>Pythonista and Sever Side Scripter who thinks all his code is self-documenting.
				   </p>
				   <a href="//stackoverflow.com/users/3334697"><i class="fa fa-stack-overflow fa-2x"></i></a>
			   </div>          	

		 	</div> <!-- end contact-details -->		  

		</div> <!-- end contacts -->

	  <!-- <div id="map">

	   	 <p class="map-error">Something went wrong... Unable to load map... Please try to enable javascript</p>   

	   </div> --><!-- end map -->

	</section> <!-- end location section -->

   <!-- footer
   ================================================== -->
   <footer>

      <div class="row">

         <div class="twelve columns">            

            <ul class="copyright">
               <li>&copy;2015 AuthEagle</li>
               <li>Design by <a title="Styleshout" href="http://www.styleshout.com/">Styleshout</a></li> 
			<li><a title="Styleshout" href="mailto:support@autheagle.com?Subject=Website%20Enquiry" target="_top">Contact AuthEagle</a></li>			   
            </ul>

         </div>          

      </div>

      <div id="go-top"><a class="smoothscroll" title="Back to Top" href="#intro"><i class="icon-up-open"></i></a></div>

   </footer> <!-- Footer End-->   

   <!-- Java Script
   ================================================== -->
   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
   <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>

	<script src="//maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
   <script src="js/gmaps.js"></script>
   <script src="js/waypoints.js"></script>
   <script src="js/jquery.countdown.js"></script>
   <script src="js/jquery.placeholder.js"></script>
   <script src="js/backstretch.js"></script>  
   <script src="js/init.js"></script>

</body>

</html>