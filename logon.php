<?php 
    require_once ("Includes/session.php");
    require_once ("Includes/simplecms-config.php"); 
    require_once ("Includes/connectDB.php");
 

    if (isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT id, username FROM users WHERE username = ? AND password = SHA(?) LIMIT 1";
        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $username, $password);

        $statement->execute();
        $statement->store_result();

        if ($statement->num_rows == 1)
        {
            $statement->bind_result($_SESSION['userid'], $_SESSION['username']);
            $statement->fetch();
            header ("Location: index.php");
        }
        else
        {
            echo "Username/password combination is incorrect.";
        }
    }
?>

<!DOCTYPE html>
<!-- Microdata markup added by Google Structured Data Markup Helper. -->
<html >
<head>
<meta charset="utf-8"/>
<title>Html Tutorial:Learn How To Create a Website.</title>
<meta name="author" content="Emmanuel Alcime">
<meta name="alexaVerifyID" content="scuCUxwknEnhGmDK-WbLocQIbDE" />
<meta http-equiv="content-language" content="en, fr"/>
<meta name="description" content="Learn how to Create a WebSite using html 5"/>
<meta name="keywords" content="website ,programming, xhtml,html5,html ,tutorial,css "/>
<meta name="msvalidate.01" content="9724B62BD872914B259775F1A09984E6"/>
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="author" href="https://plus.google.com/u/0/109926392640370917193"/>

<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="folder/screen.css" media="all"/>
<link rel="stylesheet" type="text/css" href="folder/main.css" media="all"/>
<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link type="text/css" rel="stylesheet" href="js/jRating.jquery.css">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">  
<link rel="stylesheet" href="style.css">     
      
<style>
.blue{ padding:1%; border-bottom:thin dashed #ccc;}
p {font-family: 'Montserrat', sans-serif; color:#181818; font-size:13px; line-height:20px; color:#181818;}
a { font-family: 'Montserrat', sans-serif; color:#181818; text-decoration:none; }
h2{font-family: 'Nunito', sans-serif; color:#E34C23; font-size:18px; margin-bottom:8px; margin-top:8px;}
/* aside ul     	     {
		list-style: none;
	     }

aside ul li:before {
		content: "\00BB \0020";
	     }*/


#footer{margin-top:5% !important;}


#blank{ margin-top:2%;}
.black{ text-shadow:1px 2px 3px #ccc;}

.main{
		width: 500px;
		margin: 20px auto;
		padding: 20px 15px;
		background: white;
		border: 2px solid #DBDBDB;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
	}
input[type="url"]{
		width: 70%;
		margin-bottom: 10px;
	}


#tutorials a { font-size:100%;}
#tutorials p{ border:thin solid #ccc; box-shadow:1px 2px 2px #eee; -webkit-box-shadow:2px 2px 2px #eee; -o-box-shadow:2px 2px 2px #eee; -ms-box-shadow:2px 2px 2px #eee; -moz-box-shadow:2px 2px 2px #eee;}
.holder-cup{ width:95%; padding:2.4%; margin-top:0.7%; border-right:thin solid #ccc; border-left:thin solid #ccc;  border-bottom:thin solid #ccc;

height:auto;
overflow:hidden;

-webkit-box-shadow: -1px 6px 5px -10px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 6px 5px -10px rgba(0,0,0,0.75);
box-shadow: -1px 6px 5px -10px rgba(0,0,0,0.75);
 }
.holder-cup ol { margin-top:12px; }
.clear-fix{ clear:both; height:2em;}
		content: "\00BB \0020";
	     }
 ul     	     {
		list-style: none;
	     }

 ul li:before {
		content: "\00BB \0020";
	     }
ul.menu { float:right; clear:both; }
ul.menu li { float:left; display:inline;}
 
ul.menu ,.bar { display:inline; float:left;}
</style>

<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jRating.jquery.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
	$(".rating").jRating({
		type:'small',
		decimalLength : 1,
		rateMax : 5
	});
      });
        </script>
       

	<!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
    <script type='text/javascript' src='js/modernizr.js'></script>
    <script type='text/javascript' src='js/dynamicpage.js'></script>
    <script src='js/jquery.min.js' type='text/javascript'></script>
    
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div >
<header>

</header><!--header-->

<div id="navi" >
<nav class="bar">

    <a href="home.php" rel="home" title="zapphtml home page"> Home</a>
<a href="About.php"title="about zapphtml.tk">About</a>
<a href="Contacts.php"title="contact zapphtml.tk" rel="author"> Contact</a>
<a href="Articles.php" title="Free Web Hosting">Tutorials</a>



							 <?php  
                        if (logged_on())
                        {
                            echo '<a href="logoff.php">Sign out</a>' . "\n";
                            if (is_admin())
                            {
                                echo '<a href="addpage.php">Add</a>' . "\n";
                                echo '<a href="selectpagetoedit.php">Edit</a>' . "\n";
                                echo '<a href="deletepage.php">Delete</a>' . "\n";
                            }
                        }
                        else
                        {
                            echo '<a href="logon.php">Login</a>' . "\n";
                            echo '<a href="register.php">Register</a>' . "\n";
                        }
                        ?>
                        
                        <?php if (logged_on()) {
                            echo "<div class=\"welcomeMessage\">Welcome, <strong>{$_SESSION['username']}</strong></div>\n";
                        }   ?>
						
					
				</nav> 

</div><!--nav-->

</div><!--2wrapper-->
<div  class="wrapper" id="main-content">


<div id="loading"> </div><!--loading gif-->
		<div id="guts">
        <form action="logon.php" method="post">
            <fieldset>
            <p style="font-weight:bolder; ">Log on</p>
            <ol>
                <div class="form-group">
                <li>
                    <label for="username">Username:</label> 
                    <input type="text" name="username" class="form-control" value="" id="username" />
                 </div>
                </li>

               

                <li>
                    <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control"  name="password" value="" id="password" />
                 </div.
                </li>
            </ol>
            <input  type="submit" class="btn btn-default" name="submit" value="Submit" />
            <p>
                <a href="index.php" style="margin-left:3%; margin-top:5%;">Cancel</a>
            </p>
        </fieldset>
    </form>
</div><!--Guts-->
<div style="width:100%; height:5em;  float:left;"></div>
<footer id="footer" style="position:relative; left:-0px !important; margin-top:30px;">


<p style="font-weight: 400; color: #E34C23;  font-style: normal; font-family: alfa-slab-one; font-size: 18px ;" class="footerp margin-top:3%;">ZappHtml Tutorials &copy; All right reserverd.</p>
<div id="social-links">
		
		<div id="fbook" class="link1">
			<div class="fb-like" data-href="https://facebook.com/zapphtml" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			
		</div>
		<div id="goog" class="link2" style="margin-left:1%; position: relative; top:9px;">
			<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
			
		</div>
		<div id="tweets" class="link3"style="margin-left:1%; position: relative; top:8px;">
			<a href="https://twitter.com/emmanuelalcime" class="twitter-follow-button" data-lang="en">Follow @emmanuelalcime</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			
			
		</div>
</footer>

</div><!--wrapper-->
<script type="text/javascript" src="js/jquery.sticky.js"></script>
<script>
    $(window).load(function(){
      $("aside").sticky({ topSpacing:0 });
    });
</script>
<script>

$(window).bind("load", function() {
    $('#guts').onLoad(function(){
    $('#loading').fadeOut(2000);});
});
</script>

</div>
</div>
<!--Footer Section-->

</body></html>
