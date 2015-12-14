<?php
// include function files for this application
require_once('database/connection.php');
require_once('includes/output.html.php');
require_once('function/data_holder.php');

//create short variable names

$email=   addslashes($_POST['email']);
$username= addslashes($_POST['username']);
$age = intval($_POST['age']);
$country = $_POST['country'];
$city =  $_POST['city'];
$password= $_POST['password'];
$password2=$_POST['password'];



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
register($username,$email ,$age, $country, $city, $password);
// register session variable
$_SESSION['valid_user'] = $username;
$cookie_name = 'signup';
setcookie( $cookie_name, $user, time() + 3600, "/" );

// provide link to members page

	add_header('Registration successful');
	echo"<div class='wrapper' style=' width:30%; height:30em; '>";
	echo '<h1>Your registration was successful. Go to the members page to start 
	setting up your bookmarks! </h1>';
	do_html_url('index.php', 'Go to members page');
	do_html_url('profile.php', 'Create a Profile');
	echo"</div>";
	// end page
	add_footer();
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