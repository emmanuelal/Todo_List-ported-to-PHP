<?php
// start a new session

// include function files for this application
require_once('database/connection.php');
require_once('includes/output.html.php');
require_once('function/data_holder.php');
//get new database connection
$conn = connection();
add_header("Verify Account");
?>


<!-- start header div --> 
<div class="container">
	<div class="row">

    
    <!-- start wrap div -->   
    <div id="wrapper">
        <!-- start PHP code -->
     
        <div class="page-header" style='margin-left:11%;'>
        	<h3>Time Box Signup</h3>
       </div>

    <!-- end header div -->   
     
<?php
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = $conn->mysqli_escape_string($_GET['email']); // Set email variable
    $hash = $conn->mysqli_escape_string($_GET['hash']); // Set hash variable
	         
	          
	$s = " SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0' ";
	$search = $conn->query($s);
	if($search->mysqli_connect_errno){
		 echo("unable to verify your account at this time");
		 exit();
	} 
	$match = $search->num_rows;
	if($match > 0){
	  // We have a match, activate the account
	  mysql_query("UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'") or die(mysql_error());
	  echo '<div class="alert alert-success">Your account has been activated, you can now login</div>';
	}else{
	  // No match -> invalid url or account has already been activated.
	  echo "<div class='alert alert-warning'>The url is either invalid or you already have activated your account.</div>";
	}

                 
}else{
    // Invalid approach
           echo("<div class='container'><div class='row'><div class='wrapper'>
	 	   <div class='col-md-8'><div class='alert alert-success'>Invalid approach, please use the link that has been send to your email.</div></div></div></div>");
}
?>
        <!-- stop PHP Code -->
 
         
    </div>
    <!-- end wrap div --> 

</div><!--row-->
</div><!--container-->    

<?php
 add_footer();
?>    