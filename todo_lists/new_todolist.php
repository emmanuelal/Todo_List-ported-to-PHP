<?php
session_start();
require_once('../function/data_holder.php');
require_once('../includes/output.html.php');
require_once('../database/connection.php' ); 
require_once('../function/bog_info.php'  );
$conn = connection(); // database connection
error_reporting(0);
 add_header("TodoLists"); 
?>
<div class='container'>
       <div class='row'>
         <div class='wrapper'>       
            <?php 
            if(!check_valid_user()){
                header("Location: http://time-box.tk//login.php?");   
                  }else{               
              ?>
              <?php
               if(isset($_POST['submit'])){

                    // create short varibles
                   $todo_list_name = stripslashes($_POST['TodoList_name']);
                   $description = stripslashes($_POST['description']);
                   $due_date =  $_POST['due_date'];
                   // find user todo_list_id
                try{

                       $user = "SELECT * FROM users WHERE email='".$_SESSION['valid_user']."'";
                       $query = $conn->query($user);
                       if($query->num_rows){
                           while($row = $query->fetch_assoc()){
                               $todo_list_id = $row['user_id'];  
                               if(count($todo_list_id) > 0){
                                  break;
                               }
                           }  

                       }else{
                         throw new Exception("unable to find user in database.");     
                       }

                       if(empty( $todo_list_name) && empty($description) && empty($due_date)){
                              throw new Exception("all fields must be filled out");       
                        }//if
                       if(isset($todo_list_name)&& isset($description) && isset($due_date)){
                             
                         $sql = " insert into TodoLists(TodoList_name,description,due_date,todo_list_id )values (?,?,?,?)";
                         $stmt = $conn->prepare($sql);
                         $stmt->bind_param("ssss",$todo_list_name,$description,$due_date,$todo_list_id);
                          if($stmt->execute()){
                             $stmt->close();
                             header("Location:http://localhost/ajax_loader/todo_lists/");

                          }  
                          $update = "UPDATE users SET todo_list_id ='".$todo_list_id."'WHERE email = '".$_SESSION['valid_user']."'";
                               $r = $conn->query($update);
                                if(!$r){
                                    throw new Exception(" unable to update database.");
                                }     

                            }
                        
                          }catch(Exception $e){
                            echo($e->getMessage());
                       }

                     }// POST SUBMIT 
                      ?>
                <div class='col-md-8'>   
                 <h1>TodoLists</h1>
                  <form class="todo" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                   <input type="text" name=" TodoList_name"  placeholder="TodoList Name" required/>
                   <textarea name="description" placeholder="Short Description"></textarea>
                  
                  <div class="date_section"> 
                  <label class='d_label'>Due Date</label><br/>
                   <input type="date" class="date" name ="due_date" placeholder ="Due Date" />
                   </div><!--due section-->            
                   <input type='submit' name='submit' value='create' class="btn" />
                  </form>

                </div><!-- col 8-->
                <div class='col-md-4' style=' margin-top:5%;'>
                 <div class='sidebar_header'><h4>Today <?php echo Date("m-d-y");?>/</h4><small id='time'> </small></div>
                       <?php 
                          echo("<div class='time_line'>
                                    <div class='blog_count'>
                                    ".blog_count()."
                                    </div></div>"
                               );                    
                       ?>
                </div><!--col4-->
              </div><!--wrapper-->  
     </div><!--row-->
</div><!--Container-->
<script type='text/javascript'>

</script>
<script type='text/javascript'>
  function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
 }
 startTime();
</script>

<?php
add_footer();
       }       
?>
