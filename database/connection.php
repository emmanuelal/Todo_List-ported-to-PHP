<?php
   
   function connection(){
   include('creditials.php');
   $connection = new Mysqli(HOST,USER,PASSWORD ,DBASE );
	   if(mysqli_connect_errno()){
	   	    echo("unable to connect to database ".mysqli_connect_errno());
	   	    exit();
	   }
	   return $connection;
}

?>