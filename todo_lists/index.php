<?php
session_start();
require_once('../function/data_holder.php');
require_once('../includes/output.html.php');
require_once('../database/connection.php' ); 
require_once('../function/bog_info.php'  );
$conn = connection(); // database connection
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
                <div class='col-md-12'>   
                 <h1>Listing TodoLists</h1>
                  <table class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>List name</th>
                              <th>List due date</th>
                              <th colspan="3"></th>
                            </tr>
                          </thead>

                        <tbody class="table-striped">
                         <?php
                            $query = "SELECT  users.email,users.todo_list_id,TodoLists.t_id,TodoLists.TodoList_name ,TodoLists.due_date 
                                      FROM users , TodoLists
                                      WHERE email = '".$_SESSION['valid_user']."'
                                      AND users.todo_list_id = TodoLists.todo_list_id";
                                      $results = $conn->query($query); 
                                      while($row = $results->fetch_assoc()){
                                           extract($row);
                                           $name = explode('@',$email);
                                           echo("<tr>");
                                           echo("<td>".$TodoList_name."</td><td>".$due_date."</td><td><a href='show_list.php?user=".$name[0]."&list_id=".$t_id."'><span class='badge'>show</span></a></td><td><a href='update_list.php?user=".$name[0]."&list_id=".$t_id."'><span class='badge'>update</span></a></td><td><a href='delete_list.php?user=".$name[0]."&list_id=".$t_id."'><span class='badge'>delete</span></a></td></tr>");
                                           echo("</tr>");
                                      }
                         ?>
                         </tbody>  
                   </table>
                     <button class='btn' onclick="javascript:location.href='new_todolist.php'">New TodoList</button>
                </div><!-- col 12-->
                
              </div><!--wrapper-->  
     </div><!--row-->
</div><!--Container-->



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
