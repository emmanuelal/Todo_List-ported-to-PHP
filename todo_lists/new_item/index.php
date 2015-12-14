<?php
session_start();
require_once('../../function/data_holder.php');
require_once('../../includes/output.html.php');
require_once('../../database/connection.php' ); 
$conn = connection();
add_header("Show TodoList");
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
?>
<div class='container'>
	<div class='row'>
		<div class='wrapper'>
			   <div class='col-md-8'>
			   	<form method="post" action=''>
			   		 <div class="title">
			   		 	<input type="text" name='name' placeholder='Title'/>
			   		 </div><!--title-->
			   		 <div class='content'>
			   		      <textarea name="content" placeholder='Content'></textarea>
			   		 </div><!--Content-->
			   		 <div class='date'>
			   		 	<input type="date" name="date"/>
			   		 </div><!--Date-->
			   		 <div class='completed'>
			   		    <label>Completed</label>
			   		 	<input type='checkbox' name='completed' />
			   		 </div><!--completed-->

			   		 <div class='submit'>
			   		 	<input type='submit' name="submit" value='Create' />
			   		 </div><!-- Submit-->
			   	</form>
			   </div><!--col md 8-->
		    	  <div>
		    	  <button class="btn btn-primary" onclick="javascript:history.back();">Back</button>
             </div>    
		</div><!--wrapper-->
	</div><!--row-->
</div><!--container-->
<?php 
add_footer();
}else{
   add_header("Error");
   echo("<div class='wrapper'>
   	     <div>Please Login To Create A New Todoitem </div>
   	     </div>");

   add_footer();	
}

?>