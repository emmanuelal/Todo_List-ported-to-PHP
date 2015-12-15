<?php
session_start();
//error_reporting(0);
require_once('../function/data_holder.php');
require_once('../includes/output.html.php');
require_once('../database/connection.php' ); 
$conn = connection();
add_header("New Item");
if(!$conn){
   echo("Could not establish connection to database.");
   exit();
}
if(isset($_SESSION['valid_user']) ){
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

	@$user = addslashes($_GET['user']);
	@$list_id  = addslashes($_GET['list_id']);
	@$description = addslashes($_GET['description']);
	@$date = date("m-d-Y");


if(isset($_POST['submit'])){  
   $name  = addslashes(trim( $_POST['name'] ));
   $content = addslashes(trim( $_POST['content'] ));
   $date = addslashes(trim($_POST['date'] ));
   $completed = $_POST['completed'];  
   
$query = "
         INSERT INTO todolist_items(name,content,item_id,date,completed)VALUES(?,?,?,?,?)
         ";        
$result = $conn->prepare($query);

$result->bind_param("ssiss", $name , $content,$date, $completed);
if($result->execute()){

      $result->close();
    
      
  }else{
  	 connection_error("Item not created");
  }
 
}
?>
<div class='container'>
	<div class='row'>
		<div class='wrapper'>
			   <div class='col-md-8'>
                <div class="page-header">
                <h1>New Todo Item </h1>
               </div>
               <?php echo"<b>username &nbsp;".$user."</b>"; ?>

			   	<form method="post" action='<?php echo $_SERVER['PHP_SELF'];?>' class='todo' >
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
			   		 	<input type='checkbox' name='completed[]' value="completed" />
			   		 </div><!--completed-->

			   		 <div class='submit'>
			   		 	<input type='submit' name="submit" class="btn btn-primary"  value='Create' />
			   		 	 <button class="btn btn-primary back" onclick="javascript:history.back();">Back</button>
			   		 </div><!-- Submit-->
			   	</form>
			   </div><!--col md 8-->
			   <div class='col-md-4 sidebar'>
			   	   <h3>List Description</h3> 
			   	   <?php 

			   	   echo $description;?>

			   	   <h3>Calendar</h3>
			   	   <div>
                      <?php
                        //calendar.php
                       //Check if the month and year values exist
                       if ((!$_GET['month']) && (!$_GET['year'])) {
                         @ $month = date ("n");
                          $year = date ("Y");
                          } else {
                          $month = $_GET['month'];
                          $year = $_GET['year'];
                          //Calculate the viewed month
                          $timestamp = mktime (0, 0, 0, $month, 1, $year);
                          $monthname = date("F", $timestamp);
                          //Now let's create the table with the proper month
                         }


			   	   ?>
     <table style="width: 98%; border-collapse: collapse;" border="1"➥
cellpadding="3" cellspacing="0" bordercolor="#000000">
<tr style="background: #FFBC37;">
<td colspan="7" style="text-align: center;" onmouseover=➥
"this.style.background='#eee'" onmouseout="this.style.background='#ddd'">
<span style="font-weight: bold;"><?php echo $monthname➥
. " " . $year; ?></span>
</td>
</tr>
<tr style="background: #ccc;">
<td style="text-align: center; width: 15px;" onmouseover=➥
"this.style.background='#ccc'" onmouseout="this.style.background='#FFBC37'">
<span style="font-weight: bold;">Sun</span>
</td>
<td style="text-align: center; width: 15px;" onmouseover=➥
"this.style.background='#ccc'" onmouseout="this.style.background='#FFBC37'">
<span style="font-weight: bold;">Mon</span>
</td>
<td style="text-align: center; width: 15px;" onmouseover=➥
"this.style.background='#ccc'" onmouseout="this.style.background='#FFBC37'">
<span style="font-weight: bold;">Tues</span>
</td>
<td style="text-align: center; width: 15px;" onmouseover=➥
"this.style.background='#ccc'" onmouseout="this.style.background='#FFBC37'">
<span style="font-weight: bold;">Weds</span>
</td>
<td style="text-align: center; width: 15px;" onmouseover=➥
"this.style.background='#ccc'" onmouseout="this.style.background='#FFBC37'">
<span style="font-weight: bold;">Thur</span>
</td>
<td style="text-align: center; width: 15px;" onmouseover=➥
"this.style.background='#ccc'" onmouseout="this.style.background='#ccc'">
<span style="font-weight: bold;">Fri</span>
</td>
<td style="text-align: center; width: 15px;" onmouseover=➥
"this.style.background='#FECE6E'" onmouseout="this.style.background='#FFBC37'">

<span style="font-weight: bold;">Sat</span>
</td>
</tr>
<?php
$monthstart = date("w", $timestamp);
$lastday = date("d", mktime (0, 0, 0, $month + 1, 0, $year));
$startdate = -$monthstart;
//Figure out how many rows we need.
$numrows = ceil (((date("t",mktime (0, 0, 0, $month + 1, 0, $year))
+ $monthstart) / 7));
//Let's make an appropriate number of rows...
for ($k = 1; $k <= $numrows; $k++){
?><tr><?php
//Use 7 columns (for 7 days)...
for ($i = 0; $i < 7; $i++){
$startdate++;
if (($startdate <= 0) || ($startdate > $lastday)){
//If we have a blank day in the calendar.
?><td style="background: #FFFFFF;">&nbsp;</td><?php
} else {
if ($startdate == date("j") && $month == date("n") &&
$year == date("Y")){
?><td style="text-align: center; background: #FFBC37;" 
onmouseover="this.style.background='#FECE6E'"
onmouseout="this.style.background='#FFBC37'">
<?php echo date ("j"); ?></td><?php
} else {
?><td style="text-align: center; background: #A2BAFA;" 
onmouseover="this.style.background='#CAD7F9'"
onmouseout="this.style.background='#A2BAFA'">
<?php echo $startdate; ?></td><?php
}
}
}
?></tr><?php
}
?>
</table>
			   	   </div><--calendar-->
			   </div><!-- col md 4-->

		    	  <div>
		    	 
             </div>    
		</div><!--wrapper-->
	</div><!--row-->
</div><!--container-->
<?php 
add_footer();
}else{
   
   echo("<div class='wrapper'>
   	     <div>Please Login To Create A New Todoitem </div>
   	     </div>");

   add_footer();	
}

?>