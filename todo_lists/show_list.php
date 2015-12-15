<?php
session_start();
require_once('../function/data_holder.php');
require_once('../includes/output.html.php');
require_once('../database/connection.php' ); 
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
$user  = $_GET['user'];	  
$list_id = $_GET['list_id'];	
$update = "update TodoLists set item_id = '".$list_id."' where t_id='".$list_id."' ";
$set_id = $conn->query($update);
if(!$set_id){
	echo("unable to update");
}
?>	
<div class="container">
	<div class="row">
		  <div class="wrapper">
		  	  <div class="col-md-12">
              <?php
                $query_1 = "select users.email , TodoLists.t_id, TodoLists.TodoList_name , TodoLists.due_date,
                      TodoLists.description , TodoLists.todo_list_id
                      from users , TodoLists       
                      where email = '".$email."' 
                      and users.todo_list_id = TodoLists.todo_list_id
                      and TodoLists.t_id ='".$list_id."'";
                $fecth_list = $conn->query($query_1);
                if(!$fecth_list){
                	throw new Exception("No TodoLists Found");
                	
                }      
                while($r_2 = $fecth_list->fetch_assoc()){
                	extract($r_2);

                }


              ?>
		  	  <div class='info_holder'>
		  	  <div class='list_name'> <?php echo $TodoList_name;?></div>
              <div class='due_date'>Due Date: <?php 
                 $today = date("Y-m-d");
                if($due_date !=$today){
                	 echo($due_date);
                }else{
            	 if($due_date > $today){
            	     echo("<div style='color:red;'>Over Due</div>");
            	 }
                }
              ?></div>
              </div>
              <hr/>
              <div style="margin-left:2%;">
              <h4>Description</h4>
              <div class="description"><?php echo $description;?></div>
              </div>
              <hr/>
              <br>
             
		  	  	<?php
		  	  	     //make query for todolist items
		  	  	   $query = " select TodoLists.t_id , TodoLists.item_id , todolist_items.i_id , 
		  	  	                     todolist_items.name , todolist_items.item_id ,
		  	  	                     todolist_items.date ,todolist_items.content, todolist_items.completed  
		  	  	              from TodoLists , todolist_items 
		  	  	              where TodoLists.item_id = todolist_items.item_id ";

                    
                  try{    
                     $result = $conn->query($query);
                     if(!$result){
                        throw new Exception("unable to fetch todo list items from database.");
                     } 

                       
                     echo("<table class='table table-striped table-bordered table-hover'>"); 
               ?>
                <thead>
                            <tr>
                              <th>Title</th>
                              <th>Due Date</th>
                              <th>Discription</th>
                              <th>Completed</th>
                              <th colspan="3"></th>
                            </tr>
                </thead>
                 <tbody>

               <?php        
                     while($r = $result->fetch_assoc()){
                       extract($r);
                       echo("<tr>");
                       echo("<td>'".$name."'</td><td>'".$date."'</td><td>'".$content."'</td><td>'".$completed."'</td><td><span class='badge'>show</span></td><td><span class='badge'>delete</span></td>"); 
                       echo("</tr>");	 
                     } 
                    
                 ?>
    </tbody>
    </table>            
    <div class="">
      <?php 
          
         echo"<a class='btn btn-primary' href='new_item.php?user=".urlencode($user)."&list_id=".urlencode($t_id)."&description=".urlencode($description)."&list_date=".urlencode($due_date)."'>New Item</a>";
          echo"<button class='btn btn-primary' onclick='javascript:history.back();'>Back</button>";
              

      ?>
       </div>
    	  

             <?php                 

                 }catch(Exception $e){
                 	echo("<div class='container'>");
                    echo("<div class='row'>");
                    echo("<div class='wrapper'>");
                    echo("<div class='col-md-8'>");
                    echo("<div class='alert alert-warning' role='alert' style='margin-top='10%;'>");
                 	echo($e->getMessage());  
                 	echo("</div>");
                    echo("</div>");
                    echo("</div>");
                    echo("</div>");
                    echo("</div>"); 
                 }
		  	  	?>
		  	  </div><!-- col md 12-->
		  	 
		  </div><!--wrapper-->
	</div><!--row-->
</div><!--container-->
<?php	  
  }     
add_footer();
?>