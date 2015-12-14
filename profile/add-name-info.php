<?php
session_start();
require_once('../function/data_holder.php');
require_once('../database/connection.php');
require_once('../includes/output.html.php');
$con = connection();





add_header("Profile - Add User Information ");
?>
<div class="container">
<div class="wrapper" style="margin-left:10%;">
	<div class="row">
		    <div class="col-md-8">
		    <div class="page-header">
                   <h1 style=" font-size:160%; letter-spacing:2px;"> Step 2 / <small><?php echo escape($_SESSION['valid_user']);?></small></h1>
            </div><!-- PAGE HEADER -->
            <p>Adding User Information. </p>


             <div id ="show_buttons">
             	<div id ="user_image">
             		
             	<?php
                   echo "<div class='img-rounded' id='image'><?php echo ".$_SESSION['user_image'].";?></div>
                         <div id ='username'><?php echo". $_SESSION['email'].";?></div>";

             	?>
             	</div>
             </div>
             <div id="show_form">
              
              <div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
      <li><a href="#profile" data-toggle="tab">Password</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
        <form class="form_p" id="tab" method="post" action="add_name_process.php">
            <label>Username</label><br/>
            <input name="username" type="text" value="<?php echo $_SESSION['username'];?>" class="form-control"><br>
            <label>First Name</label><br/>
            <input type="text" name="first_name" value="<?php if(!isset($_SESSION['first_name'])){ echo " "; }?>"   class="form-control"><br/>
            <label>Last Name</label><br/>
            <input type="text" name="last_name" value="<?php if(!isset($_SESSION['last_name'])){ echo " "; }?>"  class="form-control"><br/>
            <label>Email</label><br/>
            <input name = "email" type="text" value="<?php echo $_SESSION['email'];?>" class="form-control"><br/>
            <label>Address</label><br/>
            <textarea  name = "address" value="<?php echo $_SESSION['address'];?>" rows="3" class="form-control"></textarea><br/><br/>

            <label>Time Zone</label><br/>
            <select name= "time_zone" name="DropDownTimezone" id="DropDownTimezone" class="input-xlarge">
              <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
              <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
              <option value="-10.0">(GMT -10:00) Hawaii</option>
              <option value="-9.0">(GMT -9:00) Alaska</option>
              <option selected="selected" value="-8.0">(GMT -8:00) Pacific Time (US & Canada)</option>
              <option value="-7.0">(GMT -7:00) Mountain Time (US & Canada)</option>
              <option value="-6.0">(GMT -6:00) Central Time (US & Canada), Mexico City</option>
              <option value="-5.0">(GMT -5:00) Eastern Time (US & Canada), Bogota, Lima</option>
              <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
              <option value="-3.5">(GMT -3:30) Newfoundland</option>
              <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
              <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
              <option value="-1.0">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
              <option value="0.0">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
              <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
              <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
              <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
              <option value="3.5">(GMT +3:30) Tehran</option>
              <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
              <option value="4.5">(GMT +4:30) Kabul</option>
              <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
              <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
              <option value="5.75">(GMT +5:45) Kathmandu</option>
              <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
              <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
              <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
              <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
              <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
              <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
              <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
              <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
            </select><br/><br/>
          	<div>
        	    <button class="btn btn-primary">Update</button>
        	</div>
        </form>
      </div>
      <div class="tab-pane fade" id="profile">
    	<form id="tab2" method= "post"  action = "change_passwd.php">
        	<label>New Password</label>
        	<input type="password" name="password" class="input-xlarge">
        	<div>
        	    <button class="btn btn-primary">Update</button>
        	</div>
    	</form>
      </div>
  </div>


             </div><!-- Show_form -->      


		    </div><!--col md 8 -->
            <aside></aside><!-- Side Bar --->

	</div><!--Row-->
	</div><!--wrapper-->
</div><!-- Container -->
<script type="text/javascript"  >
var choice_div = document.getElementById("show_buttons");
var s_forms = document.getElementById("show_form");
// add div style
choice_div.style.width = '635px';
choice_div.style.height = '6em';
choice_div.style.background = "#eee";
choice_div.style.padding = "2%";



newDiv = document.createElement("div");
newDiv.setAttribute("id"," button_holder");
newDiv.style.position = 'relative';
newDiv.style.width = '100%';
newDiv.style.top = '10%';
newDiv.style.left = '16%';


// buttons 
var b = document.createElement('button');
b.setAttribute('content', 'test content');
b.setAttribute('class', 'btn btn-primary');
b.setAttribute("onclick", "return show();");
b.innerHTML = 'Add User Info';

// button_holder
var b_2 = document.createElement('button');
b_2.setAttribute('content', 'test content');
b_2.setAttribute('class', 'btn btn-primary ');
b_2.setAttribute("onclick", "return nextPage();");
b_2.innerHTML = 'Skip Step';
b_2.style.position = 'relative';
b_2.style.left = '14%';

// buttons
//set_t = b + "&nbsp;" + b_2;
newDiv.appendChild(b);
newDiv.appendChild(b_2);
choice_div.appendChild(newDiv);




function show(){
	var user = document.getElementById("user_image");
	user.style.display = 'block';
	s_forms.style.display = 'block';
	b.style.visibility = 'hidden';
	b_2.style.visibility = 'hidden';
}
function nextPage(){
	return  location.href ="http://localhost/ajax_loader/index.php";
}



</script>
<?php
  add_footer();
?>
