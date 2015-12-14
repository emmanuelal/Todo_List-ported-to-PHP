<?php 
  require_once('../includes/output.html.php');
  add_header("Help");
  $keywords = "Mobile TodoList";
  $description = "Mobile TodoList help section";

?>

<div class ="container">
	<div class="row">
	   <div class="wrapper">
		   <div class="col-md-4" >
		   	<?php menu(); ?>
		   </div>
		   <div class="col-md-8 top">
		   	<div class="page-header">
              <h1>Help </h1>
           </div><!--Page Header-->
           <div class="well well-lg" id="hero">
           	    <ul>
           	    	<li><a name="choice" onclick="show_help(a); return false;">Saving TodoLists</a></li>
           	    	<li><a name="choice" onclick="show_help(b); return false;">Account Settings</a></li>
           	    	<li><a name="choice" onclick="show_help(c); return false;">Change Password</a></li>
           	    	<li><a name="choice" onclick="show_help(d); return false;">Stop Email reminders</a></li>
           	    	<li><a name="choice" onclick="show_help(f); return false;">Reporting Errors</a></li>

           	    </ul>

           </div><!--well -->
           <div id="help_info"></div>
		   </div><!--col 6 -->
		   </div><!--wrapper-->
	</div><!--row-->
</div><!--Container-->


<?php add_footer();?>