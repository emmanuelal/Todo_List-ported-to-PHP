<?php
// include function files for this application
require_once('database/connection.php');
require_once('includes/output.html.php');
require_once('function/data_holder.php');

//create short variable names

$email = addslashes($_POST['email']);
$password= addslashes($_POST['password']);
$password2= addslashes($_POST['password']);
$hash = sha1(rand( 1, 1000));




// start session which may be needed later
// start it now because it must go before headers
session_start();
try
{
	// check forms filled in
	if (!filled_out($_POST)) {
	throw new Exception('You have not filled the form out correctly – please go back and try again.');
}

	// email address not valid
	if (!valid_email($email)) {
	throw new Exception('That is not a valid email address. Please go back and try again.');

}





	// passwords not the same
	if ($password != $password2) {
	throw new Exception('The passwords you entered do not match –
	please go back and try again.');
}
	// check password length is ok
	// ok if username truncates, but passwords will get
	// munged if they are too long.
	if ((strlen($password) < 6) || (strlen($password) > 16)) {
	throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
}

// attempt to register
// this function can also throw an exception
register($email,$password,$hash);
// register session variable
$_SESSION['valid_user'] = $email;
$user = $_SESSION['valid_user'];
$cookie_name = 'signup';
setcookie( $cookie_name, $user, time() + 3600, "/" );

// provide link to members page

	add_header('Registration successful');
	echo"<div class='wrapper' style=' width:30%; height:30em; '>";
	echo '<h4>Registration was successful.Please verify your email address to
	setting up your TodoLists </h4>';
      echo("<br/><p>Please visit your email inbox for the Verification letter.</p>");
     
          
	echo"</div>";
	// end page
	add_footer();

$to      = $email; // Send email to our user
$subject = 'Signup | Verification'; // Give the email a subject 
$message = '
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------
Username: '.$email.'
Password: '.$password.'
------------------------
 
Please click this link to activate your account:
http://www.time-box.tk/verify.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply time-box.tk' . "\r\n"; // Set from headers
mail($to, $subject, $message, $headers); // Send our email
}
	catch (Exception $e) {
	add_header('Problem:');
	echo"<div class='wrapper' style=' width:30%; height:30em; '>";
	echo "<div class='alert alert-danger' style='position:relative; left:05%; top:40%;'>".$e->getMessage() ."</div>";
	echo"</div>";
	add_footer();
	exit;
}
?>