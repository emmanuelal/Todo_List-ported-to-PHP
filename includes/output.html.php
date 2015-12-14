<?php




function IsURLCurrentPage($url){
  if(strpos($_SERVER['PHP_SELF'], $url )==false) {
      return false;
  }else{
      return true; 
  }
}

function DisplayButton($width,$name,$url,$active = true){
if ($active) {
echo "<li width = \"".$width."%\"> <a href=\"".$url."\"> ".$name." </a> </li>";
} else {
echo "<li width=\"".$width."%\"><a class=\"menu\">".$name."</a> </li>";
 }
}

function change_pass_form(){
?>
<div id="content">
<center>
<h3>Reset Password ?</h3>

<form name = "changePassowrd" method="post"  action="pass_dir/forgot_password.php" >
<div id="notice"></div>
<div class="input-group" >
     <input id="change_password" type="text" name="change_password" class="form-control"  placeholder='Change PASSWORD' required/>
</div>
<br>
<div class="input-group">
	 <input type='submit' name="submit"  value='submit'  />
</div>
</form><!--form-->
</center>
</div>
<?php }// change password form 

function register_form(){
?>

<div class='form_holder'>
<h3>Register</h3>
	<form method="post" action="register_new.php" class="register">
	    
	    <div class="input-group" >
	     <input type="text" name="email" class="form-control"  placeholder='Email' required/>
	    </div><!--Email-->
	    <div class="input-group" >
	     <input type="password" name="password" class="form-control"  placeholder='Password' required/>
	    </div> <!--password-->
	    <div class="input-group" >
	     <input type="password" name="password2" class="form-control"  placeholder='Confirm Password' required/>
	    </div><!--password-->

       <br/>
	   <div class="input-group" >
	     <input type="submit" name="submit" class="btn btn-success btn-block" value="Register"/>
	   </div>

	</form>

</div>
<?php

}

function forgot_pass_form(){
?>
<div id="content">
<form method="post" action="pass_dir/change_password.php">
    <div class="input-group" >
     <input type="text" name="old_password" class="form-control"  placeholder='OLD PASSWORD'/>

   </div>
    <div class="input-group" >
     <input type="text" name="new_password" class="form-control" placeholder="NEW PASSWORD"/>

   </div>
<div class="input-group" >
     <input type="text" name="confirm_password" class="form-control" placeholder="CONFIRM PASSWORD"/>
   </div>
 <div class="input-group"  >
 	
 	<input type="submit" name='submit' value='change' class="btn btn-default"/>
 </div>
   
</form>
</div>
<?php   }

function add_footer(){
?>

</div><!--wrapper-->
                   </div><!--wrapper-->
                   <footer id="footer">
                   	       <div class="wrapper">
                   	            <nav> 
                                    <a rel='preload'  href="http://www.time-box.tk/About/">About</a>
                                    <a rel='preload'  href="http://www.time-box.tk/Contact/">Contact</a>
                                    <a rel='preload'  href="http://www.time-box.tk/Help/">Help</a>
                                    <a rel='preload'  href="http://www.time-box.tk/site_map/">Site Map</a>
                                    <a rel='preload'   href="http://www.time-box/privacy">Privacy</a>
                                </nav>
                   	       	    <p>Time-Box Apps All Rights &copy; Reserved 2015</p>
                   	       	 
                   	       </div>
                   </footer>
              </body>
<script language="JavaScript" type="text/javascript" >



xmlhttp = false;
try{
   xmlhttp = ActiveXObject("Msxml2.XMLHTTP");
}catch(e){
   xmlhttp = false;
}

if (!xmlhttp && typeof XMLHttpRequest !='undefined') {
     xmlhttp = new XMLHttpRequest();
}



function sendData(){
     var notice = document.getElementById('notice');
     notice.style.display = "none";   
     var oForm = document.getElementById('form_contact');
     var first_name = oForm.elements['first_name'];
     var last_name = oForm.elements['last_name'];
     var email = oForm.elements['email'];
     var comment = oForm.elements['message'];
        comment.focus(); 
     if(oForm.submit()){
       if(xmlhttp){
           xmlhttp.open("POST",'send_mail.php');
           xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');        
           xmlhttp.onreadystatechange = function(){
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200 ){
              notice.innerHTML = xmlhttp.responseText;  
      }             
    } 

    xmlhttp.send(first_name.value + last_name.value + email.value + comment.value );   
    }
  }
}
</script>
<script type='text/javascript'>
var help = document.getElementById('help_info');
var saving = 'The TodoList Page is Build very intutuitive and is very easy to following along';
var emails = 'visit the accounts and settings section and click disable emails checkbox ';

