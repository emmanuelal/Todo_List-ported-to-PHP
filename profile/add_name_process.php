<?php
session_start();
require_once('../function/data_holder.php');
require_once('../database/connection.php');
require_once('../includes/output.html.php');
$con = connection();
if($con->connect_errno){
	 die("unable to connect to database at this time.");
}
$sql = "SELECT * FROM users";
$result = $con->query($sql);
if($result){
    while($row = $result->fetch_assoc()){
           session_regenerate_id();
           $_SESSION["user_id"] = $row['user_id'];
    }// while statement
  
}else{
     
     print("unable to open mysql resource at this time. ");
}

$first_name = addslashes($_POST['first_name']);
$last_name = addslashes($_POST['last_name']);
$address = addslashes($_POST['address']);


if(!empty($first_name) && !empty($last_name)){
   $update = "UPDATE profiles SET  first_name = '".$first_name."' , last_name = '".$last_name."', address = '".$address."' WHERE p_id = '".$_SESSION['user_id']."' ";
$make_q  = $con->query($update);
if(!$make_q){
        print("Unable to create entire profile at this time.Please try again ");
     exit();
   }else{
   	      // if successful redirect back to home page.
   	      header("Location: ../index.php");
   }
} // if variable not empty  
?>