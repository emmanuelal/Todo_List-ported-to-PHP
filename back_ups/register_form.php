function register_form(){
?>

<div class='form_holder'>
<h3>Register</h3>
	<form method="post" action="register_new.php" class="register">
	    <div class="input-group" >
	     <input type="text" name="username" class="form-control"  placeholder='Username'required/>
	    </div><!--Username-->
	    <div class="input-group" >
	     <input type="text" name="email" class="form-control"  placeholder='Email' required/>
	    </div><!--Email-->
	    <div class="input-group" >
	     <input type="password" name="password" class="form-control"  placeholder='Password' required/>
	    </div> <!--password-->
	    <div class="input-group" >
	     <input type="password" name="password2" class="form-control"  placeholder='Confirm Password' required/>
	    </div><!--password-->

	    <div class="input-group" >
	     <input type="number" name="age" class="form-control"  placeholder='Age' required/>
	    </div><!--age-->

	   <div class="input-group" >
	     <input type="text" name="country" class="form-control"  placeholder='Country' required/>
	   </div><!--Country-->


	   <div class="input-group" >
	     <input type="text" name="city" class="form-control"  placeholder='City' required/>
	   </div><!--city-->

       <br/>
	   <div class="input-group" >
	     <input type="submit" name="submit" class="btn btn-success btn-block" value="Register"/>
	   </div>

	</form>

</div>
<?php
      }
?>