function show_help(evt){
// get element from DOM
        var links = document.getElementsByName("choice");
        var help = document.getElementById("help_info");
        for(var i = 0, length = radio.length; i< length; i++){
            if(links[i].click()){
                if(links[i].value == 'a'){
                    evt =+help;
                    evt.innerHTML = saving;


                }else if( links[i].value =="b"){
                    location.href="http://time-box.tk/accounts/"; 
                }else if(links[i].value == "c"){

                  location.href="http://time-box.tk/accounts/change_passwd.php";   
                }else if(links[i] == 'd'){
                     help.innerHTML = emails;      
                }else if(links[i] == 'f'){
                   location.href="http://time-box.tk/Contact/";
                }

            }
        }
    }



</script>

              
           </html>

<?php
   }


function do_html_url($url, $title){
?>
<a class="btn btn-default" rel='preload'  href="<?php echo $url?>"><?php echo $title; ?></a>
<?php
     return $url;
    }

function do_html_heading($title){    
?>
 <h1><?php echo $title; ?></h1>
<?php
      }
function add_header($title){
  global $keywords;
  global $description;
?>
<html lang="en">
       <head>
           <meta  charset="utf-8"/>
           <meta name ="keywords"  content="<?php  echo $keywords;  ?>"/>
           <meta name ="description"  content="<?php  echo $description;  ?>"/>
           <meta name="author" content="Emmanuel Alcime">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <link rel="apple-touch-icon" sizes="57x57" href="http://time-box.tk/icons/apple-icon-57x57.png">
          <link rel="apple-touch-icon" sizes="60x60" href="http://time-box.tk/icons/apple-icon-60x60.png">
          <link rel="apple-touch-icon" sizes="72x72" href="http://time-box.tk/icons/apple-icon-72x72.png">
          <link rel="apple-touch-icon" sizes="76x76" href="http://time-box.tk/icons/apple-icon-76x76.png">
          <link rel="apple-touch-icon" sizes="114x114" href="http://time-box.tk/icons/apple-icon-114x114.png">
          <link rel="apple-touch-icon" sizes="120x120" href="http://time-box.tk/icons/apple-icon-120x120.png">
          <link rel="apple-touch-icon" sizes="144x144" href="http://time-box.tk/icons/apple-icon-144x144.png">
          <link rel="apple-touch-icon" sizes="152x152" href="http://time-box.tk/icons/apple-icon-152x152.png">
          <link rel="apple-touch-icon" sizes="180x180" href="http://time-box.tk/icons/apple-icon-180x180.png">
          <link rel="icon" type="image/png" sizes="192x192"  href="http://time-box.tk/icons/android-icon-192x192.png">
          <link rel="icon" type="image/png" sizes="32x32" href="http://time-box.tk/icons/favicon-32x32.png">
          <link rel="icon" type="image/png" sizes="96x96" href="http://time-box.tk/icons/favicon-96x96.png">
          <link rel="icon" type="image/png" sizes="16x16" href="http://time-box.tk/icons/favicon-16x16.png">
          <link rel="manifest" href="/manifest.json">
          <meta name="msapplication-TileColor" content="#ffffff">
          <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
          <meta name="theme-color" content="#ffffff">

           <title><?php echo $title; ?></title>
           <link type="text/css" rel="stylesheet" href="styles/site.css" media="all" />
           <link type="text/css" rel="stylesheet" href="styles/bootstrap-theme.min.css" media="all" />
           <link type="text/css" rel="stylesheet" href="styles/bootstrap.css" media="all" />
           <link type="text/css" rel="stylesheet" href="styles/leaflet.css" />
           <noscript>
           	<?php
              
               echo"<div>";
               echo"This site requires Javascript enable to work";
               echo"</div>";

           	?>
           </noscript>
           <script language="JavaScript" type="text/javascript" src="scripts/jquery-1.11.3.js"></script>
           <script type="text/javascript" src="scripts/bootstrap.min.js"></script>
           <script type="text/javascript" src="scripts/effects.js"></script>  
            <script type="text/javascript" src="scripts/functions.js"></script> 
        
               
       </head>
           <body>
           	     <nav class="navbar navbar-default">
           	     <div class="wrapper">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="wrapper">
      <a class="navbar-brand " id="logo" href="http://www.time-box.tk/">Time-Box </a>
    </div>
    <?php if(isset($_SESSION['valid_user'])){?>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php
      $buttons = array('Home' => 'http://www.time-box.tk/index.php',
                 'TodoList'=>'http://www.time-box.tk/todo_lists/'
              
                );

        function DisplayMenu($buttons) {
           //calculate button size
             $width = 100 / count($buttons);
              while (list($name, $url) = each($buttons)) {
                 DisplayButton($width, $name, $url, !IsURLCurrentPage($url));
          }
        }
        DisplayMenu($buttons);
  ?>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://localhost/ajax_loader/profile?user=">Profile</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Change Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Messages</a></li>
          </ul>
        </li>
        <?php 
         $not_root = "/";
         $url = "logout.php";
           if(!strpos($_SERVER['HTTP_USER_AGENT'], $not_root)): ?>       
              <li><a href="http://www.time-box.tk/logout.php">Logout</a></li>
          <?php else:  ?>
               <li><a href="<?php echo $url; ?>">Logout</a></li>
               
          <?php  endif; ?>     
          </ul>

        <?php }else{ ?>
                
      <?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  </div>
</nav>

<?php
      return $title;
                     }

function Jumbotron(){                     
?>                   
<div class="jumbotron hero" >
           <center>
		   
		        <h3>Keep track of what's important.</h3>
		   	    <font>Never Forget an appointment with our TodoList</font>

		   	    <div id="auth">
		   	    	<button onclick=" return hreff('login.php');" class="btn btn-success">Login</button>
		   	    	<button onclick="return getData('register_new.html.php','content');" class="btn btn-success">Sigup</button>
               </center>
		   	    </div> <!-- auth -->
		   	    </div><!-- jumbotron-->
<?php
     }

function map(){     
?>  
<div class="jumbotron hero" id="map"></div></div><!-- jumbotron-->
<?php
     }
function show_todolist_notice(){   
add_header('Please Login:'); 
?>

       echo"<div class='wrapper' style=' width:30%; height:30em; '>";
       echo "<h2 style='position:relative; top:150px;'>Create a TodoList</h2>";
       echo "<div class='alert alert-danger' style='position:relative; left:05%; top:40%;'>" ;
       echo "<div style='text-align:center; font-weight:bold; text-shadow:0px 1px 1px #eee;'> Please Login To Create a TodoList </div></div><br/>"; 
       echo"<a style='display:block; position:relative; top:150px; left:6%;' href='http://localhost/ajax_loader/login.php'>Login</a>";
       echo"</div>";
  
<?php
  add_footer();
  return true;
    }

function gurdian(){    
$address = "http://content.guardianapis.com/search?show-elements=image&api-key=agu5esashhuk6yqngrwj4yt6";
try{
  $get = file_get_contents($address);
  if( !$get ){
       throw new Exception("Unable To Make News Request", 1);      
  }else{
       $output = json_decode($get);
       for($i = 0 ; $i < count($output); $i++ ){
?>


<?php
        
        }
      }   
    }catch(Excaption $e){
   echo $e->getMessage();
  }
}

function menu(){
?>
<div class="menu">
  <?php
      $m_links = array("About"=>"http://time-box.tk/About/",
                       "Blog"=>"http://time-box.tk/Blog/",
                       "Help"=>"http://time-box.tk/Help/",
                       "Terms"=>"http://time-box.tk/Terms/",
                       "Privacy"=>"http://time-box.tk/privacy/",
                       "Copyright"=>"http://time-box.tk/copyright/");
  while(list($value,$key) = each($m_links)){
          echo("<div class='menu'><ul class='list-group men'>");
          echo("<li><a href=".$key.">".$value."</a></li>");
          echo("</div></ul>");

      }
  ?>
</div>

<?php
     }
function user_active(){    
?>
<div class="wrapper">
<div class="alert alert-danger"><h1>THIS ACCOUNT IS NOT ACTIVATED.</h1></div>
    <br/>
    <p>
       <b>please visit your email address for verification email or <a href='#'>click</a> this link to resend the verification email.</b>
    </p>

</div>
<?php

    }
?>