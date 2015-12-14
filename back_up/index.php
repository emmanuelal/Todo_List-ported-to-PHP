<?php 
include("includes/output.html.php");
include('function/data_holder.php');
include("function/curl_lib.php");  
session_start();
$keywords = "Ajax, Application,Php, javascript,Json";
$description = "This is a Ajax application using php and javascript ";

$products = array("BLOG"=>"blog/",
	               "TODOLIST"=>"todo_lists/",
	               "NEWS"=>"news/",
	               "TVGUIDE"=>"tv_guide/"
	              );
// this is the guadian api
$g_key = "http://content.guardianapis.com/search?show-elements=image&api-key=agu5esashhuk6yqngrwj4yt6";



$json_url = "http://freegeoip.net/json";
if(!$json_url){
	 print("unable to find file for open "); 
}else{
     @$link = file_get_contents($json_url);
     $place = json_decode($link, true);
     $city = $place['city'];
     $lat =  $place['latitude'];
     $long = $place['longitude'];
     $country = $place['country_name'];
     $time_zone = $place['time_zone'];
}

$ip = $place['ip'];


add_header("Welcome To Boite");
?>
<div id ="content">
	<div id="main_page">
		   
		   <div class="wrapper" style=" margin-right:13%;">
		   <h1 class="heading">Welcome 
		   <?php 
	            if($country){         
			        echo escape($country); 
	            }else{
	            	
	            	echo"To Boite";
	            }
		   ?>
		   </h1>
              <?php
                  if(! $link ){
                  	if(isset($_COOKIE['signup']) || isset($_COOKIE['login'])){
                            
                  		
                  	}else{
                  		// show jumbotron only if possible cookies are disable.
                  	  Jumbotron();
                  	  }

                  }else{
                  	  map();
                  } 


              ?>
		   	    <div id="div">
		   	     <?php
		      // this application selection options
		      while(list($key, $value ) = each($products)){
		   	     echo "<div id = '". $key. "'><a href='".$value."'>".$key."</a></div>";

		   	 }

		   	?>
           
            </div><!--div-->
            <div></div>
		   </div><!-- wrapper -->

	</div><!-- main_page -->

</div><!--content-->
<script type="text/javascript">
	 function hreff(link){
         return location.href = link;
	 }
</script>

<?php


echo("

<script type='text/javascript'>
	var map = L.map('map').setView(['".$lat."', '".$long."'], 13);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: ''
}).addTo(map);

L.marker(['".$lat."', '".$long."']).addTo(map)
    .bindPopup('TodoList And Blog')
    .openPopup();
</script>");

?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
  $.ajax({
  url : "http://api.wunderground.com/api/97036736008cd2dd/geolookup/conditions/q/"<?php echo $city; ?>/<?php echo $country;?>.json",
  dataType : "jsonp",
  success : function(parsed_json) {
  var location = parsed_json['location']['city'];
  var temp_f = parsed_json['current_observation']['temp_f'];
  alert("Current temperature in " + location + " is: " + temp_f);
  }
  });
});
</script>
<br/><br>
<?php
  add_footer();
?>
