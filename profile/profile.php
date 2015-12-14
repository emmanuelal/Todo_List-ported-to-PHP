<?php
require_once('database/connection.php');
require_once('includes/output.html.php');
$con = connection();
add_header("Profile");
session_start();
try{
   if(isset($_SESSION['valid_user'])){
   	    $find_user_and_id  = "SELECT id , email FROM users WHERE email = '".$_SESSION['valid_user']."'";
        $result = $con->query($find_user_and_id);
        if(!result){
        	echo" An Error occurred ! ";
        }else{
            
            while($row = $result->fetch_assoc()){
            	 session_regenerate_id();
            	 $_SESSION['id'] =  $row['user_id'];
            	 $_SESSION['username'] =  $row['username'];
            	 $_SESSION['email'] = $row['email'];
            	 $_SESSION['country'] = $row['country'];
            	 $_SESSION['profile_id'] = $row['profile_id']; 
            } // while statement.
          $update_user_for_profile  = "update users set profile_id = '".$_SESSION['id']."' where email = '".$_SESSION['email']."' ";
          $update  = $con->query($update_user_for_profile);
          if(!$update){
          	 throw new Exception("unable to perform update task", 1);
          	 
          }// not update query.


           

        }// else
}

?>

<div class="container">
   <div class="row">
      <div class="col-md-6">
      	
      </div>
  </div>
</div><!--container-->


<?php  }else{
      add_header("Must Be Login");
      print("<div class='wrapper'>");
           do_html_url('Login.php','Login');
      print("</div>");
      add_footer();

     }// not logged in to view this page;
   }catch(Exception $e){
      add_header("Error");           
       print("<div class="wrapper">");
       echo $e->getMessage();
       print("</div>");
   }
?>