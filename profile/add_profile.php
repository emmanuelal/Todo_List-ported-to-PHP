<?php
session_start();
require_once('../function/data_holder.php');
require_once('../database/connection.php');
require_once('../includes/output.html.php');
$con = connection();
add_header("Profile");




   if(isset($_SESSION['valid_user'])){
   	    $find_user_and_id  = "SELECT * FROM users WHERE email = '".$_SESSION['valid_user']."' LIMIT 1";
        $result = $con->query($find_user_and_id);
        if(!$result){
        	echo(" An Error occurred !");
        

        }else{
            
            while($row = $result->fetch_assoc()){
            	 session_regenerate_id();
            	 $_SESSION['id'] =  $row['user_id'];
            	 $_SESSION['username'] =  $row['username'];
            	 $_SESSION['email'] = $row['email'];
            	 $_SESSION['country'] = $row['country'];
            	 $_SESSION['profile_id'] = $row['profile_id']; 
            } // while statement.
          

    }?>

<div class="container">
   <div class="row">
     <div class="wrapper">
      <div class="col-md-6">
              <h2>Creating Your User Profile/ &nbsp;<?php echo escape( $_SESSION['username']); ?></h2>
              <hr style="width:210%;" />

               <b>First choose and upload a picture.</b>
      	    
               <div id="showimg"></div>
              <form id="uploadform" action="process_upload.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                                  Upload a File:<br />
              <input type="file" id="myfile"  name="fileToUpload" id="fileToUpload"/><br/>
              <input type="submit" value="Submit" class="btn btn-primary"/>
              <iframe id="uploadframe" name="uploadframe" src="process_upload.php" class="noshow"></iframe>
             </form>
         
             
       <br/>
       <b>Skip This Step. </b>
       <br/>
      <?php do_html_url('add-name-info.php','NEXT');?>	   
      </div>
      </div><!--wrapper-->
  </div>
</div><!--container-->

<?php add_footer();?>
<?php  }else{
   
      print("<div class='wrapper'>");
           do_html_url('http://localhost:/ajax_loader/login.php','Login');
      print("</div>");
      add_footer();

     }// not logged in to view this page;
  
?>