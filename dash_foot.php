<?php
echo '  <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Any questions&#63; Drop us an <a href="mailto:support@autheagle.com">E-Mail</a> or call us on <a href="tel:00442380000329">+44 (0) 238 0000 329</a>
        </div>
        <!-- Default to the left --> 
        <strong>&copy;' . date('Y') . ' <a href="//www.autheagle.com">AuthEagle</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    
    <!-- jQuery 2.1.3 -->';
	if (!isset($gotjquery)) echo '<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>';
    if (!isset($gotbootstrap)) echo '<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>';
    echo '<!-- AdminLTE App -->
    <script src="//dash.autheagle.com/dist/js/app.js" type="text/javascript"></script>
    
    <!-- Optionally, you can add Slimscroll and FastClick plugins. 
          Both of these plugins are recommended to enhance the 
          user experience -->
  </body>
</html>';
?>