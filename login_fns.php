<?php


//require_once('function/security.php');
require_once('database/connection.php');
require_once('includes/output.html.php');
require_once('function/data_holder.php');



//create short variable names
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($_POST['email']) && !empty($_POST['password'])) {
// they have just tried logging in
      try {
               login($email, $password);
		    // if they are in the database register the user id
		       session_start();    
		       $_SESSION['valid_user'] = $email;
           $cookie_name = 'login';
           setcookie( $cookie_name, $email, time() + 3600, "/" );
           if(!last_page()){
		       header("Location:index.php");
		    }
      }

    catch(Exception $e) {
   // unsuccessful login
     add_header('Problem:');
     echo"<div class='wrapper' style=' position:relative; left:-200px; width:30%; height:20em; '>";
     echo '<h3 style="margin-top:20%; width:180%;">You could not be logged in. You must be logged in to view this page.</h3><br/>';
     echo"<b>Try Again!</b><br/><hr/>";
     do_html_url('login.php', 'Login');
     echo "</div>";
     add_footer();
     exit;

     }
  }



?>