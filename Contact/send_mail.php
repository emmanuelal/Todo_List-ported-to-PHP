<?php
require_once('../database/connection.php');
require_once('../includes/output.html.php');
require_once('../function/data_holder.php');
require_once('mail_form.php');
$con = connection();
	
$first_name = addslashes($_POST['first_name']);
$last_name =  addslashes($_POST['last_name']);
$email =  addslashes($_POST['email']);
$message = addslashes($_POST['comment']);
try{

$toaddress ="admin@time-box.tk"; 
if(empty($first_name) && empty($last_name) && empty($email) && empty($message)){	
		 throw new Exception("please fill out all fields");
		 exit();
}elseif(isset($first_name) && isset($last_name) && isset($email)  && isset($message)){
  $reg = "^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$";
  if(!ereg($reg, $email)){
      throw new Exception("email address not valid.");
       exit();
  }
  if(strlen($message) < 20 || strlen($message) > 300 ){
     throw new Exception("message must be a mininum characters between 20 and 300 ");
      exit();
  }


$subject = "Feedback from web site";
$mailcontent = "Client first name: ".$first_name."\n".
"Client last name:".$last_name."\n".
"Clinet: email ".$email."\n".
"Client comments:\n".$message."\n";

$fromaddress = "From: time-box.tk website ";

$send = mail($toaddress, $subject, $mailcontent, $fromaddress);
if($send){
	  $query = "insert into contacts(first_name,last_name,email,message)values(?,?,?,?)";
	  $stmt = $con->prepare($query);
	  $stmt->bind_param("ssss", $first_name, $last_name, $email, $message );
	  $stmt->execute();
	  echo $stmt->affected_rows.' message sent';
	  $stmt->close();
	header("Location:http://www.time-box.tk");
    }
  }
}catch(Exception $e){
	add_header("Error");
    echo("<div class='container'>");
    echo("<div class='row'>");
    echo("<div class='wrapper'>");
    echo("<div class='col-md-8'>");
    echo("<div class='alert alert-warning' role='alert' style='margin-top='10%;'>");
    echo($e->getMessage());
    echo("</div>");
    mail_form();
    echo("</div>");
    echo("</div>");
    echo("</div>");
    echo("</div>");
    add_footer();

}?>