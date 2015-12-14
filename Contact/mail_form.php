<?php
function mail_form(){
?>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" id="form_contact" >
	        
	        <input type="text" name="first_name" placeholder="First Name" />
	        <input type="text" name="last_name" placeholder="Last Name" />
	        <input type= "email" name ="email" placeholder="Email Address" />
             <textarea name="comment" id="message" placeholder="Message" /></textarea>
             <input type="submit" name="submit" value="Contact Me"  />
	      
</form>
<?php
  }
?>