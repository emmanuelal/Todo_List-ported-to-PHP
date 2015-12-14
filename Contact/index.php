<?php 
require_once('../includes/output.html.php');
  add_header("Contact");
  $keywords = "TodoLists creator, Games , News information ";
  $description = "Contact Time-Box Application ";
  
?>
<div class="container">

<div class="row">
<div class="wrapper">
	   <div class="col-md-8">
         <h1 id="header">Web Developer</h1>
	  
	   	  <form method="post" action="send_mail.php" id="form_contact" >
	        
	        <input type="text" name="first_name" placeholder="First Name" />
	        <input type="text" name="last_name" placeholder="Last Name" />
	        <input type= "email" name ="email" placeholder="Email Address" />
             <textarea name="comment" id="message" placeholder="Message" /></textarea>
             <input type="submit" name="submit" value="Contact Me"  />
	      
         </form>
             <div id="notice"></div>
	 </div>
	 <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
	 	 <div class="sidebar-module sidebar-module-inset">
            <h4><a rel="preload" href="http://time-box/About/">About</a></h4><hr style="border:thin solid #ccc;"/>
            <p>Emmanuel Alcime<br/>
       
        Phone:(242)-449-8298<br/>
       Email: <small style="font-size:70%; font-weight:bolder;"> emmanuelalcime54@gmail.com</small></p>
          </div>
	 </div>
</div>
         </div><!--wrapper-->
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
   

</body></html>

<?php 
add_footer();
?>
