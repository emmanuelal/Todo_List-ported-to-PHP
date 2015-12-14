<?php
session_start();
require_once('function/data_holder.php');
require_once('includes/output.html.php');
require_once('database/connection.php' ); 
// get old location from user.
define("route","http://localhost.com/ajax_loader");

$conn = connection();
add_header("Home");
if(!$conn){
   echo("Could not establish connection to database.");
   exit();
}
if(isset($_SESSION['valid_user'])){
  $sql =" SELECT email, active FROM users WHERE email = '".$_SESSION['valid_user']."'";
  $result = $conn->query($sql);
  if(!$result){
  	 echo("connection to the database couldn't be establish");
  	 exit();
  }
  while($row = $result->fetch_assoc()){
      extract($row);
      if($active == 0){
      	user_active();
        break;    
      }
  }     
if(!check_profile()){
    create_profile();
}

}else{

    header("Location:login.php");
  
}?>