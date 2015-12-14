<?php

error_reporting(0);
// include function files for this application
require_once('includes/output.html.php');

session_start();

$old_user = $_SESSION['valid_user'];
 // store to test if they *were* logged in

unset($_SESSION['valid_user']);

$result_dest = session_destroy();

// start output html

     add_header('Logged Out');
if (!empty($old_user)) {
      if ($result_dest) {
           // if they were logged in and are now logged out
           echo "<div class='wrapper'>"; 
           echo "<div class='alert alert-success'>Logged out.<br />";
             do_html_url('login.php', 'Login');
           echo "</div>";  
           echo"</div>";
      } else {
// they were logged in and could not be logged out
          echo 'Could not log you out.<br />';
    }
 } else {
    // if they weren't logged in but came to this page somehow
      echo "<div class='wrapper'>"; 
      echo "<div class='alert alert-success'>Logged out.<br />";
      echo 'You were not logged in, and so have not been logged out.<br />';
      do_html_url('login.php', 'Login');
      echo "</div>";  
      echo"</div>";
    }
add_footer();

?>