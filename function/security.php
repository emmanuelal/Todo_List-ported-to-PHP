<?php

/***************************************************************************************************
 This is proprietary software which belong to it's owner.
 And may not be reuse without permission of the developer.
 Author:Emmanuel Alcime
 Date: November 28, 2015
 
***************************************************************************************************/

error_reporting(0);
include("include/ip_geter.php");



function check_user(){
  /* This is not free software and is property of emmanuel alcime 
     this function creates a unique number and then sets a cookie on the users machine.
     And then inserts the users environment variables into a Mysql table. 
  */

   //create unique user id
   $u_id = " R0 ".rand(10, 1000);
   $rolli_vistor  = $u_id . ".$_SERVER['REMOTE_ADDR'].";
   
   //setcookie with id and user ip address.
   setcookie($u_id, $rolli_vistor, time() + (86400 * 30), "/"); // 86400 = 1 day
   
   // Get environment variables for users visit 

   $v_ip = $_SERVER['REMOTE_ADDR']; // users ip address varible.
   $v_time = $_SERVER['REQUEST_TIME']; // page request time varible.
   $v_browser = $_SERVER['HTTP_USER_AGENT']; // user browser information .
   $v_referer = $_SEVER['HTTP_REFERER']; // users referer to rolli website.
   $v_host = $_SERVER[ 'REMOTE_HOST']; // users host information.
   $v_port = $_SERVER['REMOTE_PORT'];

   /*
      This section is form the ip_geter.php file which give regional information.
   */

   $ip; //ip address
   $region_code; //region_code
   $region_name; //region_name
   $city;     //city
   $time_zone; //time zone
   $latitude; // latitude
   $longitude; //longitude
   $metro_code; //metro_code


   //Include mysql connection 
   include('includes/connect.php');
   $time = date("h:i:sa");
   $error = "errors on page."
   $sucess ="<font>Welcome To Our Site<font>";     
   $connection = connect();  // connection resource
   $result = $connection->prepare("INSERT INTO  visits ('browser','ip','port','referer','host','time')values( ?, ? ,? ,? ,? ,?) ");
   $result->bind_param('ssssss', $v_ip, $v_time,  $v_browser, $v_referer , $v_host ,$v_port );
   if($result->execute){
        return $sucess;      
     }else{
        return $error;
  
     }

$result->close();
}// check user function 





/*
function revisit($user){
 include('includes/connect.php');
 $mysql = "SELECT COUNT(*) FROM visits WHERE u_id =".$user." ";
 $connection = connect();
 $result = $connection->query($mysql);
 $row = $result->fetch_row();
 $count = $row[0];
 if($count > 0 ){
      $new_query =" UPDATE revisits WH";
  }    

}
*/





?>