<?php
// start a new session
session_start();
// include function files for this application
require_once('database/connection.php');
require_once('includes/output.html.php');
require_once('function/data_holder.php');
//get new database connection
$conn = connection();
if(!$conn){
	print("Down!");
}

add_header("Home");
// make sql query


$s = "SELECT * FROM users WHERE email = '".$_SESSION['valid_user']."' ";
$mysql = $conn->query($s);
if(!$mysql){
	 echo("<div class='container'><div class='row'><div class='wrapper'>
	 	   <div class='col-md-8'><div class='alert alert-success'>database unavailable</div>
	 	   </div></div></div></div>"
	 	   );

	 add_footer();
	 exit();
}
while($q = $mysql->fetch_assoc()){

}

?>
<div class="container">
	<div class="row">
		 <div class="col-md-8">
		 	         
		 </div><!--col md 8-->
          <div class="col-md-4">
          	
          </div><!--col md 4-->
	</div><!--row-->
</div><!--container-->
<?php
add_footer();
?>